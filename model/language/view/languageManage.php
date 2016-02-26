<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/language/language.php'; ?>

<?php

if (isset($_REQUEST['idLanguage']) && $_REQUEST['idLanguage']>0) {
	$id = $_REQUEST['idLanguage'];
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
		<li class="active"><?php print htmlentities("Langue" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
$language = new language($id);
$form = new formBuilder();

panelOpen("Paramètres de la langue");
print $form->open(['name'=>'languageForm', 'method'=>'post', 'action'=>'/media/model/language/controller/action.php']);
print $form->hidden('idLanguage', $id);
print '<div class="col-xs-12">';
print $form->inputForm("text", "languageName", $language->name, ['label'=>'Nom','placeholder'=>'nom']);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/language/view/language.php'"],['class'=>"media-btn"]);
print '</div>';
print $form->close();
panelClose();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>