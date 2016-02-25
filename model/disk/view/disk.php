<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Disques dur" ,ENT_QUOTES ,"UTF-8"); ?> <i class="fa fa-plus-circle user-action-add" onclick="javascript:location.href='/media/model/disk/view/diskManage.php?idDisk=0'" title="<?php print htmlspecialchars("Ajouter un disque dur"); ?>"></i></li>
	</ol>
</div>

<br>

<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php';
	$data = disk::getList();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/view/diskList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>