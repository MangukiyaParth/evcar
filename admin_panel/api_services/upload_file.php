<?php

function upload_file()
{
	global $outputjson, $gh;
	$outputjson['success'] = 0;
	$target_dir = "upload/tmp/";
	$page = $gh->read('page');
	$uniq_id = json_decode($_POST['uuid'], true);
	
	if (isset($_FILES['file'])) {
		$target_dir = $target_dir.$page."/";
		$gh->TryCreateDirIfNeeded($target_dir);
		$files = [];
		$length = count($_FILES['file']["name"]);
		for ($i = 0; $i < $length; $i++) {
			$basename = $_FILES['file']["name"][$i];

			$target_file = $target_dir . $basename;
			if(file_exists($target_file)){
				$withoutExt = preg_replace('/\.\w+$/', '', $basename);
				$basename = str_replace($withoutExt, $withoutExt."_".strtotime("now"), $basename);
				$target_file = $target_dir . $basename;
			}
			move_uploaded_file($_FILES['file']["tmp_name"][$i], $target_file);
			$new_file = (object)[
				'uuid' => $uniq_id[$i],
				'name' => $basename,
				'filename' => $basename,
				'size' => $_FILES['file']["size"][$i],
				'total' => $_FILES['file']["size"][$i],
				'bytesSent' => $_FILES['file']["size"][$i],
				'url' => $target_file
			];
			// 'upload' => (object)[
			// 	'uuid' => $uniq_id[$i],
			// 	'name' => $basename,
			// 	'filename' => $basename,
			// 	'size' => $_FILES['file']["size"][$i],
			// 	'total' => $_FILES['file']["size"][$i],
			// 	'bytesSent' => $_FILES['file']["size"][$i],
			// 	'url' => $target_file
			// ]
			array_push($files,$new_file);
		}
		$outputjson['files'] = json_encode($files);
		$outputjson['success'] = 1;
		$outputjson['message'] = "File Upload successfully";
	} else {
		$outputjson['message'] = "Please select file to upload!";
	}
}
