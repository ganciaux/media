<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php'; 

	$result=1;
	$status=1;
	$actor=new actor();
	$message="Success";
	$callback='';
	$url='';
	$errors = array();
	
	if (isset($_REQUEST['idActor'])){
		$actor->idActor = $_REQUEST['idActor'];
	}else{
		$actor->idActor=0;
	}
	
	if (isset($_REQUEST['actorFirstName']) && !empty($_REQUEST['actorFirstName'])){
		$actor->firstName = $_REQUEST['actorFirstName'];}
	else{
		$status=422;
		$errors['actorFirstName']="Prénom manquant";
	}
	
	if (isset($_REQUEST['actorLastName']) && !empty($_REQUEST['actorLastName'])){
		$actor->lastName  = $_REQUEST['actorLastName'];
	}else{
		$status=422;
		$errors['actorLastName']="Nom manquant";
	}
	
	if ($status==1){
		if ($actor->idActor==0){
			$result=$actor->insert();
			$url="/media/model/actor/view/actorManage.php?idActor=".$actor->idActor;
		}
		else{
			$result=$actor->update();
			$url="/media/model/actor/view/actor.php";
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	