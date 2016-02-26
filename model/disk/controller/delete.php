<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; 

	$result=1;
	$message="";
	$errors = array();
	
	if (isset($_REQUEST['idDisk'])){
		disk::delete($_REQUEST['idDisk']);
		$message="Le disque dur a bien été supprimé";
	}else{
		$result=0;
		$message="Impossible de supprimer le disque dur";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);