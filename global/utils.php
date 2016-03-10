<?php

define("_TYPE_DISK_", 1);
define("_TYPE_ACTOR_", 2);
define("_TYPE_CONTENT_", 3);
define("_TYPE_BUNDLE_", 4);

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
    $path=$_SERVER['DOCUMENT_ROOT'].'/media/public';
    return str_replace ( "//" ,"/",$path);
}

function getPublicPath(){
    return '/media/public';
}

function uploadFile($files,$i,$id,$type,$object,$bresize){
    $result=array('result'=>1,'status'=>1);
    $separator='.';

    if (is_uploaded_file($files['tmp_name'][$i])!=true) {
        $result['result'] = 0;
        $result['error'] = "Impossible de télécharger le fichier : " . $files['tmp_name'][$i];
    }else{
        $file_name = $files['name'][$i];
        $file_size = $files['size'][$i];
        $file_tmp = $files['tmp_name'][$i];
        $file_type = $files['type'][$i];
        $file_error = $files['error'][$i];
        $file_details=explode($separator,$file_name);
        $file_ext=strtolower(end($file_details));
        $expensions=array("jpeg","jpg","png");

        $path=getFilePath($id,$object);
        $absolutepath=getServerPublicPath().$path;
        $filename=$id.'_'.uniqid() .'.'.$file_ext;

        if(in_array($file_ext,$expensions)=== false){
            $result['result']=0;
            $result['status']=422;
            $result['error']="Extension non permise, choisir un fichier JPEG, JPG ou PNG";
        }

        $result['result']=(int)move_uploaded_file($file_tmp,$absolutepath.'/'.$filename);

        if (isset($bresize) && $bresize==true && $result['result']==1) {
            $result['result']=resizeFile($absolutepath, $filename, 0.5);
        }

        if ($result['result'] == 1) {
            $result['idImage'] = image::insert($id, $type, $path, $filename);
        }
    }

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

    return (int)$result;
}

function getObjectCount($table,$options=null){
    global $bdd;
    $sql='select count(*) from '.$table;
    if (isset($options)){
        $sql.=$options;
    }
    $req = $bdd->prepare($sql);
    $result=$req->execute();
    if ($result==true) {
        $data = $req->fetch();
        return $data[0];
    }else{
        return -1;
    }
}