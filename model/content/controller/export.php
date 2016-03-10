<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';

$result=1;
$options = array();

if (isset($_REQUEST['contentName']) && !empty($_REQUEST['contentName'])){
	$options['name'] = $_REQUEST['contentName'];
}

if (isset($_REQUEST['contentDisk']) && $_REQUEST['contentDisk']!=-1){
	$options['idDisk']  = $_REQUEST['contentDisk'];
}

if (isset($_REQUEST['contentType']) && $_REQUEST['contentType']!=-1){
	$options['idContentType']  = $_REQUEST['contentType'];
}

if (isset($_REQUEST['contentQuality']) && $_REQUEST['contentQuality']!=-1){
	$options['idQuality']  = $_REQUEST['contentQuality'];
}

if (isset($_REQUEST['contentLanguage']) && $_REQUEST['contentLanguage']!=-1){
	$options['idLanguage']  = $_REQUEST['contentLanguage'];
}

if (isset($_REQUEST['contentYear']) && $_REQUEST['contentYear']!=-1){
	$options['year']  = $_REQUEST['contentYear'];
}

if (isset($_REQUEST['idDisk'])){
	$idDisk=$_REQUEST['idDisk'];
}else
	$idDisk=0;

if (isset($_REQUEST['isModal'])){
	$isModal=$_REQUEST['isModal'];
}

$filename='contentExport.csv';
$data=content::getList(null,null,null,$options);
$file=$_SERVER['DOCUMENT_ROOT'] . '/media/public/files/'.$filename;
$fp = fopen($file, 'w');
if ($fp!=null) {
	content::setList(1,true);
	foreach ($data as $d) {
		$content=['idContent'=>$d['idContent'],
			'name'=>$d['name'],
			'disk'=>getValue(content::$disks,$d['idDisk']),
			'contentType'=>getValue(content::$contentTypes,$d['idContentType']),
			'quality'=>getValue(content::$qualities,$d['idQuality']),
			'language'=>getValue(content::$languages,$d['idLanguage']),
			'year'=>$d['year']];
		fputcsv($fp, $content,";");
	}
	fclose($fp);

	print '<a id="export" href="/media/global/download.php?file=' . $filename . '">Télécharger le fichier</a>';

}else {
	print '<div class="alert media-alert alert-danger" style="margin-bottom: 20px;"><a class="close" data-dismiss="alert">x</a>'.htmlspecialchars('Fichier non créé').'</div>';;
}


	
	