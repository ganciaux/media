<?php content::setList(1,true);?>

<table id="table-content" class="table striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Type</th>
                        <th>Disque dur</th>
                        <?php if(isset($isModal)==0){ ?>
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
				<td><?php print getValue(content::$content_types,$d['idContentType']); ?></td>
				<td><?php print getValue(content::$disks,$d['idDisk']); ?></td>
                                <?php if(isset($isModal)==0){ ?>
                                <td><?php print $d['year']; ?></td>
				<td><?php print getValue(content::$languages,$d['idLanguage']); ?></td>
				<td><?php print getValue(content::$qualities,$d['idQuality']); ?></td>
				<?php } ?>
                                <td>
					<?php if(isset($isModal)==0){ ?>
						<i onclick="javascript:location.href='/media/model/content/view/contentManage.php?idContent=<?php echo $d['idContent'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
						<i id="content-<?php echo $d['idContent']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="content" data-id="<?php echo $d['idContent'] ?>" data-confirm="Supprimer le média ?" data-url="/media/model/content/controller/delete.php?idContent=<?php echo $d['idContent']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
					<?php }else{ ?>
                                        <?php $exists=content::diskExists($idDisk,$d['idContent']); ?>
                                                <input id="cbc-<?php echo $d['idContent'] ?>" <?php if($exists==1){print 'checked';}?> type="checkbox" data-exists="<?php print $exists;?>" class="cbc-data">
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php if(isset($isModal)==0){?>
	<script  type="text/javascript">dataTableSet("table-content");</script>
<?php } ?>