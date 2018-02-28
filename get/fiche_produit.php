<?php
echo '<pre>'; print_r($_GET); echo '</pre>'; // superglobal ⚠️  $_GET aura ttes les infos contenues dans l'url !!

        /* -> Array
                (
                    [id_produit] => 1
                    [article] => jean
                    [couleur] => bleu
                    [prix] => 90
                )   */

// Afficher les données pdts en affichage conventionnel

if($_GET)  // = si on a info dans url on peut...
{
    echo '<h1>Voici le détail du produit n° ' . $_GET['id_produit'] . '</h1>';

    foreach($_GET as $indice => $valeur)
    {
        if($indice != 'id_produit')    // = if indice différent de id_produit > afficher ts les autres
        {
            echo $indice . ' : ' . $valeur . "<br>";
        }
    }
}

// faire en sorte de ne pas avoir l'id_pdt à l'affichage

if($_GET)  // = si on a info dans url on peut...
{
    echo '<h1>Voici le détail du produit n° ' . $_GET['id_produit'] . '</h1>';

    foreach($_GET as $indice => $valeur)
    {

            echo $indice . ' : ' . $valeur . "<br>";

    }
}




// 
if($_GET)  // = si on a info dans url on peut...
{
    echo '<h1>Voici le détail du produit n° ' . $_GET['id_produit'] . '</h1>';

    foreach($_GET as $indice => $valeur)
    {
        if($indice != 'id_produit')    // = if indice différent de id_produit > afficher ts les autres
        {
            echo $valeur . "<br>";
        }
    }
}



















?>  