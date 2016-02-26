<?php
	panelOpen("Liste des acteurs");

	if(isset($_REQUEST['isModal'])==0){
		$isModal=0;
	}else{
		$isModal=$_REQUEST['isModal'];
	}
?>

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
				<td>
					<?php print htmlspecialchars($d['lastName']); ?>
					<img src="<?php //print $d['image']; ?>" alt="">
				</td>
				<td><?php print htmlspecialchars($d['firstName']); ?></td>
				<td>
					<?php if($isModal==0){ ?>
						<i onclick="javascript:location.href='/media/model/actor/view/actorManage.php?idActor=<?php echo $d['idActor'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i onclick="javascript:location.href='/media/model/actor/view/actorContentManage.php?idActor=<?php echo $d['idActor'] ?>'" class="fa fa-list-alt user-action-edit" title="Liste"></i>
						<i id="actor-<?php echo $d['idActor']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="actor" data-id="<?php echo $d['idActor'] ?>" data-confirm="Supprimer l'acteur ?" data-url="/media/model/actor/controller/delete.php?idActor=<?php echo $d['idActor']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
					<?php }else{
							if (isset($_REQUEST['idRefContent'])==1) {
								$exists = content::diskExists($_REQUEST['idRefContent'], $d['idActor']);
							}
					?>
					<input id="cbc-<?php echo $d['idActor'] ?>" data-label="<?php print $d['lastName']. ' ' . $d['firstName'] ?>" data-id="<?php echo $d['idActor'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
					<?php  } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php panelClose(); ?>

<script type="text/javascript">dataTableSet("table-actor<?php if($isModal>0) print '-modal';?>");</script>


