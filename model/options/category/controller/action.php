<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/category/category.php';

	$result=1;
	$status=1;
	$category=new category();
	$message="Success";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idCategory'])){
		$category->idCategory = $_REQUEST['idCategory'];
	}else{
		$category->idCategory=0;
	}
	
	if (isset($_REQUEST['categoryName']) && !empty($_REQUEST['categoryName'])){
		$category->name = $_REQUEST['categoryName'];}
	else{
		$status=422;
		$errors['categoryName']="Nom manquant";
	}
	
	if ($status==1){
		if ($category->idCategory==0){
			$result=$category->insert();
		}
		else {
			$result = $category->update();
		}
		$url="/media/model/options/category/view/category.php";
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	