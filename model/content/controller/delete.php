<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; 

	$result=1;
	$message="Success";
	$errors = array();
	
	if (isset($_REQUEST['idContent'])){
		content::delete($_REQUEST['idContent']);
		$message="Success";
	}else{
		$result=0;
		$message="Impossible de supprimer le média";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);