<?php
session_start();
$_SESSION['prenom'] = '';
$_SESSION['connected'] = false;
header('Location: login.php');
exit();
?>