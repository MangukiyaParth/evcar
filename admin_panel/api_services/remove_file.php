<?php

function remove_file()
{
	global $outputjson, $gh;
	$outputjson['success'] = 0;
	$url = $gh->read('url');
	foreach ($url as $file) { 
		if (str_contains($file, 'tmp/'))
		{
			unlink($file);
		}
	}
	$outputjson['success'] = 1;
	$outputjson['message'] = "File Removed successfully";
}
