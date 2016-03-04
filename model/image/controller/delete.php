<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/image.php';

$result=1;
$message="";
$errors = array();

if (isset($_REQUEST['idImage'])){
    $result=image::delete($_REQUEST['idImage']);
    $message="L'image a bien été supprimé";
}else{
    $result=0;
    $message="Impossible de supprimer l'acteur";
}

$data = array("result"=>$result, "message"=>$message, "responseText"=>json_encode($errors));

print json_encode($data);