<?php

if (isset($_REQUEST['file']) && basename($_REQUEST['file']) == $_REQUEST['file']) {
	$filename = $_REQUEST['file'];
} else {
	$filename = NULL;
}

// define error message
$err = '<div class="alert media-alert alert-error "><a class="close" data-dismiss="alert">×</a>Désolé, fichier manquant</div>';

if(!$filename){
	// if variable $filename is NULL or false display the message
	echo $err;
} else {
	// define the path to your download folder plus assign the file name
	$path = $_SERVER['DOCUMENT_ROOT'].'media/public/files/'.$filename;
	// check that file exists and is readable
	if (file_exists($path) && is_readable($path)) {
		// get the file size and send the http headers
		$size = filesize($path);
		header('Content-Type: application/octet-stream');
		header('Content-Length: '.$size);
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		// open the file in binary read-only mode
		// display the error message if file can't be opened
		$file = @ fopen($path, 'rb');
		if ($file) {
			// stream the file and exit the script when complete
			fpassthru($file);
			exit;
		} else {
			echo $err;
		}
	} else {
		echo $err;
	}
}