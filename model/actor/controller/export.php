<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'media/model/actor/actor.php';

$result=1;
$options = array();

if (isset($_REQUEST['actorFirstName']) && !empty($_REQUEST['actorFirstName'])){
	$options['firstName'] = $_REQUEST['actorFirstName'];
}

if (isset($_REQUEST['actorLasttName']) && !empty($_REQUEST['actorLasttName'])){
	$options['lastName'] = $_REQUEST['actorLasttName'];
}

$filename='actorExport.csv';
$data=actor::getList(null,null,null,$options);
$file=$_SERVER['DOCUMENT_ROOT'] . 'media/public/files/'.$filename;
$fp = fopen($file, 'w');
if ($fp!=null) {
	foreach ($data as $d) {
		fputcsv($fp, $d,";");
	}
	fclose($fp);

	print '<a id="export" href="/media/global/download.php?file=' . $filename . '">Télécharger le fichier</a>';

}else {
	print '<div class="alert media-alert alert-danger" style="margin-bottom: 20px;"><a class="close" data-dismiss="alert">x</a>'.htmlspecialchars('Fichier non créé').'</div>';
}


	
	