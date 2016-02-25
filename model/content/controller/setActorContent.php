<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';

	$result=1;
	$status=1;
	$errors = array();
	
	if (isset($_REQUEST['idActor'])){
		$idActor=$_REQUEST['idActor'];
	}

	if (isset($_REQUEST['objectList'])){
		$objectList = json_decode($_REQUEST['objectList'],true);
		foreach($objectList as $o) {
			if ($o['exists']==1 && $o['checked']==1)
				;
			else if ($o['exists']==0 && $o['checked']==1){
				content::setActor($idActor,$o['id']);
			}
			else if ($o['exists']==1 && $o['checked']==0) {
				content::deleteActor($idActor, $o['id']);
			}
			else
				;
		}
	}

	$data = array("result"=>$result, "status"=>$status, "responseText"=>json_encode($errors));
	
	print json_encode($data);
	