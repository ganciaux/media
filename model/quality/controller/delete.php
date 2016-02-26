<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/quality/quality.php'; 

	$result=1;
	$message="";
	$errors = array();
	
	if (isset($_REQUEST['idQuality'])){
		$result=quality::delete($_REQUEST['idQuality']);
		$message="La qualité a bien été supprimé";
	}else{
		$result=0;
		$message="Impossible de supprimer la qualité";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);