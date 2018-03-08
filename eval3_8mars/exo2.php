<?php

$nombre = '';


function conversion($nombre, $taux = 1.085965)  // argument initialisé par défaut à 1.085965
{
    if(!is_int($nombre))
    {
        return $nombre . ' n\'est pas un nombre. Vauillez en choisir un.';
    }
    else
    {
        echo $nombre . ' euros = ' . $nombre*$taux . ' dollars américains' ;     // calcul 
    }

}

echo conversion(10) . "<br>"; 

 



?>