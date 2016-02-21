<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/formBuilder.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; ?>

<div class="row">

<?php
content::setList(1,true,true);
$form = new formBuilder();
$isModal=1;
print $form->open(['name'=>'contentFormSearch', 'method'=>'post', 'action'=>'/media/model/content/controller/search.php', 'data-type'=>'html']);
print $form->hidden('idDisk', $_REQUEST['idDisk']);
print $form->hidden('url', '/media/model/disk/controller/setContent.php?idDisk='.$_REQUEST['idDisk']);
print $form->inputForm("text", "contentName", "", ['label'=>'Nom','placeholder'=>'nom'],['class'=>"form-field form-field-margin-bottom col-xs-10"]);
print $form->selectForm("contentDisk", null, content::$disks,['label'=>'Disque dur'],['class'=>"form-field form-field-margin-bottom col-xs-10"]);
print '<div class="row col-xs-11">';
print $form->selectForm("contentType", null, content::$content_types,['label'=>'Type'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->selectForm("contentYear", null, array_combine(range(date("Y"),1950,-1),range(date("Y"),1950,-1)),['label'=>'Année'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print '</div><div class="row col-xs-11">';
print $form->selectForm("contentLanguage", null, content::$languages,['label'=>'Language'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->selectForm("contentQuality", null, content::$qualities,['label'=>'Qualité'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print '</div>';
print $form->submit("Chercher",null,['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->close();
?>
</div>

<div id="contentSearchList" class="search-list row"></div>