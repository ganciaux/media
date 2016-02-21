<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; ?>

<h1>
	Gestion du contenu du disque dur
</h1>

<?php
if (isset($_REQUEST['idDisk']) && $_REQUEST['idDisk']>0)
	$id=$_REQUEST['idDisk'];
$disk = new disk($id);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?php print htmlspecialchars($disk->name);?></h3>
	</div>
	<div class="panel-body">
		<dl class="dl-horizontal">
			<dt>Label</dt>
			<dd><?php print htmlspecialchars($disk->label);?></dd>
			<dt>Taille</dt>
			<dd><?php print htmlspecialchars($disk->size);?></dd>
			<dt>Commentaire</dt>
			<dd><?php print htmlspecialchars($disk->comment);?></dd>
		</dl>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			Liste des médias <i class="fa fa-plus-square object-action-search user-action-search" data-url="/media/model/content/view/contentFormSearch.php?idDisk=<?php print $id; ?>"></i>
		</h3>
	</div>
	<div class="panel-body">
		<?php
			include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';
			$data = content::getList(null,null,null,['idDisk'=>$id]);
			include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/view/contentList.php';
		?>
	</div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>