<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/category.php';

	$result=1;
	$message="Success";
	$errors = array();
	
	if (isset($_REQUEST['idCategory'])){
		$result=actor::delete($_REQUEST['idCategory']);
		$message="Success";
	}else{
		$result=0;
		$message="Impossible de supprimer la categorie";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);