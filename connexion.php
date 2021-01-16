<?php // connexion avec la base de donnée oramge
$hostname_dbprotect = "localhost"; // nom ou ip de votre serveur
$database_dbprotect = "id5369943_climatcap"; // nom de votre base de données
$username_dbprotect = "root"; // nom d'utilisateur (root par défaut) !!! ATTENTION, en utilisant root, vos visiteurs on tout les droits sur la base
$password_dbprotect = ""; // mot de passe (aucun par défaut mais il est fortement recommandé d'en mettre un ... sinon, à quoi bon la sécurité ?)
$dbprotect = mysqli_connect($hostname_dbprotect, $username_dbprotect, $password_dbprotect,$database_dbprotect) or trigger_error(mysql_error(),E_USER_ERROR); 
?> 