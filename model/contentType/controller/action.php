<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/contentType/contentType.php';

	$result=1;
	$status=1;
	$contentType=new contentType();
	$message="";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idContentType']) && $_REQUEST['idContentType']>0){
		$contentType->idContentType = $_REQUEST['idContentType'];
		$message="Mise à jour réussie";
	}else{
		$contentType->idContentType=0;
		$message="Création réussie";
	}
	
	if (isset($_REQUEST['contentTypeName']) && !empty($_REQUEST['contentTypeName'])){
		$contentType->name = $_REQUEST['contentTypeName'];}
	else{
		$status=422;
		$errors['contentTypeName']="Nom manquant";
	}
	
	if ($status==1){
		if (contentType::exists($_REQUEST['contentTypeName'],$contentType->idContentType)==0) {
			if ($contentType->idContentType == 0) {
				$result = $contentType->insert();
				$url = "/media/model/contentType/view/contentTypeManage.php?idContentType=" . $contentType->idContentType;
			} else {
				$result = $contentType->update();
				$url = "/media/model/contentType/view/contentType.php";
			}
		}else{
			$status=422;
			$errors['contentTypeName']="Existe déja";
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	