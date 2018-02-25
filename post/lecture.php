<?php
$nom_fichier = 'liste.txt';
$fichier = file($nom_fichier); // ⚠️ la fct file() fait tout le trv : 
// elle retourne chaque ligne d'un fichier à des indices différents d'un tablo ARRAY

echo '<pre>'; print_r($fichier); echo '</pre>';
// Afficher les données du tableau ARRAY représenté par $fichier à l'aide d'une boucle

foreach ($fichier as $informations)    
{
    echo $informations . '<br>'; 
} 