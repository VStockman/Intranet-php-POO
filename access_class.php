<?php
require_once('status_class.php');

class Acces{
	private $login;
	private $password;
	private $prenom;
	private $statut;
	private $age;
	
	public function __construct($login,$password,$prenom,$statut,$age){
		$this->login = $login;
		$this->password = $password;
		$this->prenom = $prenom;
		$this->statut = $statut;
		$this->age = (int) $age;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getPrenom(){
		return $this->prenom;
	}
	
	public function getStatut(){
		return $this->statut;
	}
	
	public function getAge(){
		return $this->age;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	
	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}
	
	public function setStatut($statut){
		$this->statut = $statut;
	}
	
	public function setAge($age){
		$this->age = (int) $age;
	}
}
?>
