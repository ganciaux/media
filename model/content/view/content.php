<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<h1>
	<?php print htmlentities("Médiathèque" ,ENT_QUOTES ,"UTF-8"); ?>
	<a href="/media/model/content/view/contentManage.php?idContent=0" class="btn btn-primary"><?php print htmlspecialchars("Ajouter un média"); ?></a>
</h1>

<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';
	$data = content::getList();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/view/contentList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>