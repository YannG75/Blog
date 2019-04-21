<?php

//fichier de fonctionnalités communes à plusieurs scripts

//paramétrage de la langue de traduction pour PHP
setlocale(LC_ALL, "fr_FR");

//connexion à la base de données
function dbConnect() {
	try{
	return $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
	die( 'Erreur : ' . $exception->getMessage() );
}
}

$db = dbConnect();
//ouverture de session pour connexions utilisateurs et admins
session_start();

if (isset($_GET['logout']) && isset($_SESSION['user'])) {
    //la fonction unset() détruit une variable ou une partie de tableau. ici on détruit la session user
    unset($_SESSION["user"]);
}

?>
