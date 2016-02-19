<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/category/category.php'; ?>

<h1>
	Gestion de la catégorie
</h1>

<?php

if (isset($_REQUEST['idCategory']) && $_REQUEST['idCategory']>0)
	$id=$_REQUEST['idCategory'];
else
	$id=0;

$category = new category($id);
$form = new formBuilder();

print $form->open(['name'=>'categoryForm', 'method'=>'post', 'action'=>'/media/model/options/category/controller/action.php']);
print $form->hidden('idCategory', $id);
print $form->inputForm("text", "categoryName", $category->name, ['label'=>'Nom','placeholder'=>'nom']);
print $form->submit("Valider");
print $form->close();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>