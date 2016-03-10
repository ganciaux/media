<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/home/home.php'; ?>

<br>

<?php panelOpen("Statistiques"); ?>

<?php
$actor=getObjectCount('actor');
$content=getObjectCount('content');
$disk=getObjectCount('disk');

print "acteur: ".$actor;
print "<br>content: ".$content;
print "<br>disk: ".$disk;

?>


<?php panelClose(); ?>

</div>