<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php'; ?>

<h1>
	Gestion de l'acteur
</h1>

<?php

if (isset($_REQUEST['idActor']) && $_REQUEST['idActor']>0)
	$id=$_REQUEST['idActor'];
else
	$id=0;

$actor = new actor($id);
$form = new formBuilder();

print $form->open(['name'=>'actorForm', 'method'=>'post', 'action'=>'/media/model/actor/controller/action.php']);
print $form->hidden('idActor', $id);
print $form->inputForm("text", "actorLastName", $actor->lastName, ['label'=>'Nom','placeholder'=>'nom']);
print $form->inputForm("text", "actorFirstName", $actor->firstName, ['label'=>'Prénom','placeholder'=>'prénom']);
print $form->submit("Valider");
print $form->close();
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/footer.php'; ?>