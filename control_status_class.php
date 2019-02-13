<?php
require_once('status_class.php');
require_once('connection_class.php');

class ControlerStatut{
	
	public static function selectStatut(){
		$bdd = new Class_connexion();
		$var = $bdd->selectStatut();
		$bdd->destruct();
		unset($bdd);
		return $var;
	}
}
?>
