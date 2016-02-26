<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';

class quality{

	public $idQuality=0;
	public $name='';
	public $search='';

	public function __construct($id=0){
		if ($id>0)
			$this->getLanguage($id);
	}

	public function debug(){
		print ' idQuality:' . $this->idQuality;
		print ' name' . $this->name;
	}

	public function init(){
		return
			['idQuality'=>0,
				'name'=>'',
				'search'=>''];
	}

	static function getList($bOption=null,$bNone=null,$bAll=null,$option=array()){
		global $bdd;
		$req = $bdd->prepare('select idQuality,name from quality order by name');
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
					$data[$r['idQuality']]=$r['name'];
				}
			}
			else
				$data = $res;
		}
		else
			$data=array();
		return $data;
	}

	function getLanguage($id){
		global $bdd;
		$req = $bdd->prepare('select idQuality,name from quality where idQuality=:id');
		$req->bindParam(":id",$id);
		$result=$req->execute();
		if ($result==1){
			$data = $req->fetch();
			$this->idQuality=$data['idQuality'];
			$this->name=$data['name'];
		}else{
			$data=init();
		}

		return $data;
	}

	static function exists($name,$id){
		global $bdd;
		$search=setSearchString($name);
		$req = $bdd->prepare("select count(*) from quality where search=:search and idQuality<>:id");
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$req->bindParam(":search", $search, PDO::PARAM_STR);
		$result=$req->execute();
		if ($result==true) {
			$data = $req->fetch();
			return $data[0];
		}else{
			return -1;
		}
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from quality where idQuality=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result=$req->execute();
		return (int)$result;
	}

	function insert(){
		global $bdd;
		$search=setSearchString($this->name);
		$req = $bdd->prepare('insert into quality (name,search) values (:name,:search)');
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$req->bindParam(":search", $search, PDO::PARAM_STR);
		$result=$req->execute();
		$this->idQuality = $bdd->lastInsertId();
		return (int)$result;
	}

	function update(){
		global $bdd;
		$search=setSearchString($this->name);
		$req = $bdd->prepare('update quality set name=:name, search=:search where idQuality=:id');
		$req->bindParam(":id", $this->idQuality, PDO::PARAM_INT);
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$req->bindParam(":search", $search, PDO::PARAM_STR);
		$result=$req->execute();
		return (int)$result;
	}
}

?>