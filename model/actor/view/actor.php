<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>

<h1>
	Liste des acteurs
	<a href="/media/model/actor/view/actorManage.php?idActor=0" class="btn btn-primary">Ajouter un acteur</a>
</h1>

<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php';
	//actor::import();
	$data = actor::getList();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/view/actorList.php';
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>