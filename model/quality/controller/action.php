<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/quality/quality.php';

	$result=1;
	$status=1;
	$quality=new quality();
	$message="";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idQuality']) && $_REQUEST['idQuality']>0){
		$quality->idQuality = $_REQUEST['idQuality'];
		$message="Mise à jour réussie";
	}else{
		$quality->idQuality=0;
		$message="Création réussie";
	}
	
	if (isset($_REQUEST['qualityName']) && !empty($_REQUEST['qualityName'])){
		$quality->name = $_REQUEST['qualityName'];}
	else{
		$status=422;
		$errors['qualityName']="Nom manquant";
	}
	
	if ($status==1){
		if (quality::exists($_REQUEST['qualityName'],$quality->idQuality)==0) {
			if ($quality->idQuality == 0) {
				$result = $quality->insert();
				$url = "/media/model/quality/view/qualityManage.php?idQuality=" . $quality->idQuality;
			} else {
				$result = $quality->update();
				$url = "/media/model/quality/view/quality.php";
			}
		}else{
			$status=422;
			$errors['qualityName']="Existe déja";
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	