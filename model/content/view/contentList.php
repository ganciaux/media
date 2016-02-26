<?php
	content::setList(1,true);

	if(isset($_REQUEST['isModal'])==0){
		$isModal=0;
	}else{
		$isModal=$_REQUEST['isModal'];
	}
?>

<?php panelOpen("Liste des médias"); ?>
	<table id="table-content<?php if($isModal>0) print '-modal';?>" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Type</th>
			<?php if(isset($idRefDisk)==0){ ?>
				<th>Disque dur</th>
			<?php } ?>
			<?php if($isModal==0){ ?>
				<th>Année</th>
				<th>Language</th>
				<th>Qualité</th>
			<?php } ?>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d) { ?>
			<tr id="table-content_tr-<?php echo $d['idContent'] ?>">
				<td><?php print htmlspecialchars($d['name']); ?></td>
				<td><?php print getValue(content::$contentTypes,$d['idContentType']); ?></td>
				<?php if(isset($idRefDisk)==0){ ?>
					<td><?php print getValue(content::$disks,$d['idDisk']); ?></td>
				<?php } ?>
				<?php if($isModal==0){ ?>
					<td><?php print $d['year']; ?></td>
					<td><?php print getValue(content::$languages,$d['idLanguage']); ?></td>
					<td><?php print getValue(content::$qualities,$d['idQuality']); ?></td>
				<?php } ?>
				<td>
				<?php if($isModal==0){ ?>
					<i onclick="javascript:location.href='/media/model/content/view/contentManage.php?idContent=<?php echo $d['idContent'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
					<i id="content-<?php echo $d['idContent']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="content" data-id="<?php echo $d['idContent'] ?>" data-confirm="Supprimer le média ?" data-url="/media/model/content/controller/delete.php?idContent=<?php echo $d['idContent']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
				<?php }else{
					if (isset($_REQUEST['idRefDisk'])==1) {
						$exists = content::diskExists($_REQUEST['idRefDisk'], $d['idContent']);
					} else if(isset($_REQUEST['idRefActor'])==1){
						$exists=content::actorExists($_REQUEST['idRefActor'],$d['idContent']);
					}else
						$exists=0;
				?>
					<input id="cbc-<?php echo $d['idContent'] ?>" data-id="<?php echo $d['idContent'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
				<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php panelClose(); ?>

<script type="text/javascript">dataTableSet("table-content<?php if($isModal>0) print '-modal';?>");</script>
