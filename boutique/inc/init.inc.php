<?php       // init = initialisation : regrp, rapatrie tout pour les autres pg !

//-------------------- ⚠️ CONNEXION BDD
$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
));

//-------------------- ⚠️ SESSION
session_start();

//-------------------- ⚠️ CHEMIN
define('RACINE_SITE', $_SERVER['DOCUMENT_ROOT'] . "/PHP/boutique/");    
// ⚠️ Cette CONSTANTE retourne le chemin physique du dossier boutique sur le serveur
// (Lors de l'enregistrement d'img/photo, nous aurons besoin du chemin complet du dossier photo pour enregistrer le photo)
// echo '<pre>'; print_r($_SERVER); echo '</pre>';  => ARRAY du server
// 
// ⚠️  echo RACINE_SITE;   // -> donne chemin pour pointer vers photo

define("URL", 'http://localhost/PHP/boutique/'); // c'est l'URL qu'on conserve ds BDD
// ⚠️  Cette CONSTANTE servira à enregistrer l'URL d'une photo/img ds la BDD, on ne conserve jamais photo elle-même ds BDD, ce serait trop lourd pour la BDD.

//-------------------- ⚠️ VARIABLES
$content = '';      // -> pour stocker et s'en servir (faire appel à)

//-------------------- ⚠️ INCLUSIONS
require_once("fonction.inc.php");



?>