<?php
session_start();
if($_SESSION['connected'] == true) {
if(isset($_GET["result"])) {
	if($_GET["result"] === "ok"){
		echo 'Suppression réussie';
		echo '</br>';
		echo '</br>';
	} else {
		echo 'Suppression échouée';
		echo '</br>';
		echo '</br>';
	}
}
require('connection_class.php');
    $bdd = new Class_connexion();
    $liste = $bdd->getAcces();
    $bdd->destruct();

echo 'Bienvenue ' . $_SESSION['prenom'];
echo '</br>';
echo '</br>';
echo'Ajouter : <a href="ajoute.php"><img src="/images/ajoute"></a>';
echo '</br>';
echo '</br>';
echo '<table border=1>';
echo '<tr><td> Prenom </td><td> Login </td><td>Statut</td><td>Age</td><td>Modifier</td><td>Supprimer</td></tr>';  		
foreach($liste as $key => $value){
	echo '<tr>';
	echo '<td>' . $value['acces']->getPrenom().'</td>';	
 	echo '<td>'. $value['acces']->getLogin() .'</td>';
 	echo '<td>'. $value['acces']->getStatut()->getNom().'</td>';
	echo '<td>'. $value['acces']->getAge() .'</td>';
 	echo '<td><center><a href="modif.php?id=' .($value['id']) . '"><img src="/images/modif"></center>';
 	echo '</td>';
 	echo '<td><center><a href="efface.php?id=' .($value['id']) . '"><img src="/images/croix"></center>';
 	echo '</td>';
  	}
  	echo '</tr></table>';
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
?>