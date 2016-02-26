<?php
	panelOpen("Liste des types de média");

	if(isset($_REQUEST['isModal'])==0){
		$isModal=0;
	}else{
		$isModal=$_REQUEST['isModal'];
	}
?>

<table id="table-contentType" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-contentType_tr-<?php echo $d['idContentType'] ?>">
				<td><?php print htmlspecialchars($d['name']); ?></td>
				<td>
					<?php if($isModal==0){ ?>
						<i onclick="javascript:location.href='/media/model/contentType/view/contentTypeManage.php?idContentType=<?php echo $d['idContentType'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i id="contentType-<?php echo $d['idContentType']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="contentType" data-id="<?php echo $d['idContentType'] ?>" data-confirm="Supprimer le type de média ?" data-url="/media/model/contentType/controller/delete.php?idContentType=<?php echo $d['idContentType']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
					<?php }else{ ?>
					<input id="cbc-<?php echo $d['idContentType'] ?>" data-label="<?php print $d['name']; ?>" data-id="<?php echo $d['idContentType'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
					<?php  } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php panelClose(); ?>

<script type="text/javascript">dataTableSet("table-contentType<?php if($isModal>0) print '-modal';?>");</script>


