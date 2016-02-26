<div class="panel panel-default">
	<div class="panel-heading"><strong>Liste des acteurs</strong></div>
	<table id="table-actor-content" class="table">
		<tbody>
			<?php foreach($actorList as $d) {
				$d['label']=$d['firstName'].' '.$d['lastName'];
				include $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/view/actorContentListLine.php';
			} ?>
		</tbody>
	</table>
</div>


