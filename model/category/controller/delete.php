<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/category/category.php'; 

	$result=1;
	$message="";
	$errors = array();
	
	if (isset($_REQUEST['idCategory'])){
		$result=category::delete($_REQUEST['idCategory']);
		$message="La catégorie a bien été supprimé";
	}else{
		$result=0;
		$message="Impossible de supprimer la catégorie";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);