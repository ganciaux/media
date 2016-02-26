<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; ?>

<div class="page-header media-page-header">
	<ol class="breadcrumb media-breadcrumb">
		<li><span class="fa fa-home"></span></li>
		<li class="active"><?php print htmlentities("Disque dur" ,ENT_QUOTES ,"UTF-8"); ?></li>
		<li class="active"><?php print htmlentities("Liste" ,ENT_QUOTES ,"UTF-8"); ?></li>
	</ol>
</div>

<br>

<?php
if (isset($_REQUEST['idDisk']) && $_REQUEST['idDisk']>0)
	$id=$_REQUEST['idDisk'];

$disk = new disk($id);

$action='<i class="fa fa-plus-square object-action-search user-action-search" data-url="/media/model/content/view/contentFormSearch.php?idRefDisk='.$id.'" data-callback-id="contentList" data-callback-url="/media/model/content/controller/search.php?idDisk='. $id .'" data-title="Ajouter un média" data-id="'.$id.'"></i>';

panelOpen("Paramètre du disque dur",$action);
?>

<dl class="dl-horizontal">
	<dt>Nom</dt>
	<dd><?php print htmlspecialchars($disk->name);?></dd>
	<dt>Label</dt>
	<dd><?php print htmlspecialchars($disk->label);?></dd>
	<dt>Taille</dt>
	<dd><?php print htmlspecialchars($disk->size);?></dd>
	<dt>Commentaire</dt>
	<dd><?php print htmlspecialchars($disk->comment);?></dd>
</dl>
<?php panelClose();?>

<div id="contentList">
<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';
	$data = content::getList(null,null,null,['idDisk'=>$id]);
	$idRefDisk=$id;
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/view/contentList.php';
?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>