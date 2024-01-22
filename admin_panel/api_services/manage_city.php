<?php

function manage_city()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");

	if($action == "get_data"){
		$start = $gh->read("start");
		$length = $gh->read("length");
		$searcharr = $gh->read("search");
		$search = $searcharr['value'];
		$orderarr = $gh->read("order");
		$orderindex = $orderarr[0]['column'];
		$orderdir = $orderarr[0]['dir'];
		$columnsarr = $gh->read("columns");
		$ordercolumn = $columnsarr[$orderindex]['name'];

		$whereData = "(
			p.cityname LIKE '%" . $search . "%' 
			or s.statename LIKE '%" . $search . "%' 
			or co.countryname LIKE '%" . $search . "%' 
			)";

		$total_count = $db->get_row_count('tbl_citymaster', "1=1");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT p.id) as cnt FROM tbl_citymaster as p 
		inner join tbl_statemaster s on s.id=p.stateid
		inner join tbl_countrymaster co on co.id=p.countryid
			WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = " ORDER BY p.entry_date desc";
		if ($orderindex >0) {
			$orderby = " ORDER BY " . $ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT p.*,p.id AS md5_id,s.statename,co.countryname
			FROM tbl_citymaster as p 
			inner join tbl_countrymaster co on co.id=p.countryid
			inner join tbl_statemaster s on s.id=p.stateid
			WHERE " . $whereData . " " . $orderby . " LIMIT " . $start . "," . $length . "";
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
	}
	else if($action == "add_data"){
		$id = $gh->read("id");
		$formevent = $gh->read("formevent");
		$user_id = $gh->read("user_id", 0);
		$countryid = $gh->read("countryid");
		$stateid = $gh->read("stateid");
		$cityname = $gh->read("cityname");
		$date = date('Y-m-d H:i:s');
		if ($cityname && $stateid) {
			if($formevent== 'submit')
			{
				$query = "SELECT * FROM tbl_citymaster where cityname='$cityname'";
				$filtered_count = $db->execute($query);
				if(sizeof($filtered_count) > 0)
				{
					$outputjson['success'] = 0;
					$outputjson['message'] = "Data Already Exist";
				}else{
					$id=$gh->generateuuid();
					$data = array(
						"id" => $id,
						"countryid" => $countryid,
						"stateid" => $stateid,
						"cityname" => $cityname,
						"entry_uid" => $user_id,
						"entry_date" => $date,
					);
					$db->insert("tbl_citymaster", $data);
			
					$outputjson['result'] = [];
					$outputjson['success'] = 1;
					$outputjson['message'] = "Data added successfully";
				}
			}else{
				$query = "SELECT * FROM tbl_citymaster where cityname='$cityname'AND id <> '$id'";
				$filtered_count = $db->execute($query);
				if(sizeof($filtered_count) > 0)
				{
					$outputjson['success'] = 0;
					$outputjson['message'] = "Data Already Exist";
				}else{
					$data = array(
						"cityname" => $cityname,
						"stateid" => $stateid,
						"countryid" => $countryid,
						"update_uid" => $user_id,
						"update_date" => $date,
					);
					$rows = $db->update('tbl_citymaster', $data, array("id" => $id));
		
					$outputjson['success'] = 1;
					$outputjson['message'] = 'Data updated successfully.';
				}
			}
			
		} else {
			$outputjson['message'] = "Please add Rates Category!";
		}
	}
}
