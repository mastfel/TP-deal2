<?php

$host = 'mysql:host=localhost;dbname=deal'; // hôte + nom de la bdd
$login = 'root'; // login
$password = ''; // mdp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,   // gestion des erreurs
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // On force l'utf8 sur les données provenants de la bdd
);

// Création de l'objet :

$pdo = new PDO($host, $login, $password, $options);
/*
echo '<pre>';
var_dump($pdo); // Si j'ai bien l'objet PDO, alors la connexion à ma BDD est réussie !!! 
echo '</pre>';  // $pdo représente ma bdd entreprise, qui est maintenant en attente de recevoir des requetes ! 

*/

session_start();








require_once('fonctions_inc.php');





?>