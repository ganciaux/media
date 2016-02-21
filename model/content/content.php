<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/content_type/content_type.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/language/language.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/category/category.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/options/quality/quality.php';

/*
$disks=disk::getList(1,true);
$categories=category::getList(1,true);
$languages=language::getList(1,true);
$qualities=quality::getList(1,true);
$content_types=content_type::getList(1,true);
*/

//var_dump($disks);
//var_dump($languages);
//var_dump($content_types);
//var_dump($qualities);
//var_dump($categories);

class content{
 
	public $idContent=0;
	public $idContentType=0;
	public $name='';
	public $search='';
	public $year='';
	public $idDisk=0;
	public $idLanguage=0;
	public $idQuality=0;
	public static $disks;
	public static $categories;
	public static $languages;
	public static $qualities;
	public static $content_types;

	public function __construct($id=0)	{
		if ($id>0)
			$this->getContent($id);
	}

	public function debug()	{
		print ' idContent:' . $this->idContent;
		print ' idContentType:' . $this->idContentType;
		print ' name' . $this->name;
		print ' search:' . $this->search;
		print ' year:' . $this->year;
		print ' idDisk:' . $this->idDisk;
		print ' idLanguage:' . $this->idLanguage;
		print ' idQuality:' . $this->idQuality;
	}

	static function setList($bOption=null,$bNone=null,$bAll=null){
		self::$disks=disk::getList($bOption,$bNone,$bAll);
		self::$categories=category::getList($bOption,$bNone,$bAll);
		self::$languages=language::getList($bOption,$bNone,$bAll);
		self::$qualities=quality::getList($bOption,$bNone,$bAll);
		self::$content_types=content_type::getList($bOption,$bNone,$bAll);
	}

	public function init(){
		return
			['idContent' => 0,
			'idContentType' => 0,
			'name' => '',
			'search' => '',
			'year' => 0,
			'idDisk' => 0,
			'idLanguage' => 0,
			'idQuality' => 0];
	}

	static function getList($bOption=null,$bNone=null,$bAll=null,$options=array()){
		global $bdd;
		$sql="select idContent,idContentType,name,search,year,idDisk,idLanguage,idQuality from content";
		$whereoption=" where idContent>0";
		$orderby=" order by name";

		if (isset($options['contentDisk'])){
			$whereoption.=" and idDisk=:contentDisk";
		}
                if (isset($options['contentLanguage'])){
			$whereoption.=" and idLanguage=:contentLanguage";
		}
		if (isset($options['contentType'])){
			$whereoption.=" and idContentType=:contentType";
		}
		if (isset($options['contentName'])){
			$whereoption.=" and search like:contentName";
		}
		if (isset($options['contentYear'])){
			$whereoption.=" and year=:contentYear";
		}
		if (isset($options['contentQuality'])){
			$whereoption.=" and idQuality=:contentQuality";
		}

		$req = $bdd->prepare($sql.$whereoption.$orderby);

		if (isset($options['contentDisk'])){
			$req->bindParam(":idDisk", $options['contentDisk'], PDO::PARAM_INT);
		}
		if (isset($options['contentType'])){
			$req->bindParam(":idContentType", $options['contentType'], PDO::PARAM_INT);
		}
		if (isset($options['contentName'])){
			$req->bindParam(":search", $options['contentName'], PDO::PARAM_STR);
		}
		if (isset($options['contentYear'])){
			$req->bindParam(":idContent", $options['contentYear'], PDO::PARAM_INT);
		}
		if (isset($options['contentLanguage'])){
			$req->bindParam(":idContent", $options['contentLanguage'], PDO::PARAM_INT);
		}
		if (isset($options['contentQuality'])){
			$req->bindParam(":idContent", $options['contentQuality'], PDO::PARAM_INT);
		}

		$result=$req->execute();
		if ($result==1){
			$res = $req->fetchAll();
			if (isset($bOption) && $bOption==1){
				if (isset($bAll) && $bAll==true){
					$data['-1']='Tous';
				}
				if (isset($bNone) && $bNone==true){
					$data['0']='Aucun';
				}
				foreach($res as $r){
					$data[$r['idContent']]=$r['name'];
					if ($r['year']!=0)
						$data[$r['idContent']].=' - '.$r['year'];
				}
			}
			else
				$data = $res;
		}
		else
			$data=array();
		return $data;
	}

        static function diskExists($idDisk, $idContent){
            global $bdd;
            $req = $bdd->prepare('select count(*) from content where idDisk=:idDisk and idContent=:idContent');
            $req->execute(array(':idDisk' => $idDisk,':idContent' => $idContent ));
            $result=$req->execute();

            if ($result==1){
		$res=$req->fetch();
                $result=$res[0];
            }else
                $result=-1;
            
            return $result;
        }
        
	function getContent($id){
		global $bdd;
		$req = $bdd->prepare('select idContent,idContentType,name,search,year,idDisk,idLanguage,idQuality from content where idContent=:id');
		$req->bindParam(":id",$id);
		$result=$req->execute();
		if ($result==true) {
			$data = $req->fetch();
			$this->idContent = $data['idContent'];
			$this->idContentType = $data['idContentType'];
			$this->name = $data['name'];
			$this->search = $data['search'];
			$this->year = $data['year'];
			$this->idDisk = $data['idDisk'];
			$this->idQuality = $data['idQuality'];
			$this->idLanguage = $data['idLanguage'];
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from content where idContent=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		return (int)$req->execute();
	}

	function insert(){
		global $bdd;
		$search=setSearchString($this->name);
		$req = $bdd->prepare('insert into content (idContentType,name,search,year,idDisk,idLanguage,idQuality) values (:idContentType,:name,:search,:year,:idDisk,:idLanguage,:idQuality)');
		$req->bindParam(":idContentType", $this->idContentType, PDO::PARAM_INT);
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$req->bindParam(":search", $search, PDO::PARAM_STR);
		$req->bindParam(":year", $this->year, PDO::PARAM_INT);
		$req->bindParam(":idDisk", $this->idDisk, PDO::PARAM_INT);
		$req->bindParam(":idLanguage", $this->idLanguage, PDO::PARAM_INT);
		$req->bindParam(":idQuality", $this->idQuality, PDO::PARAM_INT);
		$result=$req->execute();
		print $req->debugDumpParams();
		$this->idContent = $bdd->lastInsertId();
		return (int)$result;
	}

	function update(){
		global $bdd;
		$search=setSearchString($this->name);
		$req = $bdd->prepare('update content set idContentType=:idContentType,name=:name,search=:search,year=:year,idDisk=:idDisk,idLanguage=:idLanguage,idQuality=:idQuality where idContent=:idContent');
		$req->bindParam(":idContent", $this->idContent, PDO::PARAM_INT);
		$req->bindParam(":idContentType", $this->idContentType, PDO::PARAM_INT);
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$req->bindParam(":search",$search, PDO::PARAM_STR);
		$req->bindParam(":year", $this->year, PDO::PARAM_INT);
		$req->bindParam(":idDisk", $this->idDisk, PDO::PARAM_INT);
		$req->bindParam(":idLanguage", $this->idLanguage, PDO::PARAM_INT);
		$req->bindParam(":idQuality", $this->idQuality, PDO::PARAM_INT);
		return (int)$req->execute();
	}
}
 
?>