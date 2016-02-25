<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/formBuilder.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; ?>

<?php

content::setList(1,true,true);
$form = new formBuilder();

if(isset($_REQUEST['isModal'])==0){
    $isModal=0;
}else{
    $isModal=$_REQUEST['isModal'];
}

panelOpen("Paramètres de recherche");
print $form->open(['name'=>'contentFormSearch', 'method'=>'post', 'action'=>'/media/model/content/controller/search.php', 'data-type'=>'html', 'data-object'=>'content']);
if (isset($_REQUEST['idRefDisk'])){
    print $form->hidden('idRefDisk', $_REQUEST['idRefDisk']);
    print $form->hidden('url', '/media/model/content/controller/setDiskContent.php?idDisk='.$_REQUEST['idRefDisk']);
}
if (isset($_REQUEST['idRefActor'])){
    print $form->hidden('idRefActor', $_REQUEST['idRefActor']);
    print $form->hidden('url', '/media/model/content/controller/setActorContent.php?idActor='.$_REQUEST['idRefActor']);
}
print '<div>';
print $form->inputForm("text", "contentName", "", ['label'=>'Nom','placeholder'=>'nom'],['class'=>"form-field form-field-margin-bottom col-xs-8"]);
print $form->selectForm("contentDisk", -1,content::$disks,['label'=>'Disque dur'],['class'=>"form-field form-field-margin-bottom col-xs-4"]);
print $form->hidden('isModal', $isModal);
print '</div>';
print '<div>';
print $form->selectForm("contentType", -1,content::$content_types,['label'=>'Type'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->selectForm("contentQuality", -1,content::$qualities,['label'=>'Qualité'],['class'=>"form-field form-field-margin-bottom col-xs-3"]);
print $form->selectForm("contentLanguage", -1,content::$languages,['label'=>'Language'],['class'=>"form-field form-field-margin-bottom col-xs-2"]);
print $form->selectForm("contentYear", -1, getYearRange(true,true),['label'=>'Année'],['class'=>"form-field form-field-margin-bottom col-xs-2"]);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Chercher",null,['class'=>"media-btn"]);
if($isModal==0){
    print $form->button("Exporter", ['type' => 'button', 'onclick' => 'modelExport(this);'], ['class' => "media-btn"]);
    print $form->button("Ajouter", ['type' => 'button', 'onclick' => "javascript:location.href='/media/model/content/view/contentManage.php?idContent=0'"], ['class' => "media-btn"]);
}
print '</div>';
print $form->close();
panelClose();
?>

<div id="contentExport"></div>
<div id="contentSearchList"></div>