<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Type de média" ,ENT_QUOTES ,"UTF-8"); ?> <i class="fa fa-plus-circle user-action-add" onclick="javascript:location.href='/media/model/contentType/view/contentTypeManage.php?idContentType=0'" title="<?php print htmlspecialchars("Ajouter un type de média"); ?>"></i></li>
	</ol>
</div>

<br>

<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/contentType/contentType.php';
	$data=contentType::getList(null,null,null,null);
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/contentType/view/contentTypeList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>