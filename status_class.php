<?php
require_once('connection_class.php');
class Statut{
	//private $id;
	private $nom;
	
	public function __construct(/*$id,*/$nom){
		//$this->id = (int) $id;
		$this->nom = $nom;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getNom(){
		return $this->nom;
	}
	
	public function setId($id){
		$this->id = (int) $id;
	}
	
	public function setNom($nom){
		$this->nom = $nom;
	}
}
?>
