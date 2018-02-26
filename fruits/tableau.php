<?php
/*
    Exercice :
    1 - déclarer un tablo ARRAY avec tous les fruits 
    2 - Déclarer un tablo ARRAY avec les poids suivants : 100, 500, 1000, 2000, 3000, 5000, 10000
    3 - Afficher les 2 tableaux 
    4 - Sortir le fruit "cerises" et le poids 500 en passant par vos tablox pour les transmettre à la fct 'calcul' et obtenir le prix
    5 - Sortir tous les prix pour les cerises avec tous les poids (indice : boucle)
    6 - Sortir tous les prix pour tous les fruits avec tous les poids (indice : boucle imbriquée)
    7 - Faire un affichage dans un tablo HTML pour une meilleure présentation
*/


require_once("fonction.inc.php");

// Réponse 1 
$tab_fruits = array("cerises", "bananes", "pommes", "peches");

// Réponse 2
$tab_poids = array(100,500,1000,1500,2000,3000,5000,10000);

// Réponse 3
echo '<pre>'; print_r($tab_fruits); echo '</pre>';
echo '<pre>'; print_r($tab_poids); echo '</pre>';

// Réponse 4
echo calcul($tab_fruits[0], $tab_poids[1]) . '<hr>'; 

// Réponse 5
foreach($tab_poids as $indice => $valeur)
{
    echo calcul($tab_fruits[0], $valeur);
}
echo '<hr>';

// Réponse 6
foreach($tab_poids as $poids) // 1er tour, 1er poids _ 2è tour, 2e poids ...
{
    foreach($tab_fruits as $fruit) // 1er tour, parcourt ici ts les fruits jusqu'à ce quil n'y en ai plus > repart en 2è tour au dessus....
    {
    echo calcul($fruit, $poids) . '<br>';
    }
    echo '<hr>';
}

// Réponse 7
echo "<table border=1><tr>";  
    echo "<th>Poids</th>";
    foreach($tab_fruits as $indice_fruit => $fruit)
    {
        echo "<th>$fruit</th>";      // 1ère lg des fruits affichée
    }
    echo '</tr>';
    foreach($tab_poids as $poids)      
    {
        echo '<tr>';                 // <tr> déclare lg
        echo "<th>$poids g</th>";      // la boucle parcourt chaq poids et va à la lg à chaq poids pour l'afficher

        foreach($tab_fruits as $fruit)  // on va appeler les $fruit pour les passer en calcul ac les $poids
        {
            echo "<td>" . calcul($fruit, $poids) . "</td>"; // 
        }
        echo '</tr>';
    }
echo '</tr></table>';


?>