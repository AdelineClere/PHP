<?php
/*
    Exercice :
    1 - Effectuer 4 liens HTML pointant sur la même pg ac le nom des fruits
    2 - Faire en sorte d'envoyer "cerises" dans l'url si 'lon clic sur le lien "cerises", 
        faire la même chose avec tout les fruits
    3 - Tenter d'afficher "cerises" sur la pg web si 'lon a cliqué dessus (si "cerises" est passé dans l'url)
    4 - Envoyer l'info à la fct déclarée "calcul()" afin d'afficher le prix pour 1 kg de "cerises"
*/


// superglobal ⚠️  $_GET aura les infos de tous les fruits contenues dans l'url !!
/*
    echo '<pre>'; print_r($_GET); echo '</pre>'; 

                    Array
                    (
                        [id_produit] => cerise
                        [prix] => 5.76
                    )
                
*/       



if($_GET)  
{
    echo '<h1>' . $_GET['id_produit'] . ' : ' . '</h1>';

    foreach($_GET as $indice => $valeur)
    {
        if($indice != 'id_produit')    // > afficher que le pdt où id_ correspond
        {
            echo $indice . ' : ' . $valeur . "<br>";
        }
    }
}

require_once("fonction.inc.php");
echo calcul("cerises", 2000);









?>
