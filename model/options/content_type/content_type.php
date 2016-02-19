<?php

class content_type{
	
	public $idContentType=0;
	public $name='';

	public function __construct($id=0){
		if ($id>0)
			$this->getLanguage($id);
	}

	public function debug(){
		print ' idContentType:' . $this->idContentType;
		print ' name' . $this->name;
	}
	
	public function init(){
		return
			['idContentType'=>0,
			'name'=>''];
	}
	
	static function getList($bOption=null,$bNone=null,$bAll=null){
		global $bdd;
		$req = $bdd->prepare('select idContentType,name from content_type order by name');
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
					$data[$r['idContentType']]=$r['name'];
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
		$req = $bdd->prepare('select idContentType,name from content_type where idContentType=:id');
		$req->bindParam(":id",$id);
		$result=$req->execute();
		if ($result==1){
			$data = $req->fetch();
			$this->idContentType=$data['idContentType'];
			$this->name=$data['name'];
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from idContentType where idContentType=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result=$req->execute();
		return (int)$result;
	}

	function insert(){
		global $bdd;
		$req = $bdd->prepare('insert into content_type (name) values (:name)');
		$req->bindParam(":name", $this->firstName, PDO::PARAM_STR);
		$result=$req->execute();
		$this->idContentType = $bdd->lastInsertId();
		return (int)$result;
	}

	function update(){
		global $bdd;
		$req = $bdd->prepare('update content_type set name=:name where idContentType=:id');
		$req->bindParam(":id", $this->idContentType, PDO::PARAM_INT);
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$result=$req->execute();
		return (int)$result;
	}
}
 
?>