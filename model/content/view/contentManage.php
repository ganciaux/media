<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php'; ?>

<h1>
	Gestion du média
</h1>

<?php

if (isset($_REQUEST['idContent']) && $_REQUEST['idContent']>0)
	$id=$_REQUEST['idContent'];
else
	$id=0;

content::setList(1,true);
$content = new content($id);
$form = new formBuilder();

print $form->open(['name'=>'contentForm', 'method'=>'post', 'action'=>'/media/model/content/controller/action.php']);
print $form->hidden('idContent', $id);
print $form->inputForm("text", "contentName", $content->name, ['label'=>'Nom','placeholder'=>'nom'],['class'=>"form-field form-field-margin-bottom col-xs-10"]);
print $form->selectForm("contentDisk", $content->idDisk,content::$disks,['label'=>'Disque dur'],['class'=>"form-field form-field-margin-bottom col-xs-10"]);
print '<div class="row col-xs-11">';
print $form->selectForm("contentType", $content->idContentType,content::$content_types,['label'=>'Type'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->selectForm("contentYear", $content->year,array_combine(range(date("Y"),1950,-1),range(date("Y"),1950,-1)),['label'=>'Année'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print '</div><div class="row col-xs-11">';
print $form->selectForm("contentLanguage", $content->idLanguage,content::$languages,['label'=>'Language'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->selectForm("contentQuality", $content->idQuality,content::$qualities,['label'=>'Qualité'],['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print '</div>';
print $form->submit("Valider",null,['class'=>"form-field form-field-margin-bottom col-xs-5"]);
print $form->close();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>