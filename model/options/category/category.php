<?php

class category{
	
	public $idCategory=0;
	public $name='';

	public function __construct($id=0){
		if ($id>0)
			$this->getLanguage($id);
	}

	public function debug(){
		print ' idCategory:' . $this->idCategory;
		print ' name' . $this->name;
	}
	
	public function init(){
		return
			['idCategory'=>0,
			'name'=>''];
	}
	
	static function getList($bOption=null,$bNone=null,$bAll=null){
		global $bdd;
		$req = $bdd->prepare('select idCategory,name from category order by name');
		$result=$req->execute();
		if ($result==1){
			$res = $req->fetchAll();
			if (isset($bOption) && $bOption==1){
				if (isset($bAll) && $bAll==true){
					$data['-1']='Toutes';
				}
				if (isset($bNone) && $bNone==true){
					$data['0']='Aucune';
				}
				foreach($res as $r){
					$data[$r['idCategory']]=$r['name'];
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
		$req = $bdd->prepare('select idCategory,name from category where idCategory=:id');
		$req->bindParam(":id",$id);
		$result=$req->execute();
		if ($result==1){
			$data = $req->fetch();
			$this->idCategory=$data['idCategory'];
			$this->name=$data['name'];
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from idCategory where idCategory=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result=$req->execute();
		return (int)$result;
	}

	function insert(){
		global $bdd;
		$req = $bdd->prepare('insert into category (name) values (:name)');
		$req->bindParam(":name", $this->firstName, PDO::PARAM_STR);
		$result=$req->execute();
		$this->idCategory = $bdd->lastInsertId();
		return (int)$result;
	}

	function update(){
		global $bdd;
		$req = $bdd->prepare('update category set name=:name where idCategory=:id');
		$req->bindParam(":id", $this->idCategory, PDO::PARAM_INT);
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$result=$req->execute();
		return (int)$result;
	}
}
 
?>