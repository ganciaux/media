<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php'; ?>

<?php

if (isset($_REQUEST['idActor']) && $_REQUEST['idActor']>0) {
	$id = $_REQUEST['idActor'];
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
		<li class="active"><?php print htmlentities("Acteur" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
$actor = new actor($id);
$form = new formBuilder();

panelOpen("Paramètres de l'acteur");
print $form->open(['name'=>'actorForm', 'method'=>'post', 'action'=>'/media/model/actor/controller/action.php']);
print $form->hidden('idActor', $id);
print '<div class="col-xs-12">';
print $form->inputForm("text", "actorLastName", $actor->lastName, ['label'=>'Nom','placeholder'=>'nom']);
print $form->inputForm("text", "actorFirstName", $actor->firstName, ['label'=>'Prénom','placeholder'=>'prénom']);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/actor/view/actor.php'"],['class'=>"media-btn"]);
print '</div>';
print $form->close();
panelClose();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>