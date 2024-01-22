<?php

function delete_all_record()
{
	global $outputjson, $gh, $db;
	
	$type = $gh->read("type");
	$outputjson['success'] = 0;
	if($type == 'manage_roles')
	{
		$db->execute_query('TRUNCATE TABLE tbl_roles');
	}
	else if($type == 'manage_usermaster')
	{
		$db->execute_query('TRUNCATE TABLE tbl_users');
		$db->execute_query('TRUNCATE TABLE tbl_userrole');
		$db->execute_query('TRUNCATE TABLE tbl_user_cmp');
	}
	else if($type == 'manage_ledger')
	{
		$db->execute_query('TRUNCATE TABLE tbl_users');
		$db->execute_query('TRUNCATE TABLE tbl_userrole');
		$db->execute_query('TRUNCATE TABLE tbl_user_cmp');
	}
	else if($type == 'manage_product')
	{
		$db->execute_query('TRUNCATE TABLE tbl_productmaster');
	}
	else if($type == 'manage_financialyear')
	{
		$db->execute_query('TRUNCATE TABLE tbl_financialyear');
	}
	else if($type == 'manage_states')
	{
		$db->execute_query('TRUNCATE TABLE tbl_statemaster');
	}
	else if($type == 'manage_city')
	{
		$db->execute_query('TRUNCATE TABLE tbl_citymaster');
	}	
	else if($type == 'unit')
	{
		$db->execute_query('TRUNCATE TABLE tbl_unitmaster');
	}
	else if($type == 'grade')
	{
		$db->execute_query('TRUNCATE TABLE tbl_grademaster');
	}
	else if($type == 'tax')
	{
		$db->execute_query('TRUNCATE TABLE tbl_taxmaster');
	}
	else if($type == 'manage_accountgroup')
	{
		$db->execute_query('TRUNCATE TABLE tbl_acountgroup');
	}
	else if($type == 'manage_category')
	{
		$db->execute_query('TRUNCATE TABLE tbl_categorymaster');
	}
	else if($type == 'manage_company')
	{
		$db->execute_query('TRUNCATE TABLE tbl_companymaster');
	}
	else if($type == 'head')
	{
		$db->execute_query('TRUNCATE TABLE tbl_headmaster');
	}
	else if($type == 'subhead')
	{
		$db->execute_query('TRUNCATE TABLE tbl_subheadmaster');
	}
	else if($type == 'invester')
	{
		$db->execute_query('TRUNCATE TABLE tbl_investermaster');
	}
	else if($type == 'site')
	{
		$db->execute_query('TRUNCATE TABLE tbl_sitemaster');
	}
	$outputjson['message'] = 'all data deleted successfully.';
	$outputjson['success'] = 1;
}
