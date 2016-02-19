<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php'; ?>

<h1>
	Gestion du disque dur
</h1>

<?php

if (isset($_REQUEST['idDisk']) && $_REQUEST['idDisk']>0)
	$id=$_REQUEST['idDisk'];
else
	$id=0;

$disk = new disk($id);
$form = new formBuilder();

print $form->open(['name'=>'diskForm', 'method'=>'post', 'action'=>'/media/model/disk/controller/action.php']);
print $form->hidden('idDisk', $id);
print $form->inputForm("text", "diskName", $disk->name, ['label'=>'Nom','placeholder'=>'nom']);
print $form->inputForm("text", "diskLabel", $disk->label, ['label'=>'Label', 'placeholder'=>'label']);
print $form->inputForm("text", "diskSize", $disk->size, ['label'=>'Taille', 'placeholder'=>'taille']);
print $form->textarea("diskComment", $disk->comment, ['label'=>'Commentaire', 'placeholder'=>'commentaire']);
print $form->submit("Valider");
print $form->close();
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>