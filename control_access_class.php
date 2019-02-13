<?php
require_once('access_class.php');
require_once('status_class.php');
require_once('connection_class.php');

class ControlerAcces{
	public static function getAcces(){
		$bdd = new Class_connexion();
		$var = $bdd->getAcces();
		$bdd->destruct();
		unset($bdd);
		return $var;
	}
	
	public static function effaceAccesById($id){
		$bdd = new Class_connexion();
		$bool = $bdd->effaceAccesById($id);
		$bdd->destruct();
		unset($bdd);
		return $bool;
	}
	
	public static function addpeople($acces){
		$bdd = new Class_connexion();
		$bool = $bdd->addpeople($acces->getLogin(), $acces->getPassword(), $acces->getPrenom(), $acces->getStatut()->getNom(), $acces->getAge());
		$bdd->destruct();
		unset($bdd);
		return $bool;
	}
	
	public static function updateById($id, $acces){
		$bdd = new Class_connexion();
		$bool = $bdd->updateById($id, $acces->getLogin(), $acces->getPassword(), $acces->getPrenom(), $acces->getStatut()->getNom(), $acces->getAge());
		$bdd->destruct();
		unset($bdd);
		return $bool;
	}
	
	public static function getAccesById($id){
		$bdd = new Class_connexion();
		$var = $bdd->getAccesById($id);
		$bdd->destruct();
		unset($bdd);
		return $var;
	}
	
	public static function getLogin($acces){
		$bdd = new Class_connexion();
		$bool = $bdd->getLogin($acces->getLogin());
		$bdd->destruct();
		unset($bdd);
		return $bool;
	}
	
	public static function getSearch($prenom=null,$statut=null,$age_min=null,$age_max=null){
		$bdd = new Class_connexion();
		$var = $bdd->getAccesByFilters($prenom,$statut?$statut->getNom():$statut,$age_min,$age_max);
		$bdd->destruct();
		unset($bdd);
		return $var;
	}
}
?>
