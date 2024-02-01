<?php

function manage_homepage()
{
	global $outputjson, $gh, $db, $const;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");

	if($action == "get_data")
	{
		$qry_slider="SELECT * FROM tbl_slidermaster
		WHERE `isactive`=1 ORDER BY `orderno`+0 ASC";
		$rows_slider = $db->execute($qry_slider);
		if ($rows_slider != null && is_array($rows_slider) && count($rows_slider) > 0) {	
			$outputjson["slider"] = $rows_slider;
		}

		$qry_testimonial="SELECT *, DATE_FORMAT(tdate, '%M %d, %Y') AS disp_date FROM tbl_testimonialmaster WHERE `isactive`=1 ORDER BY `orderno`+0 ASC";
		$rows_testimonial = $db->execute($qry_testimonial);
		if ($rows_testimonial != null && is_array($rows_testimonial) && count($rows_testimonial) > 0) {	
			$outputjson["testimonial"] = $rows_testimonial;
		}
		
		$qry_brand="SELECT * FROM tbl_brand";
		$rows_brand = $db->execute($qry_brand);
		if ($rows_brand != null && is_array($rows_brand) && count($rows_brand) > 0) {	
			$outputjson["brand"] = $rows_brand;
		}
		
		$qry_fule="SELECT * FROM tbl_cars WHERE fule_type = '$const->petrol_fule_id' OR fule_type = '$const->diesel_fule_id' LIMIT 4";
		$rows_fule = $db->execute($qry_fule);
		if ($rows_fule != null && is_array($rows_fule) && count($rows_fule) > 0) {	
			$outputjson["fule_car"] = $rows_fule;
		}
		
		$qry_ev="SELECT * FROM tbl_cars WHERE fule_type = '$const->ev_fule_id' LIMIT 4";
		$rows_ev = $db->execute($qry_ev);
		if ($rows_ev != null && is_array($rows_ev) && count($rows_ev) > 0) {	
			$outputjson["ev_car"] = $rows_ev;
		}
		
		$qry_hybrid="SELECT * FROM tbl_cars WHERE fule_type = '$const->hybrid_fule_id' LIMIT 4";
		$rows_hybrid = $db->execute($qry_hybrid);
		if ($rows_hybrid != null && is_array($rows_hybrid) && count($rows_hybrid) > 0) {	
			$outputjson["hybrid_car"] = $rows_hybrid;
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'success.';
	}
	else if($action == "get_car_list")
	{
		$list_type = $gh->read("list_type","");
		$id = $gh->read("id","");
		$heading = "";

		$status = 0;
		$message = "No Cars Found.";
		$where = "";
		if($list_type == "BRAND"){
			$where="WHERE brand = '$id'";
			$qry_brand = "SELECT brand FROM `tbl_brand` WHERE id = '$id'";
			$heading = $db->execute_scalar($qry_brand);
		}
		if($list_type == "FUEL"){
			if($id == $const->fule_type_fuel_txt){
				$where="WHERE fule_type = '$const->petrol_fule_id' OR fule_type = '$const->diesel_fule_id'";
				$heading = "Fuel Cars";
			}
			else if($id == $const->fule_type_fuel_txt){
				$where="WHERE fule_type = '$const->ev_fule_id'";
				$heading = "EV Cars";
			}
			else if($id == $const->fule_type_fuel_txt){
				$where="WHERE fule_type = '$const->hybrid_fule_id'";
				$heading = "Hybrid Cars";
			}
		}

		$qry_car="SELECT * FROM tbl_cars $where";
		$rows_car = $db->execute($qry_car);
		if ($rows_car != null && is_array($rows_car) && count($rows_car) > 0) {	
			$outputjson["data"] = $rows_car;
			$status = 1;
			$message = "success.";
		}
		$outputjson['heading'] = $heading;
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
	}
}
