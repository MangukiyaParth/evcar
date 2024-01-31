<?php

function delete_all_record()
{
	global $outputjson, $gh, $db;
	
	$type = $gh->read("type");
	$outputjson['success'] = 0;

	if($type=='manage_brand')
	{
		$gh->removeFolder("brand", 0);
		$db->execute_query('TRUNCATE TABLE tbl_brand');
	}
	else if($type=='manage_slider')
	{
		$gh->removeFolder("slider", 0);
		$db->execute_query('TRUNCATE TABLE tbl_slidermaster');
	}
	else if($type=='manage_testimonial')
	{
		$gh->removeFolder("testimonial", 0);
		$db->execute_query('TRUNCATE TABLE tbl_testimonialmaster');
	}
	else if($type=='manage_car')
	{
		$gh->removeFolder("cars", 0);
		$db->execute_query('TRUNCATE TABLE tbl_cars');
		$db->execute_query('TRUNCATE TABLE tbl_cars_colors');
		$db->execute_query('TRUNCATE TABLE tbl_cars_verient');
	}
	else if($type=='manage_news')
	{
		$gh->removeFolder("news", 0);
		$db->execute_query('TRUNCATE TABLE tbl_news');
	}

	$outputjson['message'] = 'all data deleted successfully.';
	$outputjson['success'] = 1;
}
