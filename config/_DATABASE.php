<?php

require_once '_SUPPORT.php';
global $debug_mode, $db, $gh, $last_query;

class MysqliDB
{
    protected $_mysqli;

    public function __construct($host, $username, $password, $db, $port = NULL)
    {
        if ($port == NULL)
            $port = ini_get('mysqli.default_port');

        $this->_mysqli = new mysqli($host, $username, $password, $db, $port)
            or die('There was a problem connecting to the database');

        $this->_mysqli->set_charset('utf8mb4');

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function __destruct()
    {
        $this->_mysqli->close();
    }

    public function call_SP($query)
    {
        $output = array();
        try {
            global $gh, $last_query;
            $last_query = $query;
            $query = str_replace("\0", "", $query);
            $query_start = $gh->LogQueryStart($query);
            $result = array();
            if (!$this->_mysqli->multi_query("CALL " . $query)) {
                echo "CALL failed: (" . $this->_mysqli->errno . ") " . $this->_mysqli->error;
            }

            do {
                if ($res = $this->_mysqli->store_result()) {
                    $output_dt = array();
                    //printf("---\n");
                    //var_dump($res->fetch_all());
                    //$output[] = $res->fetch_all();
                    while ($row = $res->fetch_assoc()) {
                        $output_dt[] = $row;
                    }
                    $output[] = $output_dt;
                    $res->free();
                } else {
                    if ($this->_mysqli->errno) {
                        echo "Store failed: (" . $this->_mysqli->errno . ") " . $this->_mysqli->error;
                    }
                }
            } while ($this->_mysqli->more_results() && $this->_mysqli->next_result());


            $gh->LogQueryEnd($query_start);
            $gh->LogQueryResult($output);
        } catch (Exception $e) {
            if (!IS_PRODUCTION) {
                print_r($e);
            }
            $gh->Log($e);
        }

        return $output;
    }

    public function execute($query)
    {
        $output = array();
        try {
            global $gh, $last_query;
            $query = str_replace("\0", "", $query);
            $last_query = $query;
            $query_start = $gh->LogQueryStart($query);
            $result = array();
            $stmt = $this->_mysqli->prepare($query);
            if ($stmt) {
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $output[] = $row;
                }
                $stmt->close();
            } else {
                $this->error($this->_mysqli->error);
            }
            $gh->LogQueryEnd($query_start);
            $gh->LogQueryResult($output);
        } catch (Exception $e) {
            if (!IS_PRODUCTION) {
                print_r($e);
            }
            $gh->Log($e);
        }

        return $output;
    }

    function error($message, $level = E_USER_ERROR)
    {
        global $gh;

        $caller = @next(debug_backtrace());
        $message = $message . ' in ' . $caller['function'] . ' called from ' . $caller['file'] . ' on line ' . $caller['line'] . '';
        $message = $message . PHP_EOL . PHP_EOL;
        $message = $message . print_r($caller, true);

        //$gh->Log($e);
        $gh->Log($message);

        trigger_error($message . "\n<br />error handler", $level);
    }

    public function execute_query($query)
    {
        global $gh, $last_query;
        $cnt = -1;
        $try_cnt = 0;
        $continue = true;

        while ($continue && $try_cnt < 3) {
            try {
                if (strlen($query) <= 10) return -2;

                $is_select_query = strtolower(substr(trim($query), 0, 6)) == "select";
                $is_insert_query = strtolower(substr(trim($query), 0, 6)) == "insert";
                $is_update_query = strtolower(substr(trim($query), 0, 6)) == "update";
                $is_delete_query = strtolower(substr(trim($query), 0, 6)) == "delete";
                $is_truncate_query = strtolower(substr(trim($query), 0, 6)) == "truncate";
                $is_drop_query = strtolower(substr(trim($query), 0, 14)) == "drop temporary";

                if ($is_select_query || $is_select_query) {
                    return $this->execute($query);
                }

                $query = str_replace("\0", "", $query);
                $last_query = $query;
                $query_start = $gh->LogQueryStart($query);

                // explicitly begin DB transaction
                $this->_mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

                $result = $this->_mysqli->query($query);

                if ($is_insert_query) {
                    $cnt = $this->_mysqli->insert_id;
                    $gh->LogQueryResult(array("insert_id" => $cnt));
                } else if ($is_update_query) {
                    if ($result == true || $result > 0) {
                        $cnt = $this->_mysqli->affected_rows;
                    }
                    $gh->LogQueryResult(array("affected_rows" => $cnt));
                } else if ($is_delete_query || $is_drop_query) { // may be delete query..
                    if (isset($result) && is_object($result) && isset($result->num_rows)) {
                        $cnt = $result->num_rows;
                    }
                    $gh->LogQueryResult(array("result->num_rows" => $cnt));
                }
                $gh->LogQueryEnd($query_start);

                // commit changes
                $this->_mysqli->commit();
                $continue = false;
            } catch (Exception $e) {
                $try_cnt++;
                $gh->Log(array($try_cnt . " Query Error: ", $query));
                $this->_mysqli->rollback();
                $gh->Log($e);
                //print_r($e);
            }
        }
        return $cnt;
    }

