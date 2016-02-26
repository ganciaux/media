<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/contentType/contentType.php'; ?>

<?php

if (isset($_REQUEST['idContentType']) && $_REQUEST['idContentType']>0) {
	$id = $_REQUEST['idContentType'];
	$title = "Edition";
}
else{
	$id=0;
	$title = "Création";
}
?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Type de média" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
$contentType = new contentType($id);
$form = new formBuilder();

panelOpen("Paramètres du type de média");
print $form->open(['name'=>'contentTypeForm', 'method'=>'post', 'action'=>'/media/model/contentType/controller/action.php']);
print $form->hidden('idContentType', $id);
print '<div class="col-xs-12">';
print $form->inputForm("text", "contentTypeName", $contentType->name, ['label'=>'Nom','placeholder'=>'nom']);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/contentType/view/contentType.php'"],['class'=>"media-btn"]);
print '</div>';
print $form->close();
panelClose();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>