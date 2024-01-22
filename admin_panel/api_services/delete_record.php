<?php

function delete_record()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$type = $gh->read("type");
	$id = $gh->read("id");
	if($type=='manage_roles')
	{
		if ($id > 0) {
			$db->delete('tbl_roles', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_usermaster')
	{
		if ($id > 0) {
			$db->delete('tbl_users', array("id" => $id));
			$db->delete('tbl_userrole', array("userid" => $id));
			$db->delete('tbl_user_cmp', array("userid" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_financialyear')
	{
		if ($id > 0) {
			$db->delete('tbl_financialyear', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_states')
	{
		if ($id > 0) {
			$db->delete('tbl_statemaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_country')
	{
		if ($id > 0) {
			$db->delete('tbl_countrymaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_city')
	{
		if ($id > 0) {
			$db->delete('tbl_citymaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_color')
	{
		if ($id > 0) {
			$db->delete('tbl_colormaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_accountgroup')
	{
		if ($id > 0) {
			$db->delete('tbl_acountgroup', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_category')
	{
		if ($id > 0) {
			$db->delete('tbl_categorymaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_product')
	{
		if ($id > 0) {
			$db->delete('tbl_productmaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_company')
	{
		if ($id > 0) {
			$db->delete('tbl_companymaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_unit')
	{
		if ($id > 0) {
			$db->delete('tbl_unitmaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_ledger')
	{
		if ($id > 0) {
			$db->delete('tbl_users', array("id" => $id));
			$db->delete('tbl_user_cmp', array("userid" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='user')
	{
		if ($id > 0) {
			$db->delete('tbl_users', array("id" => $id));
			$db->delete('tbl_user_cmp', array("userid" => $id));
			$db->delete('tbl_usersite', array("userid" => $id));
			$db->delete('tbl_userrole', array("userid" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_purchase')
	{
		if ($id > 0) {
			$db->delete('tbl_purchasemaster', array("id" => $id));
			$db->delete('tbl_purchase_detail', array("purchase_id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_series')
	{
		if ($id > 0) {
				$db->delete('tbl_seriesmaster', array("id" => $id));
				$db->delete('tbl_series_wise_attributes', array("userid" => $id));
				$outputjson['message'] = 'data deleted successfully.';
				$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_testimonial')
	{
		if ($id > 0) {

			$db->delete('tbl_testimonialmaster', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_termsandcondition')
	{
		if ($id > 0) {

			$db->delete('tbl_termsandconditions', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='receipt')
	{
		if ($id > 0) {
				$db->delete('tbl_payment', array("id" => $id));
				$db->delete('tbl_paymentapprovel', array("paymentid" => $id));
				$outputjson['message'] = 'data deleted successfully.';
				$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
}
