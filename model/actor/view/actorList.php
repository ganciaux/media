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
						<i id="actor-info-<?php echo $d['idActor']?>" class="fa fa-info-circle popover-info user-action-info" data-object="actor" data-id="<?php echo $d['idActor'] ?>" data-url="/media/model/actor/controller/info.php?idActor=<?php echo $d['idActor']; ?>" data-action="info" data-header="" data-body="" data-image="<?php echo $d['image']; ?>" title="Information"></i>
						<i onclick="javascript:location.href='/media/model/actor/view/actorManage.php?idActor=<?php echo $d['idActor'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i onclick="javascript:location.href='/media/model/actor/view/actorContentManage.php?idActor=<?php echo $d['idActor'] ?>'" class="fa fa-list-alt user-action-edit" title="Liste"></i>
						<i id="actor-<?php echo $d['idActor']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="actor" data-id="<?php echo $d['idActor'] ?>" data-confirm="Supprimer l'acteur '<?php print htmlspecialchars($d['lastName']).' '.htmlspecialchars($d['firstName']); ?>' ?" data-url="/media/model/actor/controller/delete.php?idActor=<?php echo $d['idActor']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer"></i>
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

<?php foreach($data as $d) { ?>
	<div class="product-thumb product-thumb-horizontal">
		<header class="product-header">
			<img title="" alt="" src="<?php echo $d['image'];?>">
		</header>
		<div class="product-inner">
			<div class="row">
				<div class="col-sm-10">
					<a>
						<h2 class="product-title h2">
							<?php print htmlspecialchars($d['lastName']); ?>
							<?php print htmlspecialchars($d['firstName']); ?>
						</h2>
					</a>
				</div>
				<div class="col-sm-2 text-right">
					<span class="btn btn-success"><i onclick="javascript:location.href='/media/model/actor/view/actorManage.php?idActor=<?php echo $d['idActor'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i></span>
					<span class="btn btn-danger"><i id="actor-<?php echo $d['idActor']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="actor" data-id="<?php echo $d['idActor'] ?>" data-confirm="Supprimer l'acteur '<?php print htmlspecialchars($d['lastName']).' '.htmlspecialchars($d['firstName']); ?>' ?" data-url="/media/model/actor/controller/delete.php?idActor=<?php echo $d['idActor']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer"></i></span>
				</div>
			</div>
			<div class="row info">
				<div class="col-sm-12">
					<?php $contents = content::getList(null,null,null,['idActor'=>$d['idActor']]);?>
					<h4 class="product-sub-title">Liste des films:</h4>
					<?php
						if(empty($contents)==false) {
							foreach($contents as $c) {
								print($c['name']);
					?>
								<i onclick="javascript:location.href='/media/model/content/view/contentManage.php?idContent=<?php echo $c['idContent'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
					<?php
							}
						}
						else {
							print 'Aucun';
						}
					?>

				</div>
			</div>
		</div>
	</div>
<?php  } ?>

<script type="text/javascript">dataTableSet("table-actor<?php if($isModal>0) print '-modal';?>");</script>
