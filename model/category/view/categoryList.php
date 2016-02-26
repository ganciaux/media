<?php
	panelOpen("Liste des categorie");

	if(isset($_REQUEST['isModal'])==0){
		$isModal=0;
	}else{
		$isModal=$_REQUEST['isModal'];
	}
?>

<table id="table-category" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-category_tr-<?php echo $d['idCategory'] ?>">
				<td><?php print htmlspecialchars($d['name']); ?></td>
				<td>
					<?php if($isModal==0){ ?>
						<i onclick="javascript:location.href='/media/model/category/view/categoryManage.php?idCategory=<?php echo $d['idCategory'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i id="category-<?php echo $d['idCategory']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="category" data-id="<?php echo $d['idCategory'] ?>" data-confirm="Supprimer la catégorie ?" data-url="/media/model/category/controller/delete.php?idCategory=<?php echo $d['idCategory']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
					<?php }else{ ?>
					<input id="cbc-<?php echo $d['idCategory'] ?>" data-label="<?php print $d['name']; ?>" data-id="<?php echo $d['idCategory'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
					<?php  } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php panelClose(); ?>

<script type="text/javascript">dataTableSet("table-category<?php if($isModal>0) print '-modal';?>");</script>


