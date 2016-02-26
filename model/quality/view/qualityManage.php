<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/quality/quality.php'; ?>

<?php

if (isset($_REQUEST['idQuality']) && $_REQUEST['idQuality']>0) {
	$id = $_REQUEST['idQuality'];
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
		<li class="active"><?php print htmlentities("Qualité" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
$quality = new quality($id);
$form = new formBuilder();

panelOpen("Paramètres de la qualité");
print $form->open(['name'=>'qualityForm', 'method'=>'post', 'action'=>'/media/model/quality/controller/action.php']);
print $form->hidden('idQuality', $id);
print '<div class="col-xs-12">';
print $form->inputForm("text", "qualityName", $quality->name, ['label'=>'Nom','placeholder'=>'nom']);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/quality/view/quality.php'"],['class'=>"media-btn"]);
print '</div>';
print $form->close();
panelClose();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>