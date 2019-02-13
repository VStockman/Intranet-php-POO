<?php

session_start();
require('connection_class.php');
require('access_class.php');
$bdd = new Class_connexion();
if($bdd->login()) {
if((isset($_POST["prenom"]) && trim($_POST["prenom"]) != '') || (isset($_POST["statut"]) && trim($_POST["statut"]) != '') || (isset($_POST["agemin"]) && trim($_POST["agemin"]) != '') || (isset($_POST["agemax"]) && trim($_POST["agemax"]) != '')) {
$search = $bdd->getSearch($_POST["prenom"], $_POST["statut"], $_POST["agemin"],$_POST["agemax"]);
echo 'Résultat de la recherche : ';
echo '</br>
  	</br>';
echo '<table border=1>';
echo '<tr><td> Prenom </td><td> Login </td><td>Statut</td><td>Age</td></tr>';
foreach($search as $key => $value){
	echo '<tr>';
	echo '<td>' . $value->getPrenom().'</td>';	
 	echo '<td>'. $value->getLogin() .'</td>';
 	echo '<td>'. $value->getStatut()->getNom().'</td>';
	echo '<td>'. $value->getAge() .'</td>';
} 	
  	echo '</tr></table>';
  	echo '</br>
  	</br>';  	
} else {
    $status = $bdd->getStatus();
echo 'Bienvenue ' . $_SESSION['prenom'];
echo '</br>';
echo '</br>';
echo '</br>';
echo'Rechercher un utilisateur : ';
echo '</br>
  	</br>';
echo '<html>
 <head>

<form method="post" action="recherche.php">
</br>
Prenom : <input type="text" name="prenom" autofocus />
</br>
</br>
Statut : <SELECT name="statut" size="1">
<option value=""</option>';
foreach($status as $key => $value){
echo '<option value="'. $value->getNom().'">'. $value->getNom().'</option>';
}
echo '
</SELECT>
</br>
</br>
Age mini : <input type="number" name="agemin" />
</br>
</br>
Age maxi : <input type="number" name="agemax" />
</br>
</br>
</br>
<input type="submit">

</form>
 </head>
 </html>';
 }
} else {
 	header('Location: login.php?message=Erreur');
  exit();
 }
echo'</br>
<form method="post" action="liste.php">
<input type="submit" value="Retour a la liste">
</form>';
echo '</br>';
echo '<a href="deconnexion.php">Se déconnecter<img src="/images/deconnexion">';
?>