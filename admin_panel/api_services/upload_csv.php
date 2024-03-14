<?php

function upload_csv()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;

	$car_id = $gh->read("car_id");
	$user_id = $gh->read("user_id", 0);
	$date = date('Y-m-d H:i:s');
	$target_dir = "upload/csv/";
	$target_file = $target_dir . date("Y_m_d_h_i_s_") . basename($_FILES["file"]["name"]);
	$uploadOk = 1;

	if (isset($_FILES['file'])) {
		$message = "";
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Allow certain file formats
		if ($imageFileType != "csv") {
			$message = "Sorry, only CSV file is allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$outputjson['message'] = $message;
		} else {
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
			if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
				// Open the CSV file and read its contents
				$handle = fopen($target_file, "r");
				if ($handle !== FALSE) {

					$existing_qry = "SELECT verient_data FROM tbl_cars WHERE id = '$car_id'";
					$verient_data = $db->execute_scalar($existing_qry);
					$existing_data = ($verient_data && $verient_data != "") ? json_decode($verient_data, true) : [];

					// Loop through each row of the CSV file
					$i = 1;
					$added_data = 0;
					while (($data = fgetcsv($handle, 1500, ",")) !== FALSE) {
						$name = $data[0];
						$price = trim(str_replace("?","",str_replace("₹","",$data[1])));
						$other_data = $data[2];
						$exp_other_data = explode(',', $other_data);
						$fule_type_text = ($exp_other_data && $exp_other_data[0]) ? $exp_other_data[0] : '';
						$engine = ($exp_other_data && $exp_other_data[1]) ? trim(str_replace("cc","",$exp_other_data[1])) : '';
						$transmision_text = '';
						if($exp_other_data && $exp_other_data[2]){
							if(str_contains(strtolower($exp_other_data[2]), 'auto')){
								$transmision_text = 'Auto';
							}
							else if(str_contains(strtolower($exp_other_data[2]), 'manual')){
								$transmision_text = 'Manual';
							}
						}

						if ($name != "" || $price != "" || $fule_type_text != "" || $engine != "" || $transmision_text != "") {

							$get_id_qry = "SELECT 
							(SELECT id FROM `tbl_transmision` WHERE trans_type = '$transmision_text') AS trans_id,
							(SELECT id FROM `tbl_fules` WHERE LOWER(fule) = LOWER('$fule_type_text')) AS fule_id";
							$rows_get_id = $db->execute($get_id_qry);
							$get_id = $rows_get_id[0];
							$transmision = $get_id['trans_id'];
							$fule_type = $get_id['fule_id'];

							if($transmision && $fule_type){
								$qry_product = "SELECT * FROM tbl_cars_verient WHERE car_id = '$car_id' AND LOWER(verient_name) = LOWER('$name')";
								$rows_product = $db->execute($qry_product);
								if ($rows_product != null && is_array($rows_product) && count($rows_product) > 0) {
								} else {
									$id=$gh->generateuuid();
									$data = array(
										"id" => $id,
										"car_id" => $car_id,
										"verient_name" => $name,
										"fule_type" => $fule_type,
										"fule_type_text" => $fule_type_text,
										"transmision" => $transmision,
										"transmision_text" => $transmision_text,
										"engine" => $engine,
										"price" => $price,
										"entry_uid" => $user_id,
										"entry_date" => $date,
									);
									$db->insert("tbl_cars_verient", $data);
									array_push($existing_data, (object)[
										"verient_name" => $name,
										"fule_type" => $fule_type,
										"fule_type_text" => $fule_type_text,
										"transmision" => $transmision,
										"transmision_text" => $transmision_text,
										"engine" => $engine,
										"price" => $price,
									]);
									$added_data++;
								}
							}
						}
						$i++;
					}
					if($added_data > 0){
						$new_varient_data = json_encode($existing_data);
						$db->update("tbl_cars", array("verient_data" => $new_varient_data), array("id" => $car_id));
					}
					fclose($handle);
					$outputjson['success'] = 1;
					$outputjson['message'] = 'Data inserted Successfully.';
				} else {
					$outputjson['message'] = "File not open!";
				}
			} else {
				$outputjson['message'] = "File not Found!";
			}
		}
	} else {
		$outputjson['message'] = "Please select file to upload!";
	}
}
