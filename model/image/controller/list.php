<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/actor/actor.php';

if (isset($_REQUEST['idRef']) && isset($_REQUEST['iRefType'])){
    $idRef=$_REQUEST['idRef'];
    $iRefType=$_REQUEST['iRefType'];
    include $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/view/imageList.php';
}else{
    print '<div class="alert media-alert alert-danger" style="margin-bottom: 20px;">Impossible de récupérer la liste des images</div>';
}

