<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php'; ?>

	<div class="page-header media-page-header">
		<ol class="breadcrumb media-breadcrumb">
			<li><span class="fa fa-home"></span></li>
			<li class="active"><?php print htmlentities("Acteur" ,ENT_QUOTES ,"UTF-8"); ?></li>
			<li class="active"><?php print htmlentities("Liste" ,ENT_QUOTES ,"UTF-8"); ?></li>
		</ol>
	</div>

	<br>

<?php
if (isset($_REQUEST['idActor']) && $_REQUEST['idActor']>0)
	$id=$_REQUEST['idActor'];

$actor = new actor($id);

$action='<i class="fa fa-plus-square object-action-search user-action-search" data-url="/media/model/content/view/contentFormSearch.php?idRefActor='.$id.'" data-callback-id="contentList" data-callback-url="/media/model/content/controller/search.php?idActor='. $id .'" data-title="Ajouter un média" data-id="'.$id.'"></i>';

panelOpen("Paramètres de l'acteur",$action);
?>

	<dl class="dl-horizontal">
		<dt>Nom</dt>
		<dd><?php print htmlspecialchars($actor->lastName);?></dd>
		<dt>Prénom</dt>
		<dd><?php print htmlspecialchars($actor->firstName);?></dd>
	</dl>
<?php panelClose();?>

	<div id="contentList">
		<?php
		include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';
		$data = content::getList(null,null,null,['idActor'=>$id]);
		include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/view/contentList.php';
		?>
	</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>