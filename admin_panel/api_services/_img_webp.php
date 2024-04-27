<?php
// Function to convert JPG and PNG images to WebP format
function convertToWebP($inputFile, $outputFile) {
    // Get image info
    $info = getimagesize($inputFile);
    
    // Check if GD library supports WebP
    if (!function_exists('imagecreatefromwebp')) {
        echo "GD library does not support WebP format.";
        return false;
    }
    
    // Load the image based on its MIME type
    switch ($info['mime']) {
        case 'image/jpeg':
            $img = imagecreatefromjpeg($inputFile);
            break;
        case 'image/png':
            $img = imagecreatefrompng($inputFile);
            break;
        default:
            echo "Unsupported image format.";
            return false;
    }
    
    // Save the image as WebP
    if (!imagewebp($img, $outputFile, 80)) { // 80 is the quality level (0-100)
        echo "Failed to save the image as WebP.";
        return false;
    }
    
    // Free up memory
    imagedestroy($img);
    
    return true;
}

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

            $image_info = getimagesize($file_url);
			$image_type = ($image_info) ? $image_info[2] : 0;

			if($image_type && $image_type > 0){
                $explode_file_url = explode('.', $file_url);
                $extension = end($explode_file_url);
                $webp_url = str_replace('.'.$extension,'.webp',$file_url);
                echo $file_url." => ";
                echo $webp_url." ==== ";
                $org_url = str_replace('/images/','/org_images/',$file_url);
                $org_dir_path = str_replace('/images/','/org_images/',$dir_path).'/';
                if (!is_dir($org_dir_path) && !file_exists($org_dir_path)) {
                	$oldmask = umask(0);
                	mkdir($org_dir_path, 0777, true);
                	umask($oldmask);
                }
                echo $org_url."<br>";
                if(convertToWebP($file_url, $webp_url)){
                    rename($file_url, $org_url);
                }else {
                    copy($file_url, $org_url);
                }

            }
		}
	}
	// echo "<br>";
	// echo "===============================================";
	// echo "<br>";
}
?>
