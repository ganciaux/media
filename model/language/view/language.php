<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Langue" ,ENT_QUOTES ,"UTF-8"); ?> <i class="fa fa-plus-circle user-action-add" onclick="javascript:location.href='/media/model/language/view/languageManage.php?idLanguage=0'" title="<?php print htmlspecialchars("Ajouter une langue"); ?>"></i></li>
	</ol>
</div>

<br>

<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/language/language.php';
	$data=language::getList(null,null,null,null);
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/language/view/languageList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>