<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; 

	$result=1;
	$status=1;
	$content=new content();
	$message="Success";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idContent'])){
		$content->idContent = $_REQUEST['idContent'];
	}else{
		$content->idContent=0;
	}
	
	if (isset($_REQUEST['contentName']) && !empty($_REQUEST['contentName'])){
		$content->name = $_REQUEST['contentName'];}
	else{
		$status=422;
		$errors['contentName']="Nom manquant";
	}

	if (isset($_REQUEST['contentDisk']) && $_REQUEST['contentDisk']>0){
		$content->idDisk  = $_REQUEST['contentDisk'];
	}else{
		$status=422;
		$errors['contentDisk']="Disque dur manquant";
}

	if (isset($_REQUEST['contentType']) && $_REQUEST['contentType']>0){
		$content->idContentType  = $_REQUEST['contentType'];
	}else{
		$status=422;
		$errors['contentType']="Type manquant";
	}
	
	if (isset($_REQUEST['contentQuality'])){
		$content->idQuality  = $_REQUEST['contentQuality'];
	}else{
		$status=422;
		$errors['contentQuality']="Qualité manquante";
	}

	if (isset($_REQUEST['contentLanguage'])){
		$content->idLanguage  = $_REQUEST['contentLanguage'];
	}else{
		$status=422;
		$errors['contentLanguage']="Language manquant";
	}
	
	if (isset($_REQUEST['contentYear'])){
		$content->year  = $_REQUEST['contentYear'];
	}else{
		$status=422;
		$errors['contentYear']="Année manquante";
	}
	
	if ($status==1){
		if ($content->idContent==0){
			$result=$content->insert();
			$callback="/media/model/content/view/contentManage.php?idContent=".$content->idContent;
		}
		else{
			$result=$content->update();
			$callback="/media/model/content/content.php?idContent=".$content->idContent;
		}
	}else{
		$result=0;
	}

	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);
	