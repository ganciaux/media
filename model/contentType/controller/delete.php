<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/contentType/contentType.php';

	$result=1;
	$message="";
	$errors = array();
	
	if (isset($_REQUEST['idContentType'])){
		$result=contentType::delete($_REQUEST['idContentType']);
		$message="Le type de média a bien été supprimé";
	}else{
		$result=0;
		$message="Impossible de supprimer le type de média";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);