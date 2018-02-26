<?php
echo '<h2>01. PDO : Connexion BDD </h2>';
/*************************************************/
$pdo = new PDO('mysql:host=localhost; dbname=entreprise', 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));


?>