<?php

class disk{
	
	public $idDisk=0;
	public $name='';
	public $label='';
	public $size='';
	public $comment='';

	public function __construct($id=0){
		if ($id>0)
			$this->getDisk($id);
	}

	public function debug(){
		print ' idDisk:' . $this->idDisk;
		print ' name:' . $this->name;
		print ' label' . $this->label;
		print ' size:' . $this->size;
		print ' comment:' . $this->comment;
	}
	
	public function init(){
		return
			['idDisk'=>0,
			'name'=>'',
			'label'=>'',
			'size'=>'',
			'comment'=>''];
	}

	static function getList($bOption=null,$bNone=null,$bAll=null){
		global $bdd;
		$req=$bdd->prepare('select idDisk,name,label,size,comment from disk order by name');
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
					$data[$r['idDisk']]=$r['name'];
					if ($r['label']!='')
						$data[$r['idDisk']].=' - '.$r['label'];
					if ($r['size']!='')
						$data[$r['idDisk']].=' ('.$r['size'].')';
				}
			}
			else
				$data = $res;
		}
		else
			$data=array();

		return $data;
	}

	function getDisk($id){
		global $bdd;
		$req=$bdd->prepare('select idDisk,name,label,size,comment from disk where idDisk=:id');
		$req->bindParam(":id",$id);
		$result=$req->execute();
		if ($result==true){
			$data=$req->fetch();
			$this->idDisk=$data['idDisk'];
			$this->name=$data['name'];
			$this->label=$data['label'];
			$this->size=$data['size'];
			$this->comment=$data['comment'];
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
			global $bdd;
			$req = $bdd->prepare('delete from disk where idDisk=:id');
			$req->bindParam(":id", $id, PDO::PARAM_INT);
			return (int)$req->execute();
	}

	function insert(){
		global $bdd;
		$req = $bdd->prepare('insert into disk (name,label,size,comment) values (:name,:label,:size,:comment)');
		$req->bindParam(":name", $this->name, PDO::PARAM_STR);
		$req->bindParam(":label", $this->label, PDO::PARAM_STR);
		$req->bindParam(":size",$this->size, PDO::PARAM_STR);
		$req->bindParam(":comment",$this->comment, PDO::PARAM_STR);
	  	$result = $req->execute();
		$this->idDisk = $bdd->lastInsertId();
		return (int)$result;
	}

	function update(){
			global $bdd;
			$req = $bdd->prepare('update disk set name=:name, label=:label, size=:size, comment=:comment where idDisk=:id');
			$req->bindParam(":id", $this->idDisk, PDO::PARAM_INT);
			$req->bindParam(":name", $this->name, PDO::PARAM_STR);
			$req->bindParam(":label", $this->label, PDO::PARAM_STR);
			$req->bindParam(":size",$this->size, PDO::PARAM_STR);
			$req->bindParam(":comment",$this->comment, PDO::PARAM_STR);
			return (int)$req->execute();
	}
}
 
?>