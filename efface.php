<?php
session_start();
require_once('status_class.php');
require_once('control_access_class.php');
require_once('control_status_class.php');
$bdd = new Class_connexion();
if($bdd->login()) {
try{
        
	$bdd = new Class_connexion();
	$delete = $bdd->effaceAccesById($_GET["id"]);
	if(is_null($delete)){
		header('Location: liste.php?result=ko');
	}
	else {
		header('Location: liste.php?result=ok');
	}
  	
    } catch(exception $e){
        header('Location: liste.php?result=ko');
  	exit();
    }
} else {
	header('Location: login.php?message=Erreur');
  exit();
}
?>