<table id="table-disk" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Label</th>
			<th>Taille</th>
			<th>Commentaire</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-disk_tr-<?php echo $d['idDisk'] ?>">
				<td><?php print htmlspecialchars($d['name']); ?></td>
				<td><?php print htmlspecialchars($d['label']); ?></td>
				<td><?php print htmlspecialchars($d['size']); ?></td>
				<td><?php print htmlspecialchars($d['comment']); ?></td>
				<td>
					<i onclick="javascript:location.href='/media/model/disk/view/diskManage.php?idDisk=<?php echo $d['idDisk'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
					<i onclick="javascript:location.href='/media/model/disk/view/diskContentManage.php?idDisk=<?php echo $d['idDisk'] ?>'" class="fa fa-list-alt user-action-edit" title="Liste"></i>
					<i id="disk-<?php echo $d['idDisk']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="disk" data-id="<?php echo $d['idDisk'] ?>" data-confirm="Supprimer disque dur ?" data-url="/media/model/disk/controller/delete.php?idDisk=<?php echo $d['idDisk']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
				</td>       
			</tr>
		<?php } ?>
	</tbody>
</table>
<script  type="text/javascript">dataTableSet("table-disk");</script>