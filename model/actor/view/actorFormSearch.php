<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php'; ?>

<?php

if (isset($_REQUEST['idActor']) && $_REQUEST['idActor']>0)
	$id=$_REQUEST['idActor'];
else
	$id=0;

$actor = new actor($id);
$form = new formBuilder();
panelOpen("Paramètres de recherche");
print $form->open(['name'=>'actorFormSearch', 'method'=>'post', 'action'=>'/media/model/actor/controller/search.php', 'data-type'=>'html', 'data-object'=>'actor']);
print $form->hidden('idActor', $id);
print $form->inputForm("text", "actorLastName", $actor->lastName, ['label'=>'Nom','placeholder'=>'nom'],['class'=>"form-field form-field-margin-bottom col-xs-6"]);
print $form->inputForm("text", "actorFirstName", $actor->firstName, ['label'=>'Prénom','placeholder'=>'prénom'],['class'=>"form-field form-field-margin-bottom col-xs-6"]);
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Chercher",null,['class'=>"media-btn"]);
print $form->button("Exporter",['type'=>'button', 'onclick'=>'modelExport(this);'],['class'=>"media-btn"]);
print $form->button("Ajouter",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/actor/view/actorManage.php?idActor=0'"],['class'=>"media-btn"]);
print $form->close();
print '</div>';
panelClose();
?>
<div id="actorExport"></div>
<div id="actorSearchList"></div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>