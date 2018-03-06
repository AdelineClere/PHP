<?php



for ($i = 1; $i < 10; $i++)   
{
    $affichage = '<h2>Je m\'affiche pour la : ' . $i . 'ème fois</h2>';
    $affichage1 = '<h2>Je m\'affiche pour la : ' . $i . 'ère fois</h2>';

    if ($i != 1)
    {
        echo $affichage . '<br>' ;
    }
    else
    {
        echo $affichage1 . '<br>' ;
    }
}

?>
