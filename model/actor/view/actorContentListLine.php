<?php
	if (isset($d)==null){
		$d=json_decode($_REQUEST['d'],true);
	}
?>


<tr id="tr-actor-<?php print $d['idActor'] ?>">
	<td>
		<input type="hidden" class="object-data" id="actor-<?php print $d['idActor'] ?>" data-id="tr-actor-<?php print $d['idActor'] ?>" name="actorList[]" value="<?php print $d['idActor'] ?>">
		<i class="fa fa-trash object-action-list-delete user-action-delete" data-id="tr-actor-<?php print $d['idActor'] ?>" title="Supprimer"></i>
		<?php print htmlspecialchars($d['label']); ?>
	</td>
</tr>
