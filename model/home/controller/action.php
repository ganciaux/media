<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/language/language.php';

	$result=1;
	$status=1;
	$language=new language();
	$message="";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idLanguage']) && $_REQUEST['idLanguage']>0){
		$language->idLanguage = $_REQUEST['idLanguage'];
		$message="Mise à jour réussie";
	}else{
		$language->idLanguage=0;
		$message="Création réussie";
	}
	
	if (isset($_REQUEST['languageName']) && !empty($_REQUEST['languageName'])){
		$language->name = $_REQUEST['languageName'];}
	else{
		$status=422;
		$errors['languageName']="Nom manquant";
	}
	
	if ($status==1){
		if (language::exists($_REQUEST['languageName'],$language->idLanguage)==0) {
			if ($language->idLanguage == 0) {
				$result = $language->insert();
				$url = "/media/model/language/view/languageManage.php?idLanguage=" . $language->idLanguage;
			} else {
				$result = $language->update();
				$url = "/media/model/language/view/language.php";
			}
		}else{
			$status=422;
			$errors['languageName']="Existe déja";
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	