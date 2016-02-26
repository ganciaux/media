<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; ?>

<?php

if(isset($_REQUEST['isModal'])==0){
	$isModal=0;
}else{
	$isModal=$_REQUEST['isModal'];
}

$disk = new disk();
$form = new formBuilder();
panelOpen("Paramètres de recherche");
print $form->open(['name'=>'diskFormSearch', 'method'=>'post', 'action'=>'/media/model/disk/controller/search.php', 'data-type'=>'html', 'data-object'=>'disk']);
print $form->inputForm("text", "diskName", "", ['label'=>'Nom','placeholder'=>'nom'],['class'=>"form-field form-field-margin-bottom col-xs-6"]);
print $form->inputForm("text", "diskLabel", "", ['label'=>'Label','placeholder'=>'label'],['class'=>"form-field form-field-margin-bottom col-xs-6"]);
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Chercher",null,['class'=>"media-btn"]);
print $form->button("Exporter",['type'=>'button', 'onclick'=>'modelExport(this);'],['class'=>"media-btn"]);
print $form->button("Ajouter",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/disk/view/diskManage.php?idDisk=0'"],['class'=>"media-btn"]);
print $form->close();
print '</div>';
panelClose();
?>

	<div id="diskExport"></div>
<div id="diskSearchList"></div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>