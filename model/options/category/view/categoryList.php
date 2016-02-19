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
					<i onclick="javascript:location.href='/media/model/options/category/view/categoryManage.php?idCategory=<?php echo $d['idCategory'] ?>'" class="fa fa-pencil user-action-edit" title="Modifier"></i>
					<i id="category-<?php echo $d['idCategory']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="category" data-id="<?php echo $d['idCategory'] ?>" data-confirm="Supprimer la catégorie ?" data-url="/media/model/category/controller/delete.php?idCategory=<?php echo $d['idCategory']; ?>" data-action="delete" data-callback="action-delete" title="Supprimer">
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">dataTableSet("table-category");</script>