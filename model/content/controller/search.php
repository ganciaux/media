<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; 

	$result=1;
	$options = array();
	
	if (isset($_REQUEST['contentName']) && !empty($_REQUEST['contentName'])){
            $options['name'] = $_REQUEST['contentName'];
	}

	if (isset($_REQUEST['contentDisk'])){
            $options['idDisk']  = $_REQUEST['contentDisk'];
        }

	if (isset($_REQUEST['contentType'])){
            $options['idContentType']  = $_REQUEST['contentType'];
	}
	
	if (isset($_REQUEST['contentQuality'])){
            $options['idQuality']  = $_REQUEST['contentQuality'];
	}

	if (isset($_REQUEST['contentLanguage'])){
            $options['idLanguage']  = $_REQUEST['contentLanguage'];
	}
	
	if (isset($_REQUEST['contentYear'])){
            $options['year']  = $_REQUEST['contentYear'];
	}
        
        if (isset($_REQUEST['idDisk'])){
            $idDisk=$_REQUEST['idDisk'];
        }else
            $idDisk=0;
           
        $isModal=1;
        
        $data=content::getList(null,null,null,$options);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/view/contentList.php';
	
	