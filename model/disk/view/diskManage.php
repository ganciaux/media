<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; ?>

<?php

if (isset($_REQUEST['idDisk']) && $_REQUEST['idDisk']>0){
	$id=$_REQUEST['idDisk'];
	$title="Edition";
} else {
	$id = 0;
	$title = "Création";
}
?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Disque dur" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
$disk = new disk($id);
$form = new formBuilder();

panelOpen("Paramètres du disque dur");
print $form->open(['name'=>'diskForm', 'method'=>'post', 'action'=>'/media/model/disk/controller/action.php']);
print $form->hidden('idDisk', $id);
print '<div class="col-xs-12">';
print $form->inputForm("text", "diskName", $disk->name, ['label'=>'Nom','placeholder'=>'nom']);
print $form->inputForm("text", "diskLabel", $disk->label, ['label'=>'Label', 'placeholder'=>'label']);
print $form->inputForm("text", "diskSize", $disk->size, ['label'=>'Taille', 'placeholder'=>'taille']);
print $form->textarea("diskComment", $disk->comment, ['label'=>'Commentaire', 'placeholder'=>'commentaire']);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/disk/view/disk.php'"],['class'=>"media-btn"]);
print $form->close();
print '</div>';
panelClose();
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>