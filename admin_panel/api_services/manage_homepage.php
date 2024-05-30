<?php

function manage_homepage()
{
	global $outputjson, $gh, $db, $const;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;

	$action = $gh->read("action");

	$collection = "";
	if(IS_PRODUCTION){
		$collection = "COLLATE utf8mb4_general_ci";
	}

	if($action == "get_data")
	{
		$qry_slider="SELECT * FROM tbl_slidermaster WHERE `isactive`=1 ORDER BY `orderno`+0 ASC";
		$rows_slider = $db->execute($qry_slider);
		if ($rows_slider != null && is_array($rows_slider) && count($rows_slider) > 0) {	
			$outputjson["slider"] = $rows_slider;
		}

		$qry_testimonial="SELECT *, DATE_FORMAT(tdate, '%M %d, %Y') AS disp_date FROM tbl_testimonialmaster WHERE `isactive`=1 ORDER BY `orderno`+0 ASC";
		$rows_testimonial = $db->execute($qry_testimonial);
		if ($rows_testimonial != null && is_array($rows_testimonial) && count($rows_testimonial) > 0) {	
			$outputjson["testimonial"] = $rows_testimonial;
		}
		
		$qry_brand="SELECT *, remove_spacialcharacter(brand) as encode_name FROM tbl_brand";
		$rows_brand = $db->execute($qry_brand);
		if ($rows_brand != null && is_array($rows_brand) && count($rows_brand) > 0) {	
			$outputjson["brand"] = $rows_brand;
		}
		
		$qry_ev="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars WHERE id IN (SELECT car_id FROM `tbl_home_manage` WHERE list_type = 1)";
		$rows_ev = $db->execute($qry_ev);
		if ($rows_ev != null && is_array($rows_ev) && count($rows_ev) > 0) {	
			$outputjson["ev_car"] = $rows_ev;
		}
		
		$qry_hybrid="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars WHERE id IN (SELECT car_id FROM `tbl_home_manage` WHERE list_type = 2)";
		$rows_hybrid = $db->execute($qry_hybrid);
		if ($rows_hybrid != null && is_array($rows_hybrid) && count($rows_hybrid) > 0) {	
			$outputjson["hybrid_car"] = $rows_hybrid;
		}

		$qry_fule="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars WHERE id IN (SELECT car_id FROM `tbl_home_manage` WHERE list_type = 3)";
		$rows_fule = $db->execute($qry_fule);
		if ($rows_fule != null && is_array($rows_fule) && count($rows_fule) > 0) {	
			$outputjson["fule_car"] = $rows_fule;
		}
		
		$qry_tranding="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars WHERE id IN (SELECT car_id FROM `tbl_home_manage` WHERE list_type = 4)";
		$rows_tranding = $db->execute($qry_tranding);
		if ($rows_tranding != null && is_array($rows_tranding) && count($rows_tranding) > 0) {	
			$outputjson["tranding_car"] = $rows_tranding;
		}
		
		$qry_upcoming="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars WHERE id IN (SELECT car_id FROM `tbl_home_manage` WHERE list_type = 5)";
		$rows_upcoming = $db->execute($qry_upcoming);
		if ($rows_upcoming != null && is_array($rows_upcoming) && count($rows_upcoming) > 0) {	
			$outputjson["upcoming_car"] = $rows_upcoming;
		}
		
		$qry_news="SELECT *, DATE_FORMAT(STR_TO_DATE(news_date,'%d/%m/%Y'),'%M %d, %Y') as disp_date FROM tbl_news ORDER BY STR_TO_DATE(news_date,'%d/%m/%Y') DESC LIMIT 6";
		$rows_news = $db->execute($qry_news);
		if ($rows_news != null && is_array($rows_news) && count($rows_news) > 0) {	
			$outputjson["news"] = $rows_news;
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'success.';
	}
	else if($action == "get_brand_list")
	{
		$qry_brand="SELECT *, remove_spacialcharacter(brand) as encode_name FROM tbl_brand";
		$rows_brand = $db->execute($qry_brand);
		if ($rows_brand != null && is_array($rows_brand) && count($rows_brand) > 0) {	
			$outputjson["brand"] = $rows_brand;
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'success.';
	}
	else if($action == "get_car_list")
	{
		$sorting = $gh->read("sorting","0");
		$brand_filter = $gh->read("brand_filter","");
		$fuel_filter = $gh->read("fuel_filter","");
		$search = $gh->read("search","");
		$heading = "";

		$status = 0;
		$message = "No Cars Found.";
		$where = " WHERE 1=1 ";
		if($brand_filter != ""){
			$where .= " AND remove_spacialcharacter(brand_name) $collection IN ('".str_replace(",","','",$brand_filter)."') ";
		}
		if($fuel_filter != ""){
			$where .= " AND fule_type IN ('".str_replace(",","','",$fuel_filter)."') ";
		}
		if($search != ""){
			$where .= " AND REPLACE(`name`,' ','-') IN ('".$search."') ";
		}
		
		$orderby = "";
		if((int)$sorting == 1){
			$orderby = " ORDER BY price ASC";
		}
		else if((int)$sorting == 2){
			$orderby = " ORDER BY price DESC";
		}

		$qry_car="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars $where $orderby";
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
	else if($action == "get_car_details")
	{
		$name = $gh->read("id","");
		$status = 0;
		$message = "No Detail Found.";
		$qry_car="SELECT *, remove_spacialcharacter(brand_name) as encode_brand_name FROM car_details WHERE remove_spacialcharacter(name) $collection = '$name'";
		$rows_car = $db->execute($qry_car);
		if ($rows_car != null && is_array($rows_car) && count($rows_car) > 0) {	
			$id = $rows_car[0]['id'];
			if($rows_car[0]['main_car_id'] != ""){
				$car_id = $rows_car[0]['main_car_id'];
				$qry_car_verient="SELECT *, remove_spacialcharacter(name) as encode_name FROM car_details WHERE (id $collection = '$car_id' OR main_car_id $collection = '$car_id') AND id $collection != '$id'";
			}
			else{
				$qry_car_verient="SELECT *, remove_spacialcharacter(name) as encode_name FROM car_details WHERE main_car_id $collection = '$id'";
			}
			$rows_car_verient = $db->execute($qry_car_verient);
			if ($rows_car_verient != null && is_array($rows_car_verient) && count($rows_car_verient) > 0) {	
				$rows_car[0]['vdata'] = json_encode($rows_car_verient);
			}
			$outputjson["data"] = $rows_car[0];
			$status = 1;
			$message = "success.";
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
	}
	else if($action == "get_news_list"){
		$status = 0;
		$message = "No news Found.";
		
		$qry_news="SELECT *, DATE_FORMAT(STR_TO_DATE(news_date,'%d/%m/%Y'),'%M %d, %Y') as disp_date FROM tbl_news ORDER BY STR_TO_DATE(news_date,'%d/%m/%Y') DESC";
		$rows_news = $db->execute($qry_news);
		if ($rows_news != null && is_array($rows_news) && count($rows_news) > 0) {	
			$outputjson["data"] = $rows_news;
			$status = 1;
			$message = "success.";
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
	}
	else if($action == "get_news_details"){
		$status = 0;
		$message = "No news Found.";
		$title = $gh->read("title","");
		$id = $gh->read("id");
		
		// $qry_news="SELECT *, DATE_FORMAT(STR_TO_DATE(news_date,'%d/%m/%Y'),'%M %d, %Y') as disp_date FROM tbl_news WHERE id = '$id'";
		$qry_news = 'SELECT *, DATE_FORMAT(STR_TO_DATE(news_date,"%d/%m/%Y"),"%M %d, %Y") as disp_date FROM tbl_news WHERE sub_title = "'.$title.'"';
		$rows_news = $db->execute($qry_news);
		if ($rows_news != null && is_array($rows_news) && count($rows_news) > 0) {	
			$outputjson["data"] = $rows_news[0];
			$status = 1;
			$message = "success.";
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
	}
	else if($action == "get_car_suggestion")
	{
		$search = $gh->read("search","");
		$heading = "";

		$status = 0;
		$message = "No Cars Found.";
		$qry_car="SELECT *, remove_spacialcharacter(name) as encode_name FROM tbl_cars WHERE LOWER(`name`) LIKE LOWER('%$search%')";
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
	else if($action == "add_subscriber")
	{
		$sub_email = $gh->read("sub_email","");
		$date = date('Y-m-d H:i:s');
		$heading = "";

		$status = 0;
		
		$qry_car="SELECT * FROM tbl_subscriber WHERE email = '$sub_email'";
		$rows_car = $db->execute($qry_car);
		if ($rows_car != null && is_array($rows_car) && count($rows_car) > 0) {	
			$message = "You are already subscribe with EV Cars.";
		}
		else{
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"email" => $sub_email,
				"entry_date" => $date,
			);
			$db->insert("tbl_subscriber", $data);
			$status = 1;
			$message = "success.";
		}
		$outputjson['heading'] = $heading;
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
	}
}
