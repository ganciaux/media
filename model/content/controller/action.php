<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; 

	$result=1;
	$status=1;
	$content=new content();
	$message="";
	$callback="";
	$url="";
	$errors = array();
	$imageListParam=array();

	if (isset($_REQUEST['actorList'])){
		$content->actorList=$_REQUEST['actorList'];
	}

	if (isset($_REQUEST['idContent']) && $_REQUEST['idContent']>0){
		$content->idContent = $_REQUEST['idContent'];
		$message="Mise à jour réussie";
	}else{
		$content->idContent=0;
		$message="Création réussie";
	}
	
	if (isset($_REQUEST['contentName']) && !empty($_REQUEST['contentName'])){
		$content->name = $_REQUEST['contentName'];}
	else{
		$status=422;
		$errors['contentName']="Nom manquant";
	}

	if (isset($_REQUEST['contentDisk'])){
		$content->idDisk  = $_REQUEST['contentDisk'];
	}else{
		$status=422;
		$errors['contentDisk']="Disque dur manquant";
}

	if (isset($_REQUEST['contentType'])){
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

	if (isset($_REQUEST['objectList']) && strlen($_REQUEST['objectList'])>0){
		$images = explode(";", $_REQUEST['objectList']);
		foreach($images as $image){
			$result=image::delete($image);
			if ($result==false) {
				$stauts = 422;
				break;
			}
		}
	}

	if ($status==1){
		if (content::exists($_REQUEST['contentName'],$content->idContent)==0) {
			global $bdd;
			$bdd->beginTransaction();
			if ($content->idContent == 0) {
				$result = $content->insert();
				$callback = "/media/model/content/view/contentManage.php?idContent=" . $content->idContent;
			} else {
				$result = $content->update();
				$callback = "/media/model/content/content.php?idContent=" . $content->idContent;
			}
			if ($result==true){
				if (isset($_FILES['contentFile'])) {
					$files = $_FILES['contentFile'];
					for ($i = 0; $i < count($files['name']); $i++) {
						$uploadFile = uploadFile($files, $i, $content->idContent, _TYPE_CONTENT_, 'content', true);
						$result = (int)$uploadFile['result'];
						$status = (int)$uploadFile['status'];
						if (isset($uploadFile['error']) == true) {
							$errors['contentFile'] = $uploadFile['error'];
						}
					}
				}
			}
			if ($result==true){
				$callback="contentAction";
				$bdd->commit();
				$imageListParam=['idRef'=>(int)$content->idContent, 'iRefType' =>_TYPE_CONTENT_, 'objectList'=>"objectList"];
			}else{
				$bdd->rollBack();
			}
		}
		else{
			$status=422;
			$errors['contentName']="Existe déja";
			$result=0;
		}
	}else{
		$result=0;
	}

	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "imageList"=>json_encode($imageListParam), "responseText"=>json_encode($errors));
	
	print json_encode($data);
	