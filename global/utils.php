<?php

function getValue($array, $key, $bHtml=true){
    if (array_key_exists ($key, $array )) {
        if ($bHtml==true){
            return htmlspecialchars($array[$key]);
        }else{
            return $array[$key];
        }
    }
    else
        return '<span class="label label-danger">valeur non valide<span>';
}

function setSearchString($string){
    $replace = [
        '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
        '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
        '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
        'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
        'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
        'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
        'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
        'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
        'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
        'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
        'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
        'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
        'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
        'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
        'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
        '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
        'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
        'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
        'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
        'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
        'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
        'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
        'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
        'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
        'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
        'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
        'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
        'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
        '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
        'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
        'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
        'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
        'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
        'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
        'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
        'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
        'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
        'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
        'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
        'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
        'ю' => 'yu', 'я' => 'ya'
    ];

    $newString=str_replace(array_keys($replace), $replace, $string);
    return preg_replace('/\s+/', '', $newString);
}

function debugPdo($sth){
    $sth->debugDumpParams();
}

function panelOpen($title,$action=null){
    print '<div class="panel panel-default panel-media">';
    if (isset($title) && strlen($title)>0) {
        print '<div class="panel-heading">';
        print '<h3 class="panel-title panel-media-title">' . htmlspecialchars($title);
        if (isset($action)) {
            print ' '.$action;
        }
        print '</h3>';
        print '</div>';
    }
    print '<div class="panel-body">';
}

function panelClose(){
    print "</div></div>";
}

function getYearRange($none=null,$all=null){
    $array=array_combine(range(date("Y"),1950,-1),range(date("Y"),1950,-1));

    if (isset($none)) {
        $array=array('0' => 'Aucune')+$array;
    }
    if (isset($all)) {
        $array=array('-1' => 'Toutes')+$array;
    }

    return $array;
}


function getServerPublicPath(){
    return $_SERVER['DOCUMENT_ROOT'].'/media/public';
}

function getPublicPath(){
    return '/media/public';
}

function uploadFile($file){
    $result=array();
    $separator='.';
    $status=1;
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];
    $file_error = $file['error'];
    $file_details=explode($separator,$file_name);
    $file_ext=strtolower(end($file_details));

    $expensions=array("jpeg","jpg","png");

    if(in_array($file_ext,$expensions)=== false){
        $status=422;
        $result['error']="Extension non permise, choisir un fichier JPEG, JPG ou PNG";
    }

    if($file_size > 2097152) {
        $status=422;
        $result['error']='Fichier supérieur à 2 MB';
    }

    $result['status']=$status;
    $result['name']=$file_tmp;
    $result['ext']=$file_ext;

    return $result;
}

function getFilePath($id,$object){
    $dir="/img/" . $object . "/" . ceil($id / 1000);
    $absolutedir=getServerPublicPath().'/'.$dir;
    if(!file_exists($absolutedir)){
        mkdir($absolutedir, 0777, true);
    }
    return  $dir;
}

function resizeFile($filepath,$filename,$percent){
    // Content type
    header('Content-Type: image/jpeg');

    // Calcul des nouvelles dimensions
    list($width, $height) = getimagesize($filepath.'/'.$filename);
    $newwidth = $width * $percent;
    $newheight = $height * $percent;

    // Chargement
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefromjpeg($filepath.'/'.$filename);

    // Redimensionnement
    $result=imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    imagejpeg($thumb,$filepath.'/small_'.$filename);

    return $result;
}

function fileUpload($id,$object,$ext,$uploadname,$bresize){
    $resultUpload=array();
    $path=getFilePath($id,$object);
    $absolutepath=getServerPublicPath().$path;
    $filename=$id.'.'.$ext;

    $result=move_uploaded_file($uploadname,$absolutepath.'/'.$filename);
    if (isset($bresize) && $bresize==true && $result==true) {
        $result=resizeFile($absolutepath, $filename, 0.5);
    }
    $resultUpload['result']=$result;
    $resultUpload['path']=$path;
    $resultUpload['absolutepath']=$absolutepath;
    $resultUpload['filename']=$filename;
    $resultUpload['image']=getPublicPath().$path.'/'.$filename;

    return $resultUpload;
}

function imageInsert($pathName,$fileName){
    global $bdd;
    $req = $bdd->prepare('insert into image (pathName,fileName) values (:pathName,:fileName)');
    $req->bindParam(":pathName", $pathName, PDO::PARAM_STR);
    $req->bindParam(":fileName", $fileName, PDO::PARAM_STR);
    $result=$req->execute();
    return $bdd->lastInsertId();
}

function imageUpdate($id,$pathName,$fileName){
    global $bdd;
    $req = $bdd->prepare('update image set pathName=:pathName, fileName=:fileName )');
    $req->bindParam(":pathName", $pathName, PDO::PARAM_STR);
    $req->bindParam(":fileName", $fileName, PDO::PARAM_STR);
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $result=$req->execute();
    return (int)$result;
}