    public function execute_scalar($query)
    {
        $query = str_replace("\0", "", $query);
        $result = $this->execute($query);
        $obj = null;
        if (isset($result) && count($result) > 0) {
            $obj = array_values($result[0])[0];
        }
        return $obj;
    }

    public function get_row_count($table, $whereData)
    {
        if (is_array($whereData)) {
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='" . $this->_mysqli->real_escape_string($value) . "'";
            }
        } else {
            $where = $whereData;
        }
        $query = "SELECT count(*) as cnt FROM " . $table . " WHERE " . $where;
        $result = $this->execute_scalar($query);
        if (is_array($result) && isset($result["cnt"])) {
            $result = $result["cnt"];
        }
        return $result;
    }

    public function select($columns, $table, $whereData)
    {
        $where = "1=1";
        if (is_array($whereData)) {
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='" . $this->_mysqli->real_escape_string($value) . "'";
            }
        } else {
            $where = $whereData;
        }
        $query = " SELECT " . $columns . " FROM " . $table . " WHERE " . $where . "";
        return $this->execute($query);
    }

    public function insert($table, $tableData)
    {
        global $gh;
        $columns = "";
        $values = "";
        foreach ($tableData as $column => $value) {

            $sub_query = "";
            if (is_array($value)) {
                if (isset($value["sub_query"])) {
                    $sub_query = $value["sub_query"];
                }
            }

            $columns .= ($columns == "") ? "" : ", ";
            $columns .= '`' . ($column) . '`';
            $values .= ($values == "") ? "" : ", ";

            if (is_null($value)) {
                $values .= "null";
            } else if (is_string($value) && $this->is_mysql_func($value)) {
                $values .= $value;
            } else if (is_array($value)) {
                $values .= "( " . $sub_query . " )";
            } else {
                $values .= "'" . $this->_mysqli->real_escape_string($value) . "'";
            }
        }
        $query = "insert IGNORE into $table ($columns) values ($values)";
        return $this->execute_query($query);
    }

    public function update($table, $tableData, $whereData)
    {
        global $gh;
        $columns_values = "";
        foreach ($tableData as $column => $value) {
            $columns_values .= ($columns_values == "") ? "" : ", ";

            $sub_query = "";
            if (is_array($value)) {
                if (isset($value["sub_query"])) {
                    $sub_query = $value["sub_query"];
                }
            }

            if (is_null($value)) {
                $columns_values .= "`$column`= null ";
            } else if (is_string($value) && $this->is_mysql_func($value)) {
                $columns_values .= "`$column`=$value";
            } else if (is_array($value)) {
                $columns_values .= "`$column` = ( " . $sub_query . " )";
            } else {
                $columns_values .= "`$column`='" . $this->_mysqli->real_escape_string($value) . "'";
            }
        }

        $where = "";
        if (is_array($whereData)) {
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND ";

                $sub_query = "";
                if (is_array($value)) {
                    if (isset($value["sub_query"])) {
                        $sub_query = $value["sub_query"];
                    }
                }

                if (is_string($value) && $this->is_mysql_func($value)) {
                    $where .= "`$column`=$value";
                } else if (is_array($value)) {
                    $where .= "`$column` = ( " . $sub_query . " )";
                } else {
                    $where .= " `$column`='" . $this->_mysqli->real_escape_string($value) . "'";
                }
            }
        } else {
            $where = $whereData;
        }
        $query = "UPDATE $table SET " . $columns_values . " WHERE " . $where;
        return $this->execute_query($query);
    }

    public function delete($table, $whereData)
    {
        global $gh;
        if (is_array($whereData)) {
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='" . $this->_mysqli->real_escape_string($value) . "'";
            }
        } else {
            $where = $whereData;
        }
        $gh->Log("query:delete:table=> " . $table . ", where=> " . $where);
        $query = "DELETE FROM " . $table . " WHERE " . $where;
        return $this->execute_query($query);
    }

    public function is_mysql_func($value)
    {
        $pos = strpos($value, "TIMESTAMP");
        if (isset($pos) && $pos > -1) return true;

        $pos = strpos($value, "TIMESTAMPDIFF(");
        if (isset($pos) && $pos > -1) return true;

        return false;
    }

    public function bulk_insert($table, $tableDataList)
    {
        global $gh;

        $columns = "";
        $values = "";
        $bulk_values = "";

        if (count($tableDataList) == 0) {
            return false;
        }

        $i = 0;
        foreach ($tableDataList as $key => $tableData) {
            $values = "";
            foreach ($tableData as $column => $value) {
                if ($i == 0) {
                    $columns .= ($columns == "") ? "" : ", ";
                    $columns .= '`' . ($column) . '`';
                    //$columns .= $column;
                }
                $values .= ($values == "") ? "" : ", ";

                $sub_query = "";
                if (is_array($value)) {
                    if (isset($value["sub_query"])) {
                        $sub_query = $value["sub_query"];
                    }
                }

                if (is_null($value)) {
                    $values .= "null";
                } else if (is_string($value) && $this->is_mysql_func($value)) {
                    $values .= $value;
                } else if (is_array($value)) {
                    $values .= "( " . $sub_query . " )";
                } else {
                    $values .= '"' . $this->_mysqli->real_escape_string($value) . '"';
                }
            }

            $bulk_values .= ($bulk_values == "") ? "" : ", ";
            $bulk_values .= "(" . $values . ")";
            $i++;

            if ($i % 10 == 0 && $i > 0) {
                $query = "insert IGNORE into $table ($columns) values $bulk_values";
                $this->execute_query($query);
                $bulk_values = '';
            }
        }

        if (!empty($bulk_values)) {
            $query = "insert IGNORE into $table ($columns) values $bulk_values";
            return $this->execute_query($query);
        } else {
            return $this->_mysqli->insert_id;
        }
    }

    public function execute_multi($queries)
    {
        global $gh;
        $output = array();
        $cnt = 0;
        $index = 0;
        try {
            $multi_query_string = "";
            if (is_array($queries)) {
                $cnt = count($queries);
                foreach ($queries as $key => $query) {
                    $multi_query_string .= $query . ($gh->endsWith(trim($query), ';') ? "" : ";");
                }
            } else {
                $multi_query_string = $queries;
            }

            $multi_query_string = str_replace("\0", "", $multi_query_string);
            $query_start = $gh->LogQueryStart($multi_query_string);
            $result = array();
            $keys = array_keys($queries);

            /* execute multi query */
            if ($this->_mysqli->multi_query($multi_query_string)) {
                do {
                    $ds = array();
                    /* store first result set */
                    if ($result = $this->_mysqli->store_result()) {
                        while ($row = $result->fetch_assoc()) {
                            $ds[] = $row;
                        }
                        $result->free();
                    }
                    /* print divider */
                    if ($this->_mysqli->more_results()) {
                        // printf("-----------------\n");
                    }
                    $output[$keys[$index]] = $ds;
                    $index++;
                } while ($cnt > $index && $this->_mysqli->more_results() && $this->_mysqli->next_result());
            }

            $gh->LogQueryEnd($query_start);
            $gh->LogQueryResult($output);
        } catch (Exception $e) {
            if (IS_DEVELOPMENT) {
                print_r($e);
            }
            $gh->Log($e);
        }

        return $output;
    }
}
