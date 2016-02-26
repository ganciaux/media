<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/language/language.php'; 

	$result=1;
	$message="";
	$errors = array();
	
	if (isset($_REQUEST['idLanguage'])){
		$result=language::delete($_REQUEST['idLanguage']);
		$message="La langue a bien été supprimé";
	}else{
		$result=0;
		$message="Impossible de supprimer la langue";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);