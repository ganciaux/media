<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php';

	$result=1;
	$bUpload=0;
	$status=1;
	$actor=new actor();
	$message="";
	$callback='';
	$url='';
	$errors = array();

	if (isset($_REQUEST['idActor']) && $_REQUEST['idActor']>0){
		$actor->idActor = $_REQUEST['idActor'];
		$message="Mise à jour réussie";
	}else{
		$actor->idActor=0;
		$message="Création réussie";
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
		if (actor::exists($_REQUEST['actorFirstName'],$_REQUEST['actorLastName'],$actor->idActor)==0) {
			if ($actor->idActor == 0) {
				$result = $actor->insert();
				$url = "/media/model/actor/view/actorManage.php?idActor=" . $actor->idActor;
			} else {
				$result = $actor->update();
				$url = "/media/model/actor/view/actor.php";
			}
			if ($result==true){
				$files = $_FILES['actorFile'];
				print_r($files);
				for($i=0; $i<count($files['name']); $i++) {
					$result = uploadFile($files,$i,$id,_TYPE_ACTOR_,$object,true);
					$status = $uploadFile['status'];
					if (isset($uploadFile['error']) == true) {
						$errors['actorFile'] = $uploadFile['error'];
					}
				}
			}
		}else{
			$status=422;
			$errors['actorFirstName']="Existe déja";
			$errors['actorLastName']="Existe déja";
		}
	}else{
		$result=0;
	}
	
	$data = array("result"=>$result, "status"=>$status, "url"=>$url, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);	
	