<?php
	panelOpen("Liste des langue");

	if(isset($_REQUEST['isModal'])==0){
		$isModal=0;
	}else{
		$isModal=$_REQUEST['isModal'];
	}
?>

<table id="table-language" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-language_tr-<?php echo $d['idLanguage'] ?>">
				<td><?php print htmlspecialchars($d['name']); ?></td>
				<td>
					<?php if($isModal==0){ ?>
						<i onclick="javascript:location.href='/media/model/language/view/languageManage.php?idLanguage=<?php echo $d['idLanguage'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i id="language-<?php echo $d['idLanguage']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="language" data-id="<?php echo $d['idLanguage'] ?>" data-confirm="Supprimer la langue ?" data-url="/media/model/language/controller/delete.php?idLanguage=<?php echo $d['idLanguage']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
					<?php }else{ ?>
					<input id="cbc-<?php echo $d['idLanguage'] ?>" data-label="<?php print $d['name']; ?>" data-id="<?php echo $d['idLanguage'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
					<?php  } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php panelClose(); ?>

<script type="text/javascript">dataTableSet("table-language<?php if($isModal>0) print '-modal';?>");</script>


