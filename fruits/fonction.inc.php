<?php


function calcul ($fruit, $poids)
{
    switch($fruit)
    {
        case 'cerises' : $prix_kg = 5.76; break;
        case 'bananes' : $prix_kg = 1.09; break;
        case 'pommes' : $prix_kg = 1.61; break;
        case 'peches' : $prix_kg = 2.64; break;
        default: return "fruit inexistant"; break;
    }
    $resultat = round(($poids*$prix_kg/1000),2);  // prix au gramme / round ... ,2 = arrondir à 2 chiffres

    return "Les " . $fruit . " coutent " . $resultat . " euros pour  " . $poids . " grammes<br>";
}

// echo calcul("cerises", 500);                  ctrl/ pour tt mettre en comm !!!
// echo calcul("bananes", 500);
// echo calcul("pommes", 500);
// echo calcul("peches", 500);
// echo calcul("kiwi", 500);


?>

