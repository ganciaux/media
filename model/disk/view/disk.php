<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<h1>
	Liste des disques dur
	<a href="/media/model/disk/view/diskManage.php?idDisk=0" class="btn btn-primary">Ajouter un disque dur</a>
</h1>

<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php';
	$data = disk::getList();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/view/diskList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>