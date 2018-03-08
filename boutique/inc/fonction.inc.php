<?php
function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px;">'; 
    $trace = debug_backtrace();  // Fct° prédéfinie retournant un tablo ARRAY contenant des infos telles que la lg et le fichier où est exécutée la fct.
    // echo '<pre>', print_r($trace); echo '</pre>';
    $trace = array_shift($trace);   // -> on a plus l'indice [0], mais que un ARRAY
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
    if(!isset($_SESSION['membre'])) // si ne s'est pas connecté, il n'est pas encore dans SESSION (= ARRAY ds xamp/tmp)
    // ⚠️  Si l'indice membre ds fichier SESSION n'est pas défini <=> c que l'internaute n'est pas passé par la pg connexion
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
    // ⚠️ Si la session du membre est définie et que son statut est à 1 <=> il est admin > on retourne true
    {
        return true;
    }
    else
    {
        return false;
    }
}

//------------------------------ PANIER ------------------------------------

// 1. On prépare SESSION = les contenants
function creationDuPanier()
{
    if(!isset($_SESSION['panier']))  //⚠️ Si indice panier pas définie (= encore rien d'ajouté ds panier) > le créer
    {
        $_SESSION['panier'] = array();  // On créé un ARRAY pr chaq indice (contenant) - Poss. avoir pls pdts ds panier 
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}
// 2. on va préparer le contenu
function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix) //⚠️ fct utlisateur reçoit 4 arguments conservés ds session 'panier'
{
    creationDuPanier(); // On contrôle si le panier existe ou non ds la session 

    $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);   
    // Méthode ' array_search ' ⚠️ vérifie si id_pdt ajouté existe déjà dans session et A QUEL INDICE (+ précis que rowCount !) > pr rajouter Qtt au même indice et pas créer new indice à chq fois qu'on ajoute le pdt !!
    // echo $position_produit;

        if($position_produit !== false) //= si pos° pdt diff de false = càd il retourne l'indice de l'id_pdt trouvé
        {
            $_SESSION['panier']['quantite'][$position_produit] += $quantite;    // on change la Qtt à l'indice trouvé !
        }
        else    // sinon le pdt n'existe pas ds session, dc stock les infos aux diff indices
        {
            $_SESSION['panier']['titre'][] = $titre;  // [] => pour créer par défaut des indices numeriq pr les données
            $_SESSION['panier']['id_produit'][] = $id_produit;  // on stock indice pdt à [0] du ARRAY
            $_SESSION['panier']['quantite'][] = $quantite;
            $_SESSION['panier']['prix'][] = $prix;
        }
}

//------------------------------ MONTANT TOTAL -----------------------------------

function montantTotal()
{
    $total = 0;
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)    
    // boucle tourne tant que des id_pdt ds session > on multiplie Qtt x prix pour chaq indice
    {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // on ajoute résultat de chq indice suivant
    }
    return round($total, 2); //=> résultat arrondi à 2 chiffres
}


//------------------------------ RETIRER du PANIER -----------------------------------

function retirerProduitDuPanier($id_produit_a_supprimer)
{
    $position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']); 
    // trouve moi ds la session l'indice pdt que je veux suppr 
    // fct° prédéfinie ⚠️array_search pourcomparer puis retourner indice où est le pdt à suppr ds la session 'panier'

    if($position_produit !== false) 
    // si var $position_pdt retourne une val diff de false <=> indice bien trouvé ds session 'panier'
    {
        array_splice($_SESSION['panier']['titre'], $position_produit, 1);   
        array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);
        //⚠️array_splice() permet de SUPPR une lg ds tablo session et REMONTE les INDICES inférieurs du tablo aux indices supérieurs (= si je suppr 1 pdt à [4] -> ts les pdts suivants remonteront tous d'un cran (d'un indice) ==> permet de réorganiser tablo panier ds la session et pas avoir trous ni indice vide)
    }
}

