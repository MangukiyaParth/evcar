<?php

function delete_record()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$type = $gh->read("type");
	$id = $gh->read("id");
	if($type=='manage_brand')
	{
		if ($id > 0) {
			$gh->removeFolder("brand", $id);

			$db->delete('tbl_brand', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_slider')
	{
		if ($id > 0) {
			$gh->removeFolder("slider", $id);

			$db->delete('tbl_slidermaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_testimonial')
	{
		if ($id > 0) {
			$gh->removeFolder("testimonial", $id);

			$db->delete('tbl_testimonialmaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_car')
	{
		if ($id > 0) {
			$gh->removeFolder("cars", $id);

			$db->delete('tbl_cars', array("id" => $id));
			$db->delete('tbl_cars_colors', array("car_id" => $id));
			$db->delete('tbl_cars_verient', array("car_id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_news')
	{
		if ($id > 0) {
			$gh->removeFolder("news", $id);

			$db->delete('tbl_news', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	
}
