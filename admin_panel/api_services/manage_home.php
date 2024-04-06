<?php

function manage_home()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_cars")
	{
		$query_cars = "SELECT id, fule_type, comming_soon, name FROM tbl_cars";
		$rows = $db->execute($query_cars);

		if ($rows != null && is_array($rows) && count($rows) > 0) {
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson["data"] = [];
			$outputjson['message'] = "No Products found!";
		}
	}
	else if($action == "add_data")
	{
		$user_id = $gh->read("user_id", 0);
		$list_type = $gh->read("list_type");
		$car_list = $gh->read("car_list");
		$date = date('Y-m-d H:i:s');

		$db->delete("tbl_home_manage", array("list_type"=>$list_type));
		if($car_list && $car_list != "" && $car_list != "[]"){
			$list = json_decode(str_replace('\\','',$car_list), true);
			foreach ($list as $key => $car) {
				$id=$gh->generateuuid();
				$data = array(
					"id" => $id,
					"list_type" => $list_type,
					"car_id" => $car['id'],
					"car_name" => $car['name'],
					"entry_uid" => $user_id,
					"entry_date" => $date,
				);
				$db->insert("tbl_home_manage", $data);
			}
		}
		$outputjson['data'] = json_decode(str_replace('\\','',$car_list), true);
		$outputjson['success'] = 1;
		$outputjson['message'] = 'Data updated successfully.';
	}
	else if($action == "get_data")
	{
		$list_type = $gh->read("list_type");
		$query = "SELECT * FROM tbl_home_manage WHERE list_type = " . $list_type;
		$rows = $db->execute($query);
		if ($rows != null && is_array($rows) && count($rows) > 0) {
			
			$outputjson['data'] = $rows;
			$outputjson['success'] = 1;
			$outputjson['message'] = 'Success.';
		}else{
			$outputjson['message'] = 'No data found.';
			
		} 
	}
}
