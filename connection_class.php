<?php
require_once('access_class.php');
require_once('status_class.php');

class Class_connexion{
	private $sgbd = 'mysql';
	private $host = 'localhost';
	private $dbname = 'access';
	private $user = 'root';
	private $pass = '';
	
	public function __construct(){
		try{
			$this->db = new PDO($this->sgbd.':host='.$this->host.';dbname='.$this->dbname,'root','');
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);/* désactive les requêtes émulées - permet de typer les valeurs retournées */
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}
	
	public function destruct(){
		$this->db = null;
	}
	
	public function Login() {
		if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
			return true;
		} else {
	return false;
}
	}

	public function getAcces(){
		try{
			$query = $this->db->prepare('SELECT id, prenom, login,password, statut, age FROM ACCES');
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$liste = array();
			foreach($result as $key => $value){
				array_push($liste, array('id'=>$value['id'], 'acces'=>$acces = new Acces($value['login'],$value['password'],$value['prenom'],$statut = new Statut($value['statut']),$value['age'])));
			}
			return $liste;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}
	
	public function effaceAccesById($id){
		try{
			$query = $this->db->prepare('DELETE FROM ACCES WHERE id='.$id);
			$query->execute();
			$bool = $query->fetchAll(PDO::FETCH_ASSOC);
			return $bool;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}
public function updateById($id,$login, $password, $prenom, $statut, $age){
		try{
			$query = $this->db->prepare('UPDATE ACCES SET `prenom`= "' . $prenom . '", `login` = "' . $login . '", password="' . $password . '", statut= "'. $statut. '", age =' . $age . ' WHERE id='. $id .' ;');
			$bool = $query->execute();
			return $bool;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}

public function addpeople($prenom, $login, $password, $statut, $age){
		try{
			$query = $this->db->prepare('INSERT INTO ACCES (`prenom`, `login`, `password`,`statut`, `age`) VALUES
("' . $prenom . '","' . $login . '","' . $password . '","' . $statut .'",' . $age .');'
);
			$bool = $query->execute();
			return $bool;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}

	public function getAccesById($id){
		try{
			$query = $this->db->prepare('SELECT id, prenom, login,password, statut, age FROM ACCES WHERE `id`='.$id);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$liste = array();
			foreach($result as $key => $value){
				array_push($liste, $acces = new Acces($value['login'],$value['password'],$value['prenom'],$statut = new Statut($value['statut']),$value['age']));
			}
			return $liste;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}

	public function getStatus(){
		try{
			$query = $this->db->prepare('SELECT * FROM STATUT');
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$liste = array();
			foreach($result as $key => $value){
				array_push($liste, $statut = new Statut($value['nom']));
			}
			return $liste;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}
public function getLogin($login){
		try{
			$query = $this->db->prepare('SELECT prenom, password FROM ACCES WHERE `login`="'.$login .'"');
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}

	}

public function getSearch($prenom = null, $statut = null, $agemin = null, $agemax = null) {
		try{
			$query = 'SELECT prenom, login, statut, age FROM ACCES WHERE';
			if(trim($prenom) != '') { 
				$query = $query . ' prenom LIKE"%' . $prenom . '%"';
			}
			else if (trim($statut) != '') {
				if($query != 'SELECT prenom, login, statut, age FROM ACCES WHERE') {
					$query = $query . ' AND';
				}
				$query = $query . ' statut LIKE"' . $statut . '"';
			}
			else if (trim($agemin) != '') {
				if($query != 'SELECT prenom, login, statut, age FROM ACCES WHERE') {
					$query = $query . ' AND';
				}
				$query = $query . ' age >= "' . $agemin . '"';
			}
			else if (trim($agemax) != '') {
				if($query != 'SELECT prenom, login, statut, age FROM ACCES WHERE') {
					$query = $query . ' AND';
				}
				$query = $query . ' age <= "' . $agemax . '"';
			}
			$query = $query . ';';
			$query = $this->db->prepare($query);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$liste = array();
			foreach($result as $key => $value){
				array_push($liste, $acces = new Acces($value['login'],null ,$value['prenom'],$statut = new Statut($value['statut']),$value['age']));
			}
			return $liste;
		} catch(exception $e) {
			$this->destruct();
			return $e->getMessage();
		}
	}
}

?>
