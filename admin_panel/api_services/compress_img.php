<?php
// imagejpeg($this->image,$filename,$compression);
$maindirs = array_filter(glob('upload/images/*'), 'is_dir');
foreach ($maindirs as $maindirs_key => $maindirs_url) {
	// echo "MAIN: ".$maindirs_url;
	// echo "<br>";
	$dirs = array_filter(glob($maindirs_url.'/*'), 'is_dir');
	foreach ($dirs as $dirs_key => $dirs_url) {
		// echo "SUB: ".$dirs_url;
		// echo "<br>";
		$dir_path = './'.$dirs_url;
		$scan_dir = scandir($dir_path);
		$files = array_diff($scan_dir, array('.', '..'));
		foreach ($files as $key => $file_url) {
			$file_url = $dir_path.'/'.$file_url;
			// echo $file_url;
			// echo "<br>";
			$new_file_url = str_replace('/images/','/images_thumb/',$file_url);
			$new_dir_path = str_replace('/images/','/images_thumb/',$dir_path).'/';

			if (!is_dir($new_dir_path) && !file_exists($new_dir_path)) {
				$oldmask = umask(0);
				mkdir($new_dir_path, 0777, true);
				umask($oldmask);
			}

			$image_info = getimagesize($file_url);
			$file_size = filesize($file_url);
			$image_type = ($image_info) ? $image_info[2] : 0;

			if($file_size > 100000 && $image_type && $image_type > 0){
				
				if( $image_type == IMAGETYPE_JPEG ) { 
					$image = imagecreatefromjpeg($file_url);
				} 
				elseif( $image_type == IMAGETYPE_GIF ) { 
					$image = imagecreatefromgif($file_url);
				} 
				elseif( $image_type == IMAGETYPE_PNG ) { 
					$image = imagecreatefrompng($file_url);
				}

				$compression = (10000000 / $file_size);
				echo $file_url."=====";
				echo $file_size .'=>'. $compression;
				echo "<br>";
				// imagejpeg($image,$new_file_url,$compression);
			}
			else{
				// copy($file_url , $new_file_url);
			}
		}
	}
	// echo "<br>";
	// echo "===============================================";
	// echo "<br>";
}