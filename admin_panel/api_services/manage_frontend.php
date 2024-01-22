<?php

function manage_frontend()
{
	global $outputjson, $gh, $db, $loggedin_user, $const, $ud, $at;
	$outputjson['success'] = 0;
	$outputjson['status'] = 0;
	$login_uid = (!empty($loggedin_user)) ? $loggedin_user['id'] : "";
	$action = $gh->read("action");
	$date = date('Y-m-d H:i:s');
	$from = $gh->read("from", FRONTEND_CONSTANT);

	if($action == "product_details")
	{
		$id = $gh->read("id");
		$str='0';
		$str2='0';
		if(!empty($loggedin_user))
		{
			$uid=$loggedin_user['id'];
			$str="IFNULL((SELECT 1 FROM `tbl_saledetails` sd INNER JOIN `tbl_salemaster` sm ON sm.id=sd.sid WHERE sd.productid=pm.`id` AND sm.personid='$uid' ORDER BY entry_date DESC LIMIT 1,1),0)";
			$str2="IFNULL((SELECT 1 FROM `tbl_reveiw` sd WHERE sd.productid=pm.`id` AND sd.entry_uid='$uid' ORDER BY entry_date DESC LIMIT 1,1),0)";
		}
		$qry_product="SELECT pm.*,
		IFNULL((SELECT count(id) as cnt FROM `tbl_reveiw` sd WHERE sd.productid=pm.`id`),0) AS receiwcnt,
		IFNULL((SELECT count(id) as cnt FROM `tbl_wishlist` wl WHERE wl.productid=pm.`id` AND wl.personid = '$login_uid'),0) AS in_wishlist,
		IFNULL((SELECT CEIL(SUM(rating)/COUNT(id)) as cnt FROM `tbl_reveiw` sd WHERE sd.productid=pm.`id`),0) AS avgrating,
		$str AS personproductchk,
		$str2 AS reveiwadded,
		IFNULL((SELECT GROUP_CONCAT(tc.colorname SEPARATOR '  /  ') FROM tbl_productcolor pc inner join tbl_colormaster tc on tc.id=pc.colorid WHERE pc.productid=pm.`id`),0) AS colorname, 
		IFNULL((SELECT GROUP_CONCAT(i.sub_file) FROM tbl_productimg i WHERE i.productid=pm.`id`),0) AS other_img 
		FROM `tbl_productmaster` pm
		WHERE pm.id='$id'";
		$row_product=$db->execute($qry_product);
		if ($row_product != null && is_array($row_product) && count($row_product) > 0) {
			$qry_review="SELECT sd.*,pm.name,date_format(sd.entry_date,'%d %M, %Y') as datef
			FROM `tbl_reveiw` sd 
			inner join tbl_users pm on pm.id=sd.entry_uid
			WHERE sd.productid='$id'";
			$row_review=$db->execute($qry_review);
			$row_product[0]['reviews'] = $row_review;
			
			$qry_related="SELECT pm.*, IFNULL((SELECT count(id) as cnt FROM `tbl_wishlist` wl WHERE wl.productid=pm.`id` AND wl.personid = '$login_uid'),0) AS in_wishlist
			FROM `tbl_productmaster` pm
			WHERE STR_TO_DATE(pm.`realese_date`,'%d/%m/%Y') <= CURDATE() AND pm.id <> '$id'";
			$row_related=$db->execute($qry_related);
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $row_product;
			$outputjson["related"] = $row_related;
		} else {
			$outputjson["data"] = [];
			$outputjson['message'] = "No Product found!";
		}
	}
	else if($action == "signup"){
		$firstname = $gh->read("firstname");
		$lastname = $gh->read("lastname");
		$contact = $gh->read("contact");
		$email = $gh->read("email");
		$passw = $gh->read("passw");

		if($firstname && $lastname && $email && $passw){
			$user_id=$gh->generateuuid();
			$ins_data = array(
				"id" => $user_id,
				"firstname" => $firstname,
				"lastname" => $lastname,
				"name" => $firstname.' '.$lastname,
				"contact" => $contact,
				"email" => $email,
				"username" => $email,
				"password" => md5($passw),
				"isledger" => 0,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$res = $db->insert("tbl_users", $ins_data);

			$urid=$gh->generateuuid();
			$data_role = array(
				"id" => $urid,
				"userid" => $user_id,
				"roleid" => $const->customer_role_id,
			);
			$db->insert("tbl_userrole", $data_role);

			$rows = getUserDetailsforSession($user_id);
			if ($rows != null) {
				$user = $rows;
				$user_id = $user['id'];
				
				// remove password from user object
				unset($user["password"]);
				unset($user["otp"]);
				
				$ud->setUser($user);
				$token_data = $gh->getjwt($user['id'], $from);
				if($token_data['status'] == "1")
				{
					$at->setToken($token_data['token']);
				}
			}
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $res;
		}
		else{
			$outputjson["data"] = [];
			$outputjson['message'] = "Please add all fields!";
		}
	}
	else if($action == "update_profile"){
		$firstname = $gh->read("firstname");
		$lastname = $gh->read("lastname");
		$contact = $gh->read("contact");

		if($firstname && $lastname){
			$ins_data = array(
				"firstname" => $firstname,
				"lastname" => $lastname,
				"name" => $firstname.' '.$lastname,
				"contact" => $contact,
				"update_uid" => $login_uid,
				"update_date" => $date,
			);
			$res = $db->update("tbl_users", $ins_data, array("id"=>$login_uid));

			$rows = getUserDetailsforSession($login_uid);

			if ($rows != null) {
				$user = $rows;
				$user_id = $user['id'];
				
				// remove password from user object
				unset($user["password"]);
				unset($user["otp"]);
				
				$ud->setUser($user);
			}
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $res;
		}
		else{
			$outputjson["data"] = [];
			$outputjson['message'] = "Please add all fields!";
		}
	}
	else if($action == "update_password"){
		$old_password = $gh->read("old_password");
		$new_password = $gh->read("new_password");
		$contact = $gh->read("contact");

		if($old_password && $new_password){
			$userData = getUsersDetails($login_uid, false);
			if($userData['password'] == md5($old_password))
			{
				$ins_data = array(
					"password" => md5($new_password),
					"update_uid" => $login_uid,
					"update_date" => $date,
				);
				$res = $db->update("tbl_users", $ins_data, array("id"=>$login_uid));

				$outputjson['success'] = 1;
				$outputjson['status'] = 1;
				$outputjson['message'] = 'success.';
				$outputjson["data"] = $res;
			}
			else{
				$outputjson["data"] = [];
				$outputjson['message'] = "You have entered wrong old password!";
			}
		}
		else{
			$outputjson["data"] = [];
			$outputjson['message'] = "Please add all fields!";
		}
	}
	else if($action == "get_user_address"){
			$rows = getUserDetailsforSession($login_uid);
			$user = [];
			if ($rows != null) {
				$user = $rows;
				$user_id = $user['id'];
				
				// remove password from user object
				unset($user["password"]);
				unset($user["otp"]);
			}
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $user;
	}
	else if($action == "get_states"){
		$query_user = "SELECT * FROM `tbl_statemaster` ORDER BY statename asc";
		$rows = $db->execute($query_user);
		if ($rows != null && is_array($rows) && count($rows) > 0) {
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson['message'] = 'No states found.';
		}
	}
	else if($action == "update_address"){
		$address = $gh->read('address');
		$cityname = $gh->read('cityname');
		$postcode = $gh->read('postcode');
		$stateid = $gh->read('stateid');
		$state = $gh->read('state');

		if($address && $cityname && $stateid && $postcode){
			$ins_data = array(
				"address" => $address,
				"cityname" => $cityname,
				"pincode" => $postcode,
				"stateid" => $stateid,
				"statename" => $state,
				"update_uid" => $login_uid,
				"update_date" => $date,
			);
			$res = $db->update("tbl_users", $ins_data, array("id"=>$login_uid));

			$rows = getUserDetailsforSession($login_uid);
			if ($rows != null) {
				$user = $rows;
				$user_id = $user['id'];
				
				// remove password from user object
				unset($user["password"]);
				unset($user["otp"]);
				
				$ud->setUser($user);
			}
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $res;
		}
		else{
			$outputjson["data"] = [];
			$outputjson['message'] = "Please add all fields!";
		}
	}
	else if($action == "add_to_wishlist"){
		$typeid = $gh->read('typeid');
		$productid = $gh->read('productid');
		$pqty = $gh->read('pqty');
		$qry_chk = "SELECT id from tbl_wishlist where productid='$productid' and personid='$login_uid'";
		$chk_id = $db->execute_scalar($qry_chk);
		$added = 0;
		if($chk_id && $chk_id != "")
		{
			$db->delete('tbl_wishlist',array("personid"=>$login_uid,"productid"=>$productid));  
			$status=1;
			$message='Item succeessfully removed from wishlist';
		}
		else{
			$wlid = $gh->generateuuid();
			$insdata = array(
				'id'=>$wlid,
				'personid'=>$login_uid,
				'productid'=>$productid,
				'entry_uid'=>$login_uid,
				'entry_date'=>date('Y-m-d H:i:s'),
			);
			$db->insert('tbl_wishlist',$insdata);
			$added = 1;
			$status=1;
			$message='Item succeessfully added in wishlist';
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['added'] = $added;
		$outputjson['message'] = $message;
		$outputjson["data"] = [];
	}
	else if($action == "add_to_cart"){
		$typeid = $gh->read('typeid');
		$productid = $gh->read('productid');
		$pqty = $gh->read('pqty');
		$qry_chk = "SELECT qty from tbl_cart where productid='$productid' and personid='$login_uid'";
		$qty = $db->execute_scalar($qry_chk);
		$newqty = 0;
		if($qty && $qty > 0)
		{
			if($typeid == 2)
			{
				$status=0;
				$message='This Item already in cart '; 
			}else{
				$newqty=$qty+$pqty;
				$insdata = array(
					'qty'=>$newqty,
					'update_uid'=>$login_uid,
					'update_date'=>date('Y-m-d H:i:s'),
				);
				$db->update('tbl_cart',$insdata,array("personid"=>$login_uid,"productid"=>$productid));  
				$status=1;
				$message='Item succeessfully Updeted in cart ';
			}
		}
		else{
			$newqty = $pqty;
			$cid = $gh->generateuuid();
			$insdata = array(
				'id'=>$cid,
				'personid'=>$login_uid,
				'productid'=>$productid,
				'qty'=>$pqty,
				'entry_uid'=>$login_uid,
				'entry_date'=>date('Y-m-d H:i:s'),
			);
			$db->insert('tbl_cart',$insdata);
			$status=1;
			$message='Item succeessfully added in cart ';
		}
		$product_data = [];
		if($newqty > 0){
			$qry_product = "SELECT * from tbl_productmaster where id='$productid'";
			$row_product = $db->execute($qry_product);
			$product_data = $row_product[0];
			$product_data['qty'] = $newqty;
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
		$outputjson["data"] = $product_data;
	}
	else if($action == "remove_from_cart"){
		$productid = $gh->read('productid');
		$qry_chk = "SELECT id from tbl_cart where productid='$productid' and personid='$login_uid'";
		$row_chk = $db->execute_scalar($qry_chk);
		if($row_chk && $row_chk != "")
		{
			$db->delete('tbl_cart',array("personid"=>$login_uid,"productid"=>$productid));  
			$status=1;
			$message='Item succeessfully removed from cart';
		}
		else{
			$status = 0;
			$message = "No item Found in your cart";
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
		$outputjson["data"] = [];
	}
	else if($action == "get_cart_data"){
		$qry_product = "SELECT p.*, c.`qty`  FROM tbl_cart c INNER JOIN tbl_productmaster p ON p.`id`=c.`productid` WHERE c.`personid` = '$login_uid'";
		$row_product = $db->execute($qry_product);
		if ($row_product != null && is_array($row_product) && count($row_product) > 0) {
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $row_product;
		} else {
			$outputjson['message'] = 'No Items found.';
		}
	}
	else if ($action == "add_sale") {
		$f_name=$_POST['f_name'];
		$l_name=$_POST['l_name'];
		$email=$_POST['email'];
		$contact=$_POST['contact'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$stateid=$_POST['stateid'];
		$state=$_POST['state'];
		$postcode=$_POST['postcode'];
		$contact2=$_POST['contact2'];
		$ordernote=$_POST['ordernote'];
		$paymentmethod=$_POST['paymentmethod'];
		$paymentstatus=0;
		if($paymentmethod == 1)
		{
			$paymentstatus=1;
		}
		$uid=$login_uid;
		
		if($f_name && $l_name && $email && $contact && $address && $city && $stateid && $postcode)
		{
			$pid=$gh->generateuuid();
			$mtid= $gh->generatemtid();
			$muid= $gh->generatemuid();

			$qry_series = "SELECT id from tbl_seriesmaster where typeid = '".$const->sale_type_id."' AND NOW() BETWEEN STR_TO_DATE(`startdate`, '%d/%m/%Y') AND STR_TO_DATE(`enddate`, '%d/%m/%Y') LIMIT 1";
			$row_series = $db->execute($qry_series);
			$seriseData = $row_series[0];
			$orderno = $gh->get_orderno($seriseData['id']);
			$maxid= $gh->get_maxid('salemaster', $seriseData['id']);
			//Insert Main Data
			$insdata = array(
				'id'=>$pid,
				'personid'=>$uid,
				'orderno'=>$orderno,
				'saledate'=>date('d/m/Y'),
				'personname'=>$f_name.' '.$l_name,
				'firstname'=>$f_name,
				'lastname'=>$l_name,
				'contact'=>$contact,       
				'contact2'=>$contact2,
				'email'=>$email,
				'address'=>$address,
				'city'=>$city,
				'stateid'=>$stateid,
				'state'=>$state,
				'postcode'=>$postcode,
				'ordernote'=>$ordernote,
				'paymentmethod'=>$paymentmethod,
				'paymentstatus'=>$paymentstatus,
				'mtid'=>'MT'.$mtid,
				'muid'=>'MUID'.$muid,
				'seriesid'=>$seriseData['id'],
				'maxid'=>$maxid,
				'entry_uid'=>$uid,
				'entry_date'=>date('Y-m-d H:i:s'),
			);	
			//print_r($insdata);
			$db->insert('tbl_salemaster',$insdata);

			$qry="SELECT pm.*,tw.qty
			FROM tbl_cart tw
			INNER JOIN `tbl_productmaster` pm ON pm.id=tw.`productid`
			WHERE tw.`personid`='$uid'";
			$res = $db->execute($qry);
			$totamt=0;
			$totqty=0;
			foreach($res as $key => $row)
			{
				$salerate=$row['srate'];
				$qty=$row['qty'];

				$total=$qty*$salerate;
				$gstamt=($total * GST)/100;
				$finalamt=$total+$gstamt;
				$puid=$gh->generateuuid();
				$insdata1 = array(
						'id'=>$puid,
						'sid'=>$pid,
						'productid'=>$row['id'],
						'rate'=>$salerate,
						'qty'=>$qty,
						'price'=>$total,
						'gstamt'=>$gstamt,
						'finalamt'=>$finalamt,
						'entry_uid'=>$uid,
						'entry_date'=>date('Y-m-d H:i:s'),
				);
				//print_r($insdata1);
				$db->insert('tbl_saledetails',$insdata1);
				$totamt=$totamt+$finalamt;
				$totqty=$totqty+$qty;
			}
			$upddata = array(
				'totamt'=>$totamt,   
				'totqty'=>$totqty,   
			);	
			$db->update('tbl_salemaster',$upddata, array("id"=>$pid));

			$ddata = array(  
				'personid'=>$uid, 
			);	
			$db->delete('tbl_cart',$ddata);
			
			// file_get_contents(ROOT_URL.'pdfinvoice/order.php?id='.$pid.'&type=generate');

			// if($paymentmethod == 2)
			// {
			//     $paymentdetails=paymentdetails($pid);
			//     // print_r($paymentdetails);
			//     $py=$paymentdetails['data'];
			//     $redirectInfo='';
			//     if($py['success'] == 'true')
			//     {
			//         $redirectInfo=$py['data']['instrumentResponse']['redirectInfo']['url'];

			//         $status=1;
			//     }
			//     $response['redirectInfo'] =$redirectInfo;
			// }
			$status=1;	
			$message="Data inserted successfully.";
		}else{
			$message="Please Fill All Required Field";
		}
		
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['message'] = $message;
		$outputjson['pid'] = $pid;
		$outputjson["data"] = [];
	}
	else if($action == "get_order"){
		$qry_order="SELECT ts.id,ts.personname,ts.contact,ts.orderno,
		DATE_FORMAT(STR_TO_DATE(saledate,'%d/%m/%Y'),'%M %d, %Y') AS sdate,ts.totamt,ts.entry_date,
		IFNULL((SELECT DATEDIFF(CURRENT_DATE(),DATE_FORMAT(sd.entry_date,'%Y-%m-%d')) FROM `tbl_sale_deliverydetails` sd WHERE sd.sid=ts.`id` AND sd.status_code=".$const->order_delivered."),0) AS returnallow 
		,ts.pdffile,ts.status_code
		FROM tbl_salemaster ts
		WHERE ts.`personid`='$login_uid' ORDER BY ts.`entry_date` DESC";
		$row_order = $db->execute($qry_order);
		if ($row_order != null && is_array($row_order) && count($row_order) > 0) {
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $row_order;
		} else {
			$outputjson["data"] = [];
			$outputjson['message'] = "No Orders found!";
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
	}
	else if($action == "get_sale_details"){
		$saleid = $gh->read("saleid");
		$qry_order="SELECT ts.id,pm.productname,ts.qty,ts.rate,ts.price,ts.gstamt,ts.finalamt
		from tbl_saledetails ts
		inner join tbl_productmaster pm on pm.id=ts.productid
		WHERE ts.`sid`='$saleid'";
		$row_order = $db->execute($qry_order);
		if ($row_order != null && is_array($row_order) && count($row_order) > 0) {
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $row_order;
		} else {
			$outputjson["data"] = [];
			$outputjson['message'] = "No Orders found!";
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
	}
	else if($action == "get_order_details"){
		$orderid = $gh->read('orderid');
		$qry_order="SELECT ts.id,ts.personname,ts.contact,ts.orderno, ts.pdffile,ts.status_code,ts.totamt,ts.totqty, ts.email, ts.address, ts.city, ts.state, ts.postcode,
		DATE_FORMAT(STR_TO_DATE(saledate,'%d/%m/%Y'),'%M %d, %Y') AS sdate
		FROM tbl_salemaster ts
		WHERE ts.`id`='$orderid'";
		$row_order = $db->execute($qry_order);
		if ($row_order != null && is_array($row_order) && count($row_order) > 0) {
			$outputjson['message'] = 'success.';
			$orderData = $row_order[0];
			$qry_order_details="SELECT ts.id,pm.productname,ts.qty,ts.rate,ts.price,ts.gstamt,ts.finalamt, pm.file
			from tbl_saledetails ts
			inner join tbl_productmaster pm on pm.id=ts.productid
			WHERE ts.`sid`='$orderid'";
			$row_order_details = $db->execute($qry_order_details);
			if ($row_order_details != null && is_array($row_order_details) && count($row_order_details) > 0) {
				$orderData["items"] = $row_order_details;
			}
			$qry_status="SELECT * FROM (
				SELECT 1 AS ordby,'New' AS st,IFNULL((SELECT 1 FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`= ".$const->order_new." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),0) AS sts,
				IFNULL((SELECT DATE_FORMAT(sds.entry_date ,'%a, %D %b %y') FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`= ".$const->order_new." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),'') AS datef
				FROM `tbl_salemaster` sd WHERE sd.id='$orderid'
				UNION ALL
				SELECT 2 AS ordby,'Order Confirmed' AS st,IFNULL((SELECT 1 FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_conformed." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),0) AS sts,
				IFNULL((SELECT DATE_FORMAT(sds.entry_date ,'%a, %D %b %y') FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_conformed." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),'') AS datef
				FROM `tbl_salemaster` sd WHERE sd.id='$orderid'
				UNION ALL
				SELECT 3 AS ordby,'SHIPPED' AS st,IFNULL((SELECT 1 FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_shipped." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),0) AS sts,
				IFNULL((SELECT DATE_FORMAT(sds.entry_date ,'%a, %D %b %y') FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_shipped." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),'') AS datef
				FROM `tbl_salemaster` sd WHERE sd.id='$orderid'
				UNION ALL
				SELECT 4 AS ordby,'OUT FOR DELIVERY' AS st,IFNULL((SELECT 1 FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_out_for_delivery." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),0) AS sts,
				IFNULL((SELECT DATE_FORMAT(sds.entry_date ,'%a, %D %b %y') FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_out_for_delivery." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),'') AS datef
				FROM `tbl_salemaster` sd WHERE sd.id='$orderid'
				UNION ALL
				SELECT 5 AS ordby,'DELIVERED' AS st,IFNULL((SELECT 1 FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_delivered." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),0) AS sts,
				IFNULL((SELECT DATE_FORMAT(sds.entry_date ,'%a, %D %b %y') FROM `tbl_sale_deliverydetails` sds WHERE sds.`status_code`=".$const->order_delivered." AND sds.`sid`=sd.`id` ORDER BY sds.`entry_date` ASC LIMIT 1),'') AS datef
				FROM `tbl_salemaster` sd WHERE sd.id='$orderid'
				) tmp";
				$row_status = $db->execute($qry_status);
				if ($row_status != null && is_array($row_status) && count($row_status) > 0) {
					$orderData["status"] = $row_status;
				}
			$outputjson["data"] = $orderData;
		} else {
			$outputjson["data"] = [];
			$outputjson['message'] = "No Orders found!";
		}
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
	}
	else if($action == "return_order"){
		$saleid= $gh->read('saleid');
		
		$qry="SELECT 
			IFNULL((SELECT DATEDIFF(CURRENT_DATE(),DATE_FORMAT(sd.entry_date,'%Y-%m-%d')) 
			FROM `tbl_sale_deliverydetails` sd 
			WHERE sd.sid=ts.`id` AND sd.status_code=".$const->order_delivered."),0) AS returnallow,
		ts.status_code,ts.totqty,ts.totamt,ts.personid
		from tbl_salemaster ts
		WHERE ts.`id`='$saleid' order by entry_date desc";
		$res=$db->execute($qry);
		$row= $res[0];
		if($row['returnallow'] < $const->max_days_return && $row['status_code'] == $const->order_rto_delivered)
		{
			$or_no=$gh->genrenstiring();
			// $paymentdetails=$gh->returnorder("'".$saleid."'");
			
			// if($paymentdetails['status_code'] == $const->phonepe_payment_return_success)
			{
				$upddata = array(
					'status_code'=>$const->order_pending,   
					'isreturn'=>1,   
					'rtnor_no'=>$or_no,
					'return_date'=>date('Y-m-d H:i:s'),   
				);	
				$db->update('tbl_salemaster',$upddata,"id='$saleid'");

				$srid=$gh->generateuuid();

				$qry_series = "SELECT id from tbl_seriesmaster where typeid = '".$const->salereturn_type_id."' AND NOW() BETWEEN STR_TO_DATE(`startdate`, '%d/%m/%Y') AND STR_TO_DATE(`enddate`, '%d/%m/%Y') LIMIT 1";
				$row_series = $db->execute($qry_series);
				$seriseData = $row_series[0];
				$orderno = $gh->get_orderno($seriseData['id']);
				$maxid= $gh->get_maxid('salereturn', $seriseData['id']);

				//Insert Main Data
				$insdata = array(
					'id'=>$srid,
					'sid'=>$saleid,     
					'returndate'=>date('d/m/Y'),
					'returnno'=>$orderno,
					'personid'=>$row['personid'],
					'totqty'=>$row['totqty'],
					'totamt'=>$row['totamt'],
					'seriesid'=>$seriseData['id'],
					'maxid'=>$maxid,
					'entry_uid'=>$login_uid,
					'entry_date'=>date('Y-m-d H:i:s'),
				);
				$db->insert('tbl_salereturn',$insdata);

				$qryd="SELECT ts.id,ts.qty,ts.rate,ts.price,ts.gstamt,ts.finalamt,ts.productid
				from tblsaledetails ts WHERE ts.`sid`='$saleid'";
				$resd=$db->execute($qryd);
				foreach($resd as $rowd)
				{
					$srdid=$gh->generateuuid();
					$srdinsdata = array(
						'id'=>$srdid,       
						'srid'=>$srid,
						'productid'=>$rowd['productid'],
						'qty'=>$rowd['qty'],
						'rate'=>$rowd['rate'],
						'price'=>$rowd['price'],
						'gstamt'=>$rowd['gstamt'],
						'finalamt'=>$rowd['finalamt'],
						'entry_uid'=>$login_uid,
						'entry_date'=>date('Y-m-d H:i:s'),
					);	
					//print_r($srdinsdata);
					$db->insert('tbl_salreturn_details',$srdinsdata);
				}


				$sdid=$gh->generateuuid();
				$sdinsdata = array(
					'id'=>$sdid,       
					'sid'=>$saleid,
					'order_id'=>$paymentdetails['order_id'],
					'shipment_id'=>$paymentdetails['shipment_id'],
					'status'=>$paymentdetails['status'],
					'status_code'=>$paymentdetails['status_code'],
					'timestamp'=>date('Y-m-d H:i:s'),
				);
				$db->insert('tbl_sale_deliverydetails',$sdinsdata,''); 
				
			}
			$status=1;
			$message='Return Order';
		}else{
			$message='Return Order';
		}
		$outputjson['success'] = $status;
		$outputjson['status'] = $status;
		$outputjson['status'] = $message;
	}
}
