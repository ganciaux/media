<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/image.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/disk/disk.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/contentType/contentType.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/language/language.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/category/category.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/quality/quality.php';

/*
$disks=disk::getList(1,true);
$categories=category::getList(1,true);
$languages=language::getList(1,true);
$qualities=quality::getList(1,true);
$contentTypes=contentType::getList(1,true);
*/

//var_dump($disks);
//var_dump($languages);
//var_dump($contentTypes);
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
	public $actorList=array();
	public $images=array();
	public static $disks;
	public static $categories;
	public static $languages;
	public static $qualities;
	public static $contentTypes;

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
		self::$contentTypes=contentType::getList($bOption,$bNone,$bAll);
	}

	static function setDisk($idDisk,$idContent){
		global $bdd;
		$req = $bdd->prepare('update content set idDisk=:idDisk where idContent=:idContent');
		$req->bindParam(":idContent", $idContent, PDO::PARAM_INT);
		$req->bindParam(":idDisk", $idDisk, PDO::PARAM_INT);
		return (int)$req->execute();
	}

	static function setActor($idActor,$idContent){
		global $bdd;
		$req = $bdd->prepare('insert into content_actor (idContent,idActor) values (:idContent,:idActor)');
		$req->bindParam(":idContent", $idContent, PDO::PARAM_INT);
		$req->bindParam(":idActor", $idActor, PDO::PARAM_INT);
		return (int)$req->execute();
	}

	static function deleteContentActor($idActor=null,$idContent=null){
		global $bdd;
		$whereoption='';

		if (isset($idActor)){
			$whereoption.=" where idActor=:idActor";
		}
		if (isset($idContent)){
			if (strlen($whereoption)>0){
				$whereoption.=' and idContent=:$idContent';
			}else{
				$whereoption.=" where idContent=:idContent";
			}
		}

		$req = $bdd->prepare('delete from content_actor'.$whereoption);

		if (isset($idActor)){
			$req->bindParam(":idActor", $idActor, PDO::PARAM_INT);
		}
		if (isset($idContent)){
			$req->bindParam(":idContent", $idContent, PDO::PARAM_INT);
		}

		return (int)$req->execute();
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
		$data=array();
		$sql="select c.idContent,idContentType,name,search,year,idDisk,idLanguage,idQuality from content c";
		$tables="";
		$whereoption=" where c.idContent>0";
		$orderby=" order by name";

		if (isset($options['idDisk'])){
			$whereoption.=" and idDisk=:idDisk";
		}
		if (isset($options['idActor'])){
			$tables=", content_actor ca";
			$whereoption.=" and c.idContent=ca.idContent and ca.idActor=:idActor";
		}
		if (isset($options['contentName'])){
			$whereoption.=" and search like :search";
		}
		if (isset($options['contentDisk'])) {
			$whereoption .= " and idDisk=:idDisk";
		}
		if (isset($options['contentType'])){
			$whereoption.=" and idContentType=:contentType";
		}
		if (isset($options['contentQuality'])) {
			$whereoption .= " and idQuality=:contentQuality";
		}
		if (isset($options['contentLanguage'])){
			$whereoption.=" and idLanguage=:contentLanguage";
		}
		if (isset($options['contentYear'])){
			$whereoption.=" and year=:contentYear";
		}

		$req = $bdd->prepare($sql.$tables.$whereoption.$orderby);

		if (isset($options['idDisk'])){
			$req->bindParam(":idDisk", $options['idDisk'], PDO::PARAM_INT);
		}
		if (isset($options['idActor'])){
			$req->bindParam(":idActor", $options['idActor'], PDO::PARAM_INT);
		}
		if (isset($options['contentName'])){
			$search=setSearchString($options['contentName']);
			$search.='%';
			$req->bindParam(":search", $search, PDO::PARAM_STR);
		}
		if (isset($options['contentDisk'])){
			$req->bindParam(":idDisk", $options['contentDisk'], PDO::PARAM_INT);
		}
		if (isset($options['contentType'])){
			$req->bindParam(":idContentType", $options['contentType'], PDO::PARAM_INT);
		}
		if (isset($options['contentQuality'])){
			$req->bindParam(":idQuality", $options['contentQuality'], PDO::PARAM_INT);
		}
		if (isset($options['contentLanguage'])){
			$req->bindParam(":idLanguage", $options['contentLanguage'], PDO::PARAM_INT);
		}
		if (isset($options['contentYear'])){
			$req->bindParam(":year", $options['contentYear'], PDO::PARAM_INT);
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
			else {
				foreach ($res as $r) {
					$image = image::getList($r['idContent'], _TYPE_CONTENT_, true);
					if(empty($image[0])==false) {
						$r['image'] =getPublicPath().$image[0]['pathName'].'/'.$image[0]['fileName'];
					}
					else{
						$r['image']="";
					}
					array_push ($data, $r);
				}
			}
		}
		else
			$data=array();
		return $data;
	}

	function setActorList(){
		global $bdd;
		$sql="select a.idActor, a.firstName, a.lastName  from actor a, content_actor ca where a.idActor=ca.idActor and idContent=:idContent";
		$req = $bdd->prepare($sql);
		$req->bindParam(":idContent", $this->idContent, PDO::PARAM_INT);
		$result=$req->execute();

		if ($result==1){
			$this->actorList = $req->fetchAll();
		}
		else
			$this->actorList=array();
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

	static function actorExists($idActor, $idContent){
		global $bdd;
		$req = $bdd->prepare('select count(*) from content_actor where idActor=:idActor and idContent=:idContent');
		$req->execute(array(':idActor' => $idActor,':idContent' => $idContent ));
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
			$this->setActorList();
			$this->images=image::getList($id, _TYPE_CONTENT_);
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from content where idContent=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);

		$result=$req->execute();

		if ($result==true){
			$result=self::deleteContentActor(null,$id);
		}

		if ($result==true)
			$result=image::delete(null, $id,_TYPE_CONTENT_);

		return (int)$result;
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
		$this->idContent = $bdd->lastInsertId();

		if ($result==true) {
			foreach ($this->actorList as $actor){
				self::setActor($actor, $this->idContent);
			}
		}

		return (int)$result;
	}

	static function exists($name,$id){
		global $bdd;
		$search=setSearchString($name);
		$req = $bdd->prepare('select count(*) from content where search=:search and idContent<>:id');
		$req->bindParam(":search",$search, PDO::PARAM_STR);
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result=$req->execute();
		if ($result==true) {
			$data = $req->fetch();
			return $data[0];
		}else{
			return -1;
		}
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

		$result=(int)$req->execute();

		if ($result==true){
			$result=self::deleteContentActor(null,$this->idContent);
			if ($result==true){
				foreach ($this->actorList as $actor){
					self::setActor($actor, $this->idContent);
				}
			}
		}

		return (int)$result;
	}

	static function import(){
		$row = 1;
		if (($handle = fopen("C:/wamp/www/media/film.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$num = count($data);
				/*
				 	echo "<p> $num champs à la ligne $row: <br /></p>\n";
				 	for ($c=0; $c < $num; $c++) {
						echo $data[$c] . "<br />\n";
					}
					$row++;
				 */
				if ( strlen($data[0])>0){
					$pos = strpos($data[0], " ");
					$lastName = trim(strstr ($data[0]," "));
					$firstName = trim(substr ($data[0],0,$pos));
					if (strlen($firstName)>0 && strlen($lastName)>0) {
						self::insertImport($firstName, $lastName);
					}
				}
			}
			fclose($handle);
		}
	}
}
 
?>