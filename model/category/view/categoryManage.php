<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/category/category.php'; ?>

<?php

if (isset($_REQUEST['idCategory']) && $_REQUEST['idCategory']>0) {
	$id = $_REQUEST['idCategory'];
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
		<li class="active"><?php print htmlentities("Categorie" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities($title ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
$category = new category($id);
$form = new formBuilder();

panelOpen("Paramètres de la catégorie");
print $form->open(['name'=>'categoryForm', 'method'=>'post', 'action'=>'/media/model/category/controller/action.php']);
print $form->hidden('idCategory', $id);
print '<div class="col-xs-12">';
print $form->inputForm("text", "categoryName", $category->name, ['label'=>'Nom','placeholder'=>'nom']);
print '</div>';
print '<div class="col-xs-12" style="display: flex;">';
print $form->button("Valider",null,['class'=>"media-btn"]);
print $form->button("Retour",['type'=>'button', 'onclick'=>"javascript:location.href='/media/model/category/view/category.php'"],['class'=>"media-btn"]);
print '</div>';
print $form->close();
panelClose();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>