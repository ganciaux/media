<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/image.php';
    $result=1;
    if (isset($idRef)==false || isset($iRefType)==false){
        $result=0;
        $images=array();
    }
    else{
        $images=image::getList($idRef, $iRefType);
    }
    if (isset($objectList)==false){
        $objectList="objectList";
    }
?>

<div id="image-list">
<div><label>Liste des images</label></div>
<?php if ($result==1){?>
<div class="media-image">
    <?php
        if (count($images)==0){
            print "<div>Aucune images</div>";
        }else{
            foreach($images as $image) { ?>
            <div id="div-image-<?php print $image['idImage']?>" style="display:inline-block">
                <i id="i-<?php print $image['idImage']?>" class="fa fa-trash object-action-delete-form user-action-delete" data-object="image" data-object-list="<?php print $objectList;?>" data-id="<?php echo $image['idImage'] ?>" data-confirm="Supprimer l'image ?" data-url="/media/model/image/controller/delete.php?idImage=<?php echo $image['idImage']; ?>" data-fncallback="imageDelete" data-action="delete" data-callback="action-delete" title="Supprimer"></i>
                <a class="fancybox" rel="group" href="<?php print getPublicPath().$image['pathName'].'/'.$image['fileName'];?>"><img id="image-<?php print $image['idImage']?>" width="50px" src="<?php print getPublicPath().$image['pathName'].'/small_'.$image['fileName'];?>" alt="" data-id="<?php echo $image['idImage'] ?>"/></a>
            </div>
        <?php }} ?>
</div>
<?php }else{?>
    <div class="alert media-alert alert-danger" style="margin-bottom: 20px;">Impossible de récupérer la liste des images</div>
<?php }?>
<br>
</div>