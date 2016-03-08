<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/image.php';

    $images=image::getList($idRef, $iRefType);
?>

<div id="image-list">
<div><label>Liste des images</label></div>
<div class="media-image">
    <?php
        if (count($images)==0){
            print "<div>Aucune images</div>";
        }else{
            foreach($images as $image) { ?>
            <div id="div-image-<?php print $image['idImage']?>" style="display:inline-block">
                <i id="image-<?php print $image['idImage']?>" class="fa fa-trash object-action-delete user-action-delete" data-object="image" data-id="<?php echo $image['idImage'] ?>" data-confirm="Supprimer l'image ?" data-url="/media/model/image/controller/delete.php?idImage=<?php echo $image['idImage']; ?>" data-fncallback="imageDelete" data-action="delete" data-callback="action-delete" title="Supprimer"></i>
                <a class="fancybox" rel="group" href="<?php print getPublicPath().$image['pathName'].'/'.$image['fileName'];?>"><img width="50px" src="<?php print getPublicPath().$image['pathName'].'/small_'.$image['fileName'];?>" alt="" /></a>
            </div>
        <?php }} ?>
</div>
<br>
</div>