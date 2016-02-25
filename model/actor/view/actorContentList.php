<?php foreach($actorList as $d) { ?>
	<div>
		<input type="checkbox" class="cbc-data" id="cbc-<?php echo $d['idActor'] ?>" name="actorList[]" value="<?php echo $d['idActor'] ?>" data-id="<?php echo $d['idActor'] ?>" checked>
		<?php print htmlspecialchars($d['lastName']); print htmlspecialchars($d['firstName']);?>
	</div>
<?php  } ?>
