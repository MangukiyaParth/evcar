<?php

function manage_role()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_data")
	{ 
		$start = $gh->read("start");
		$length = $gh->read("length");
		$searcharr = $gh->read("search");
		$search = $searcharr['value'];
		$orderarr = $gh->read("order");
		$orderindex = $orderarr[0]['column'];
		$orderdir = $orderarr[0]['dir'];
		$columnsarr = $gh->read("columns");
		$ordercolumn = $columnsarr[$orderindex]['name'];
		
		$whereData = "(r.role LIKE '%" . $search . "%')";

		$total_count = $db->get_row_count('tbl_roles', "id!='17019350-1059-3172-f8de-9c507e9e4901'");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT r.id) as cnt FROM tbl_roles as r 
			WHERE id!='17019350-1059-3172-f8de-9c507e9e4901' AND " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT r.*,
			IFNULL((SELECT COUNT(id) FROM `tbl_userrole` WHERE roleid = r.`id`), 0) AS user_cnt
			FROM tbl_roles as r
			WHERE id!='17019350-1059-3172-f8de-9c507e9e4901' AND " . $whereData . " " . $orderby . " LIMIT " . $start . "," . $length . "";
		$rows = $db->execute($query_port_rates);

		if ($rows != null && is_array($rows) && count($rows) > 0) {
			
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = $filtered_count;
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson["data"] = [];
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = 0;
			$outputjson['message'] = "No Products found!";
		}
	}else if($action == "add_data")
	{
		$id = $gh->read("id");
		$role = $gh->read("role");
		$formevent = $gh->read("formevent");

		if($formevent =='submit'){
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"role" => $role
			);
			$db->insert("tbl_roles", $data);

			$outputjson['result'] = [];
			$outputjson['success'] = 1;
			$outputjson['message'] = "Data added successfully";
		}else{
			if ($id != "") {
				$data = array(
					"role" => $role
				);
				$rows = $db->update('tbl_roles', $data, array("id" => $id));

				$outputjson['success'] = 1;
				$outputjson['message'] = 'Data updated successfully.';
				$outputjson["data"] = $rows;
			} 
		} 
	}else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}
