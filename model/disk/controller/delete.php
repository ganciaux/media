<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; 

	$result=1;
	$message="Success";
	$errors = array();
	
	if (isset($_REQUEST['idDisk'])){
		disk::delete($_REQUEST['idDisk']);
		$message="Success";
	}else{
		$result=0;
		$message="Impossible de supprimer le disque dur";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);