<?php
session_start();
require_once('status_class.php');
require_once('control_access_class.php');
require_once('control_status_class.php');
$bdd = new Class_connexion();
if($bdd->login()) {
if(isset($_POST['prenom'])) {
    $add = $bdd->addpeople($_POST['prenom'], $_POST['login'], $_POST['password'], $_POST['statut'], $_POST['age']);
    $bdd->destruct();
    if($add != 1){
		echo 'Ajout echoué';
		echo '</br>';
		echo '</br>';
	}
	else {
		echo 'Ajout réussi';
		echo '</br>';
		echo '</br>';
	}
	echo '<form method="post" action="liste.php">
<input type="submit" value="Retour a la liste">
</form>';
 } else {
 $status = $bdd->getStatus();
 $bdd->destruct();
echo 'Bienvenue ' . $_SESSION['prenom'];
 echo '</br>';
 echo '</br>';
echo '<html>
 <head>

<form method="post" action="ajoute.php">

Prenom : <input type="text" name="prenom" required autofocus />
</br>
</br>
Login : <input type="text" name="login" required />
</br>
</br>
Mot de passe : <input type="password" name="password" required />
</br>
</br>
Statut : <SELECT name="statut" size="1">';
foreach($status as $key => $value){
echo '<option value="'. $value->getNom().'">'. $value->getNom().'</option>';
}
echo '
</SELECT>
</br>
</br>
Age : <input type="number" name="age" required />
</br>
</br>
<input type="submit">
</br>
</br>
</form>
<form method="post" action="liste.php">
<input type="submit" value="Retour a la liste">
</form>
 </head>
 </html>';
 echo '</br>
  	</br>';
 	echo '<a href="deconnexion.php">Se déconnecter<img src="/images/deconnexion">';
 }
 } else {
 	header('Location: login.php?message=Erreur');
  exit();
 }
?>