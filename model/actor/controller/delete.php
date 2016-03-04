<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php'; 

	$result=1;
	$message="";
	$errors = array();
	
	if (isset($_REQUEST['idActor'])){
		$result=actor::delete($_REQUEST['idActor']);
		$message="L'acteur a bien été supprimé";
	}else{
		$result=0;
		$message="Impossible de supprimer l'acteur";
	}
	
	$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));
	
	print json_encode($data);