<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php';

$result=1;
$options = array();
$isSelect = 0;

if (isset($_REQUEST['diskName']) && !empty($_REQUEST['diskName'])){
	$options['diskName'] = $_REQUEST['diskName'];
}

if (isset($_REQUEST['diskLabel']) && !empty($_REQUEST['diskLabel'])){
	$options['diskLabel'] = $_REQUEST['diskLabel'];
}

$data=disk::getList(null,null,null,$options);

include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/view/diskList.php';



	
	