<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';

$result=1;
$options = array();
$isSelect = 0;

if (isset($_REQUEST['actorName']) && !empty($_REQUEST['actorName'])){
	$options['search'] = $_REQUEST['actorName'];
}

if (isset($_REQUEST['isSelect'])){
	$isSelect=$_REQUEST['isSelect'];
}else {
	$isSelect = 0;
}

if (isset($_REQUEST['actorFirstName']) && !empty($_REQUEST['actorFirstName'])){
	$options['firstName'] = $_REQUEST['actorFirstName'];
}

if (isset($_REQUEST['actorLasttName']) && !empty($_REQUEST['actorLasttName'])){
	$options['lastName'] = $_REQUEST['actorLasttName'];
}

if (isset($_REQUEST['idDisk'])){
	$idDisk=$_REQUEST['idDisk'];
}

if (isset($_REQUEST['idContent'])){
	$idDisk=$_REQUEST['idContent'];
}

if (isset($_REQUEST['isModal'])){
	$isModal=$_REQUEST['isModal'];
}

$data=actor::getList(null,null,null,$options);

if ($isSelect==0){
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/view/actorList.php';
}else{
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/view/actorContentList.php';
}


	
	