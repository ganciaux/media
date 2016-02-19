<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<h1>
	Liste des catégories
	<a href="/media/model/options/category/view/categoryManage.php?idCategory=0" class="btn btn-primary">Ajouter une catégorie</a>
</h1>

<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/category/category.php';
	$data = category::getList();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/category/view/categoryList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>