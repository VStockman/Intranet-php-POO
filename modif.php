<?php
session_start();
require('connection_class.php');
$bdd = new Class_connexion();
if($bdd->login()) {
	if(isset($_GET["id"])) {
    $liste = $bdd->getAccesById($_GET["id"]);
    $liste = $liste[0];
    $status = $bdd->getStatus();

if(isset($_POST['prenom'])) {
    $update = $bdd->updateById($_GET["id"], $_POST['login'], $_POST['password'], $_POST['prenom'], $_POST['statut'], $_POST['age']);
    if($update != 1) {
		echo 'Modification echoué';
		echo '</br>';
		echo '</br>';
	}
	else {
		echo 'Modification effectuée';
		echo '</br>';
		echo '</br>';
	}
}

echo 'Bienvenue ' . $_SESSION['prenom'];
echo '</br>';
echo '</br>';
echo '<html>
 <head>

<form method="POST" action="modif.php?id=' . $_GET["id"].'">

Prenom : <input type="text" name="prenom" required value="'. $liste->getPrenom(). '" autofocus/>
</br>
</br>
Login : <input type="text" name="login" value="'. $liste->getLogin(). '" required />
</br>
</br>
Mot de passe : <input type="password" name="password" value="'. $liste->getPassword(). '"required />
</br>
</br>
Statut : <SELECT name="statut" size="1">';
foreach($status as $key => $value){
echo '<option value="'. $value->getNom().'">'. $value->getNom().'</option>';
}
echo '
</SELECT>';
echo '
</br>
</br>
Age : <input type="number" name="age" value="'. $liste->getAge(). '"required />
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
 } else {
 	header('Location: liste.php');
 	exit();
 }
 } else {
 	header('Location: login.php?message=Erreur');
  exit();
 }
?>
