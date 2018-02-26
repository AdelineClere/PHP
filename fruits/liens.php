<?php
/*
    Exercice :
    1 - Effectuer 4 liens HTML pointant sur la même pg ac le nom des fruits
    2 - Faire en sorte d'envoyer "cerises" dans l'url si l'on clic sur le lien "cerises", 
        faire la même chose avec tout les fruits
    3 - Tenter d'afficher "cerises" sur la pg web si 'lon a cliqué dessus (si "cerises" est passé dans l'url)
    4 - Envoyer l'info à la fct déclarée "calcul()" afin d'afficher le prix pour 1 kg de "cerises"
*/



require_once("fonction.inc.php");
               
if(isset($_GET['choix']))       // on récup choix dans l'url
{
    echo '<pre>'; print_r($_GET); echo '</pre>'; 
    echo'Fruit recup : ' . $_GET['choix'] . '<br>'; // 3. fruit recup = choix fait
    echo calcul($_GET['choix'], 1000) . '<br>';     // 4. on passe le fruit choisi dans la fct calcul
}



?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>liensFruits</title>

    </head>
    <body>
        <h1>Liens fruits</h1>
        <a href="?choix=cerises">Cerises</a><br>     
        <!-- ⚠️  '?choix=cerises' = envoie info dans l'url, la sur même pg. dc pas de nom de fichier avt '?' -->
        <a href="?choix=bananes">Bananes</a><br>
        <a href="?choix=pommes">Pommes</a><br>
        <a href="?choix=peches">Pêches</a><br>

    </body>
</html>