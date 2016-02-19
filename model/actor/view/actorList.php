<table id="table-actor" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-actor_tr-<?php echo $d['idActor'] ?>">
				<td><?php print htmlspecialchars($d['lastName']); ?></td>
				<td><?php print htmlspecialchars($d['firstName']); ?></td>
				<td>
					<i onclick="javascript:location.href='/media/model/actor/view/actorManage.php?idActor=<?php echo $d['idActor'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
					<i id="actor-<?php echo $d['idActor']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="actor" data-id="<?php echo $d['idActor'] ?>" data-confirm="Supprimer l'acteur ?" data-url="/media/model/actor/controller/delete.php?idActor=<?php echo $d['idActor']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">dataTableSet("table-actor");</script>