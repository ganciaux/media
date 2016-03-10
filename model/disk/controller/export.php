<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php';

$result=1;
$options = array();

if (isset($_REQUEST['diskName']) && !empty($_REQUEST['diskName'])){
	$options['diskName'] = $_REQUEST['diskName'];
}

if (isset($_REQUEST['diskLabel']) && !empty($_REQUEST['diskLabel'])){
	$options['diskLabel'] = $_REQUEST['diskLabel'];
}

$filename='diskExport.csv';
$data=disk::getList(null,null,null,$options);
$file=$_SERVER['DOCUMENT_ROOT'] . '/media/public/files/'.$filename;
$fp = fopen($file, 'w');
if ($fp!=null) {
	foreach ($data as $d) {
		$disk=['idDisk'=>$d['idDisk'],
			'name'=>$d['name'],
			'label'=>$d['label']];
		fputcsv($fp, $disk,";");
	}
	fclose($fp);

	print '<a id="export" href="/media/global/download.php?file=' . $filename . '">Télécharger le fichier</a>';

}else {
	print '<div class="alert media-alert alert-danger" style="margin-bottom: 20px;"><a class="close" data-dismiss="alert">x</a>'.htmlspecialchars('Fichier non créé').'</div>';
}


	
	