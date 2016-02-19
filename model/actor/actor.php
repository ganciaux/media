<?php

class actor{
	
	public $idActor=0;
	public $lastName='';
	public $firstName='';

	public function __construct($id=0){
		if ($id>0)
			$this->getActor($id);
	}

	public function debug(){
		print ' idActor:' . $this->idActor;
		print ' firstName' . $this->firstName;
		print ' lastName:' . $this->lastName;
	}
	
	public function init(){
		return
			['idActor'=>0,
			'firstName'=>'',
			'lastName'=>''];
	}
	
	static function getList($bOption=null,$bNone=null,$bAll=null){
		global $bdd;
		$req = $bdd->prepare('select idActor,firstName,lastName from actor order by firstName');
		$result=$req->execute();
		if ($result==1){
			$res = $req->fetchAll();
			if (isset($bAll) && $bAll==true){
				$data['-1']='Tous';
			}
			if (isset($bOption) && $bOption==1){
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

	function getActor($id){
		global $bdd;
		$req = $bdd->prepare('select idActor,firstName,lastName from actor where idActor=:id');
		$req->bindParam(":id",$id);
		$result=$req->execute();
		if ($result==1){
			$data = $req->fetch();
			$this->idActor=$data['idActor'];
			$this->firstName=$data['firstName'];
			$this->lastName=$data['lastName'];
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from actor where idActor=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result=$req->execute();
		return (int)$result;
	}

	function insert(){
		global $bdd;
		$req = $bdd->prepare('insert into actor (firstName,lastName) values (:firstname,:lastname)');
		$req->bindParam(":firstname", $this->firstName, PDO::PARAM_STR);
		$req->bindParam(":lastname", $this->lastName, PDO::PARAM_STR);
		$result=$req->execute();
		$this->idActor = $bdd->lastInsertId();
		return (int)$result;
	}

	static function insertImport($firstName,$lastName){
		global $bdd;
		$req = $bdd->prepare('insert into actor (firstName,lastName) values (:firstname,:lastname)');
		$req->bindParam(":firstname", $firstName, PDO::PARAM_STR);
		$req->bindParam(":lastname", $lastName, PDO::PARAM_STR);
		$result=$req->execute();
		return (int)$result;
	}

	function update(){
		global $bdd;
		$req = $bdd->prepare('update actor set firstName=:firstname, lastName=:lastname where idActor=:id');
		$req->bindParam(":id", $this->idActor, PDO::PARAM_INT);
		$req->bindParam(":firstname", $this->firstName, PDO::PARAM_STR);
		$req->bindParam(":lastname", $this->lastName, PDO::PARAM_STR);
		$result=$req->execute();
		return (int)$result;
	}

	static function import(){
		$row = 1;
		if (($handle = fopen("C:/wamp/www/media/actor.csv", "r")) !== FALSE) {
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
					$lastName = strstr ($data[0]," ");
					$firstName = substr ($data[0],0,$pos);
					self::insertImport($firstName,$lastName);
				}
			}
			fclose($handle);
		}
	}
}
 
?>