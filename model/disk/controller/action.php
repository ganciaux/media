<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; 

	$result=1;
	$status=1;
	$disk=new disk();
	$message="";
	$url="";
	$errors = array();
	
	if (isset($_REQUEST['idDisk'])  && $_REQUEST['idDisk']>0){
		$disk->idDisk = $_REQUEST['idDisk'];
		$message="Mise à jour réussie";
	}else{
		$disk->idDisk=0;
		$message="Création réussie";
	}
	
	if (isset($_REQUEST['diskName']) && !empty($_REQUEST['diskName'])){
		$disk->name = $_REQUEST['diskName'];
	}else{
		$status=422;
		$errors['diskName']="Nom manquant";
	}
	
	if (isset($_REQUEST['diskLabel'])){
		$disk->label  = $_REQUEST['diskLabel'];
	}else{
		$status=422;
		$errors['diskLabel']="Label manquant";
	}
	
	if (isset($_REQUEST['diskSize'])){
		$disk->size = $_REQUEST['diskSize'];
	}
	
	if (isset($_REQUEST['diskComment'])) {
		$disk->comment = $_REQUEST['diskComment'];
	}

	if ($status==1){
		if (disk::exists($_REQUEST['diskName'],$disk->idDisk)==0) {
			if ($disk->idDisk == 0) {
				$result = $disk->insert();
				$url = "/media/model/disk/view/diskManage.php?idDisk=" . $disk->idDisk;
			} else {
				$result = $disk->update();
				$url = "/media/model/disk/view/disk.php";
			}
		}
		else{
			$status=422;
			$errors['diskName']="Existe déja";
			$result=0;
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	