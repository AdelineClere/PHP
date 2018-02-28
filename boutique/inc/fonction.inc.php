<?php
function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px;">'; 
    $trace = debug_backtrace();  // Fct° prédéfinie retournant un tablo ARRAY contenant des infos telles que la lg et le fichier où est exécutée la fct.
    // echo '<pre>', print_r($trace); echo '</pre>';
    $trace = array_shift($trace);   // -> on aplus l'indice [0], mais que un ARRAY
    // echo '<pre>', print_r($trace); echo '</pre>';
    echo "Debug demandé dans le fichier : $trace[file] à la lg $trace[line] . <hr>";
    echo '</div>';
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}
            // debug();    // évitera de faire tt le temps des print_r , var_dump pour voir...


//--------------------------------------------------------------------------

function internauteEstConnecte()    // Fct pr voir si le membre est connecté
{
    if(!isset($_SESSION['membre'])) // si ne s'est pas connecté, il n'est pas encore dans SESSION
    // Si l'indice membre ds fichier SESSION n'est pas défini <=> c que l'internaute n'est pas passé par la pg connexion
    {
        return false;
    }
    else
    {
        return true;
    }
}

//--------------------------------------------------------------------------

function internauteEstConnecteEtEstAdmin()  // m'indique si le membre est admin
{
    if(internauteEstConnecte() && $_SESSION ['membre']['statut'] == 1)
    // Si la session du membre est définie et que son statut est à 1 <=> il est admin > on retourne true
    {
        return true;
    }
    else
    {
        return false;
    }
}