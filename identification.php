<?php
session_start();
require('connection_class.php');
$bdd = new Class_connexion();
if($bdd->login()) {
	echo 'Vous êtes connectés ' . $_SESSION['prenom'] ;
	echo '</br>
    </br>';
    echo'<a href="liste.php">Aller à la liste</a>';
    echo '</br>
    </br>';
  echo '<a href="ajoute.php">Ajouter un utilisateur</a>';
  echo '</br>
    </br>';
  echo '<a href="recherche.php">Rechercher un utilisateur</a>';
  echo '</br>
    </br>';
 	echo '<a href="deconnexion.php">Se déconnecter<img src="/images/deconnexion">';
}
else {
  if(isset($_POST["password"])) {
    $liste = $bdd->getLogin($_POST["username"]);
    $bdd->destruct();
if((isset($liste) && $_POST["password"] === $liste[0]['password'])) {
  
	$_SESSION['prenom'] = $liste[0]["prenom"];
	$_SESSION['connected'] = true;
	echo 'Bienvenue ' . $_SESSION['prenom'];
	echo '</br>
  	</br>';
  	echo'<a href="liste.php">Aller à la liste</a>';
  	echo '</br>
  	</br>';
	echo '<a href="ajoute.php">Ajouter un utilisateur</a>';
  echo '</br>
    </br>';
  echo '<a href="recherche.php">Rechercher un utilisateur</a>';
	echo '</br>
  	</br>';
 	echo '<a href="deconnexion.php">Se déconnecter<img src="/images/deconnexion">';
} else {
	  header('Location: login.php?message=Erreur');
  exit();
}
}
else {
    header('Location: login.php?message=Erreur');
  exit();
}
}
?>