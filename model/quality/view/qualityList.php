<?php
	panelOpen("Liste des qualité");

	if(isset($_REQUEST['isModal'])==0){
		$isModal=0;
	}else{
		$isModal=$_REQUEST['isModal'];
	}
?>

<table id="table-quality" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-quality_tr-<?php echo $d['idQuality'] ?>">
				<td><?php print htmlspecialchars($d['name']); ?></td>
				<td>
					<?php if($isModal==0){ ?>
						<i onclick="javascript:location.href='/media/model/quality/view/qualityManage.php?idQuality=<?php echo $d['idQuality'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i id="quality-<?php echo $d['idQuality']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="quality" data-id="<?php echo $d['idQuality'] ?>" data-confirm="Supprimer la qualité ?" data-url="/media/model/quality/controller/delete.php?idQuality=<?php echo $d['idQuality']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
					<?php }else{ ?>
					<input id="cbc-<?php echo $d['idQuality'] ?>" data-label="<?php print $d['name']; ?>" data-id="<?php echo $d['idQuality'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
					<?php  } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php panelClose(); ?>

<script type="text/javascript">dataTableSet("table-quality<?php if($isModal>0) print '-modal';?>");</script>


