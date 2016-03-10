<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; ?>

<?php

if (isset($_REQUEST['idContent']) && $_REQUEST['idContent']>0) {
	$id = $_REQUEST['idContent'];
	$title="Edition";
}
else {
	$id = 0;
	$title="Création";
}
?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Média" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
content::setList(1,true);
$content = new content($id);
$form = new formBuilder();

panelOpen("Paramètres du média");
print $form->open(['files'=>true, 'name'=>'contentForm', 'method'=>'post', 'action'=>'/media/model/content/controller/action.php']);
print $form->hidden('idContent', $id);
print $form->hidden('message', "");
print $form->hidden('objectList', "");
print '<div>';
print $form->inputForm("text", "contentName", $content->name, ['label'=>'Nom','placeholder'=>'nom'],['class'=>"form-field form-field-margin-bottom col-xs-8"]);
print $form->selectForm("contentDisk", $content->idDisk,content::$disks,['label'=>'Disque dur'],['class'=>"form-field form-field-margin-bottom col-xs-4"]);
print '</div>';
print '<div>';
print $form->selectForm("contentType", $content->idContentType,content::$contentTypes,['label'=>'Type'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->selectForm("contentQuality", $content->idQuality,content::$qualities,['label'=>'Qualité'],['class'=>"form-field form-field-margin-bottom col-xs-3"]);
print $form->selectForm("contentLanguage", $content->idLanguage,content::$languages,['label'=>'Language'],['class'=>"form-field form-field-margin-bottom col-xs-2"]);
print $form->selectForm("contentYear", $content->year,getYearRange(true,null),['label'=>'Année'],['class'=>"form-field form-field-margin-bottom col-xs-2"]);
print '</div>';
print '<label style="padding-left: 15px;">Acteur</label>';
print $form->inputSearch("actorName",null,['data-url'=>'/media/model/actor/controller/search.php?idRefContent='.$id,
	 										'data-field'=>'actorName',
											'data-callback-id'=>"table-actor-content",
											'data-callback-fn'=>'contentSetActor',
											'data-title'=>'Sélection acteurs']);
print '<div id="actorList" class="col-xs-12" style="margin-bottom: 15px;">';
$actorList=$content->actorList;
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/view/actorContentList.php';
print '</div>';
print $form->inputFileForm("contentFile", ['label' => 'Sélection image'], ['class' => 'col-xs-12', 'style' => "margin-bottom: 15px;"]);
if($id>0) {
	print '<div class="col-xs-12">';
	$idRef = $id;
	$iRefType = _TYPE_CONTENT_;
	$objectList = "objectList";
	include $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/view/imageList.php';
	print '</div>';
}
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/content/view/content.php'"],['class'=>"media-btn"]);
print $form->close();
print '</div>';
panelClose();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>