<?php

class image
{
    public $idImage;
    public $idRef;
    public $iRefType;
    public $pathName;
    public $fileName;
    public $iOrder;

    public function __construct($id=0)	{
        if ($id>0)
            $this->getImage($id);
    }

    public function debug()	{
        print ' idImage:' . $this->idImage;
        print ' idRef:' . $this->idRef;
        print ' iRefType' . $this->iRefType;
        print ' pathName:' . $this->pathName;
        print ' fileName:' . $this->fileName;
        print ' iOrder:' . $this->iOrder;
    }

    function getImage($id)
    {
        global $bdd;
        $req = $bdd->prepare('select idRef, iRefType, iOrder, pathName, fileName from image where idImage=:id');
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $result = $req->execute();
        if ($result == true) {
            $data = $req->fetch();
        } else {
            $data = array();
        }
        return $data;
    }

    static function insert($idRef, $iRefType, $pathName, $fileName)
    {
        global $bdd;
        $req = $bdd->prepare('insert into image (idRef,iRefType,pathName,fileName) values (:idRef,:iRefType,:pathName,:fileName)');
        $req->bindParam(":pathName", $pathName, PDO::PARAM_STR);
        $req->bindParam(":fileName", $fileName, PDO::PARAM_STR);
        $req->bindParam(":idRef", $idRef, PDO::PARAM_INT);
        $req->bindParam(":iRefType", $iRefType, PDO::PARAM_INT);
        $result = $req->execute();
        return $bdd->lastInsertId();
    }

    static function update($id, $pathName, $fileName)
    {
        global $bdd;
        $req = $bdd->prepare('update image set pathName=:pathName, fileName=:fileName where idImage=:id');
        $req->bindParam(":pathName", $pathName, PDO::PARAM_STR);
        $req->bindParam(":fileName", $fileName, PDO::PARAM_STR);
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $result = $req->execute();
        return (int)$result;
    }

    static function getList($idRef, $iRefType)
    {
        global $bdd;
        $sql = "select idImage, idRef,iRefType,pathName,fileName from image where idRef=:idRef and iRefType=:iRefType";
        $req = $bdd->prepare($sql);
        $req->bindParam(":idRef", $idRef, PDO::PARAM_INT);
        $req->bindParam(":iRefType", $iRefType, PDO::PARAM_INT);
        $result = $req->execute();
        if ($result == 1) {
            $data = $req->fetchAll();
        } else {
            $data = array();
        }
        return $data;
    }

    static function delete($id, $idRef = null, $iRefType = null)
    {
        global $bdd;
        $result=1;
        $images=array();
        if (isset($id)) {
            $images[0] = self::getImage($id);
        }
        if (isset($idRef) && isset($iRefType)) {
            $images = self::getList($idRef,$iRefType);
        }

        foreach((array)$images as $image){
            $req = $bdd->prepare("delete from image where idImage=:id");
            $req->bindParam(":id", $image['idImage'], PDO::PARAM_INT);
            $result = $req->execute();
            if ($result==true) {
                $result = unlink(getServerPublicPath() . $image['pathName'] . '/' . $image['fileName']);
                if ($result == true)
                    $result = unlink(getServerPublicPath() . $image['pathName'] . '/small_' . $image['fileName']);
            }
            if ($result==false)
                break;
        }

        return (int)$result;
    }
}