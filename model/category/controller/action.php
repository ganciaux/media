<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/category/category.php';

	$result=1;
	$status=1;
	$category=new category();
	$message="";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idCategory']) && $_REQUEST['idCategory']>0){
		$category->idCategory = $_REQUEST['idCategory'];
		$message="Mise à jour réussie";
	}else{
		$category->idCategory=0;
		$message="Création réussie";
	}
	
	if (isset($_REQUEST['categoryName']) && !empty($_REQUEST['categoryName'])){
		$category->name = $_REQUEST['categoryName'];}
	else{
		$status=422;
		$errors['categoryName']="Nom manquant";
	}
	
	if ($status==1){
		if (category::exists($_REQUEST['categoryName'],$category->idCategory)==0) {
			if ($category->idCategory == 0) {
				$result = $category->insert();
				$url = "/media/model/category/view/categoryManage.php?idCategory=" . $category->idCategory;
			} else {
				$result = $category->update();
				$url = "/media/model/category/view/category.php";
			}
		}else{
			$status=422;
			$errors['categoryName']="Existe déja";
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	