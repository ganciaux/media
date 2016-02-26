<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; 

	$result=1;
	$options = array();
	
	if (isset($_REQUEST['contentName']) && !empty($_REQUEST['contentName'])){
            $options['contentName'] = $_REQUEST['contentName'];
	}

	if (isset($_REQUEST['contentDisk']) && $_REQUEST['contentDisk']!=-1){
            $options['contentDisk']  = $_REQUEST['contentDisk'];
        }

	if (isset($_REQUEST['contentType']) && $_REQUEST['contentType']!=-1){
            $options['contentType']  = $_REQUEST['contentType'];
	}
	
	if (isset($_REQUEST['contentQuality']) && $_REQUEST['contentQuality']!=-1){
            $options['contentQuality']  = $_REQUEST['contentQuality'];
	}

	if (isset($_REQUEST['contentLanguage']) && $_REQUEST['contentLanguage']!=-1){
            $options['contentLanguage']  = $_REQUEST['contentLanguage'];
	}
	
	if (isset($_REQUEST['contentYear']) && $_REQUEST['contentYear']!=-1){
            $options['contentYear']  = $_REQUEST['contentYear'];
	}
        
	if (isset($_REQUEST['idDisk'])){
		$options['idDisk']=$_REQUEST['idDisk'];
		$idRefDisk=$_REQUEST['idDisk'];
	}

	if (isset($_REQUEST['idRefDisk'])){
		$idRefDisk=$_REQUEST['idRefDisk'];
	}

	if (isset($_REQUEST['idActor'])){
		$options['idActor']=$_REQUEST['idActor'];
	}

	$data=content::getList(null,null,null,$options);

	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/view/contentList.php';

	
	