<?php

function get_details()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_data")
	{
		$query_brand = "SELECT * FROM tbl_brand";
		$brand_rows = $db->execute($query_brand);
		$query_car_type = "SELECT * FROM tbl_car_type";
		$car_type_rows = $db->execute($query_car_type);
		$query_fules = "SELECT * FROM tbl_fules";
		$fules_rows = $db->execute($query_fules);
		$query_transmision = "SELECT * FROM tbl_transmision";
		$transmision_rows = $db->execute($query_transmision);


		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'success.';
		$outputjson["data"] = $brand_rows;
		$outputjson["brand"] = $brand_rows;
		$outputjson["car_type"] = $car_type_rows;
		$outputjson["fules"] = $fules_rows;
		$outputjson["transmision"] = $transmision_rows;
	}
	else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}
