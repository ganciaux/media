<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/image/image.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/media/model/content/content.php';

class actor{
	
	public $idActor=0;
	public $lastName='';
	public $firstName='';
    public $search='';
	public $images=array();

	public function __construct($id=0){
		if ($id>0)
			$this->getActor($id);
	}

	public function debug(){
		print ' idActor:' . $this->idActor;
		print ' firstName' . $this->firstName;
		print ' lastName:' . $this->lastName;
        print ' search:' . $this->search;
	}
	
	public function init(){
		return
			['idActor'=>0,
			'firstName'=>'',
			'lastName'=>'',
            'search'=>''];
	}

    static function exists($firstname,$lastname,$id){
        global $bdd;
        $search=setSearchString($firstname.$lastname);
        $req = $bdd->prepare('select count(*) from actor where search=:search and idActor<>:id');
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

	static function getList($bOption=null,$bNone=null,$bAll=null,$options=null){
		global $bdd;
		$data=array();
        $sql="select idActor,firstName,lastName from actor";
        $whereoption=" where idActor>0";
        $search="";
        $orderby=" order by firstName";

        if (isset($options['firstName'])){
            $search.=$options['firstName'];
        }
        if (isset($options['lastName'])){
            $search.=$options['lastName'];
        }
        if (isset($options['search'])){
            $search.=$options['search'];
        }
        $search=setSearchString($search);
        $search.='%';

        $whereoption.=" and search like :search";
        $req = $bdd->prepare($sql.$whereoption.$orderby);
        $req->bindParam(":search", $search, PDO::PARAM_STR);
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
				}
			}
			else {
				foreach ($res as $r) {
					$image = image::getList($r['idActor'], _TYPE_ACTOR_, true);
					if (isset($image)){
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
			$this->images=image::getList($id, _TYPE_ACTOR_);
		}else{
			$data=init();
		}

		return $data;
	}

	static function delete($id){
		global $bdd;
		$req = $bdd->prepare('delete from actor where idActor=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $req->execute();
		if ($result==true) {
			print 'content delete';
			$result = content::deleteContentActor($id);
		}
		if ($result==true)
			$result=image::delete(null, $id,_TYPE_ACTOR_);

		return (int)$result;
	}

	function insert(){
		global $bdd;
		$search=setSearchString($this->firstName.$this->lastName);
		$req = $bdd->prepare('insert into actor (firstName,lastName,search) values (:firstname,:lastname,:search)');
		$req->bindParam(":firstname", $this->firstName, PDO::PARAM_STR);
		$req->bindParam(":lastname", $this->lastName, PDO::PARAM_STR);
        $req->bindParam(":search", $search, PDO::PARAM_STR);
		$result=$req->execute();
		$this->idActor = $bdd->lastInsertId();
		return (int)$result;
	}

	static function insertImport($firstName,$lastName){
		global $bdd;
        $search=setSearchString($firstName.$lastName);
		$req = $bdd->prepare('insert into actor (firstName,lastName,search) values (:firstname,:lastname,:search)');
		$req->bindParam(":firstname", $firstName, PDO::PARAM_STR);
		$req->bindParam(":lastname", $lastName, PDO::PARAM_STR);
        $req->bindParam(":search", $search, PDO::PARAM_STR);
		$result=$req->execute();
		return (int)$result;
	}

	function update(){
		global $bdd;
        $search=setSearchString($this->firstName.$this->lastName);
		$req = $bdd->prepare('update actor set firstName=:firstname, lastName=:lastname, search=:search where idActor=:id');
		$req->bindParam(":id", $this->idActor, PDO::PARAM_INT);
		$req->bindParam(":firstname", $this->firstName, PDO::PARAM_STR);
		$req->bindParam(":lastname", $this->lastName, PDO::PARAM_STR);
        $req->bindParam(":search", $search, PDO::PARAM_STR);
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

	static function isUsed($id){
		global $bdd;
		$req = $bdd->prepare('select count(*) from content_actor where idActor=:id');
		$req->bindParam(":id", $id, PDO::PARAM_INT);
		$result=$req->execute();
		if ($result==true) {
			$data = $req->fetch();
			return $data[0];
		}else{
			return -1;
		}
	}
}
 
?>