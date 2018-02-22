<style>
    h2{
        margin: 0;
        font-size: 15px;
        background: #dedede;
        text-align: center;
        padding: 10px;
    }
</style>

<!-- -------------------------------
        ECRITURE 1 AFFICHAGE
--------------------------------- -->
<h2>Ecriture et affichage</h2>
<!-- nous pouvons écrire du html dans un fichier ayant l'extension php, mais pas l'inverse -->

<?php
echo 'Bonjour';     // echo est une instruction qui permet d'effectuer un affichage = 'affiche-moi'
echo '<h3>Bonjour</h3>';    
// on peut également mettre du html, si on observe le code source, vous ne verrez pas le PHP, car le langage est interprété
echo '<hr><h2>Commentaires</h2>';
?>

<strong>Bonjour</strong>    
<!-- on peut repartir sur du html à tout moment, et autant de fois que l'on veut !
= possible de fermer et ré-ouvrir php pour mélanger du code html et PHP -->

<?= "Allo" ?>   <!-- = remplace echo -->

<?php
echo 'texte';    // Si on met pas ';' -> message d'erreur en php, et nous dit quoi !
/*  
    ceci est un commentaire
    sur plusieurs lignes 
*/

echo 'texte'; # ceci est un comm sur une seule ligne

print 'Nous sommes mercredi'; // print est une autre instruction d'affichage. Pas de diff. entre echo et print

// Vous n'êtes pas obligés de fermer la balise php si sur la pg nous codons seulement du php


/* ---------------------
        VARIABLES
-----------------------*/
echo '<hr><h2>Variables : types / Déclaration / affectation </h2>';
// Une variable est un espace nommé permettant de conserver une valeur
// on déclare toujours une variable avec le sign $ suivi du nom de la variable
// ex : $a -> ok ----- $2a -> erreur, jamais de chiffre après $, pas d'accent, pas d'espace

$a = 127;   // affectation de la valeur 127 dans la variable nommée "a"

echo gettype($a);   // gettype = fct prédéfinie ds code PHP permettant de voir le type d'une variable. 
// Il s'agit d'un entier = INTEGER
echo '<br>';

$b = 1.5;
echo gettype ($b);  // un nombre à virgule = un DOUBLE
echo '<br>';

$c = "une chaine";
echo gettype($c);   // une chaine de caract. dc = STRING
echo '<br>';

$d = '127';
echo gettype($d);  // avec les QUOTES, le type retourné est une chaine de c. dc = string
echo '<br>';

$e = true;
echo gettype($e);   // BOOLEAN
echo '<br>';

$f = false;
echo gettype($f);   // BOOLEAN
echo '<br>';



/* ---------------------
    CONCATENATION
-----------------------*/
echo '<hr><h2>Concaténation</h2>';

$x = "Bonjour";
$y = " tout le monde";
echo $x . $y ."<br>";    // -> Bonjour tout le monde
    // POINT DE CONCATENATION que l'on peut traduire par suivi de
    // affiche moi la valeur x suivie de valeur y ...

echo "$x $y <br>";    // -> Bonjour tout le monde : entre guillemets, les variables sont évaluées
echo '$x $y <br>';    // -> $x $y : entre quote, c'est une chaine de caractère, les variables ne sont pas évaluées
echo 'aujourd\'hui';    // avec les simple quote, si nous envoyons une chaine de c. avec un apostrophe, 
// cela génère une erreur, nous sommes obligés de placer un '\' pour préciser que c un apostrophe
echo "aujourd'hui";

echo "Hey ! " . $x . $y . "<br>";

echo "<br>" , "coucou" , "<br>";    // concaténation avec une virgule : virgule et pt de concat. sont similaires



/* ---------------------
    CONCATENATION
-----------------------*/
echo '<hr><h2>Concaténation lors de l\'affectation</h2>';

$prenom1 = "Gégory";
$prenom1 = "Adeline";
echo $prenom1 . '<br>';  // -> Adeline : cela remplace Grégory par Ad

$prenom2 = "Grégory";
$prenom2 .= " Adeline";  
echo $prenom2;  // -> Grégory Adeline : ajoute la nouvelle valeur sans remplacer la 1ère grâce à l'opérateur '.='



/* ---------------------
    CONSTANTE
-----------------------*/
echo '<hr><h2>Constante et constante magique</h2>';

// Une constante tout comme une variable permet de conserver une valeur, mais comme son nom l'indique,
// elle est constante ! càd que l'on ne pourra pas la mofifier durant l'exécution du script. 
// Contrairement à une variable, qui elle peut varier !! 

define("CAPITALE", "Paris"); // par convention une const. se déclare tjrs en maj.
echo CAPITALE . "<br>";     // affichage de la const.

// define("CAPITALE", "Rome");     /!\ erreur, on ne peut pas modifier une const. déjà défnie


// constante magique
echo __FILE__ . '<br>';     // -> donne chemin complet vers fichier sur lequel je trv
echo __LINE__ . '<br>';     // -> donne lg sur laquelle je suis en train d'exécuter



/* ---------------------
        EXO
-----------------------*/
echo '<hr><h2>Exo concat</h2>';
// Exercice varaibles : afficher bleu-blanc-rouge (avec les tirets) en mettant chaque couleur dans une variable

$bleu = "bleu";
$blc = "blanc";
$rg = "rouge";
echo $bleu . " - " . $blc . " - " . $rg . "<br>";
echo "$bleu-$blc-$rg<br>";



/* -------------------------------
    OPERATEURS ARITHMETIQUES
---------------------------------*/
echo '<hr><h2>Opérateurs arithmétiques</h2>';

$a = 10; $b = 2;
echo $a + $b . "<br>";  // 12
echo $a - $b . "<br>";  // 8
echo $a * $b . "<br>";  // 20
echo $a / $b . "<br>";  // 5


// Opérations/Affectation
$a = 10; $b = 2;

$a += $b;   // => $a = $a + $b
echo $a . "<br>";       // affiche 12

$a -= $b;   // equivaut à $a = $a - $b
echo $a . "<br>";       // affiche 10

$a *= $b;   // equivaut à $a = $a * $b
echo $a . "<br>";       // affiche 20

$a /= $b;   // equivaut à $a = $a / $b
echo $a . "<br>";       // affiche 10



/* -----------------------------------------
    STRUCTURES CONDITIONNELLES (if/else)
-------------------------------------------*/
echo '<hr><h2>Structures conditionnelles (if/else)</h2>';
// isset et empty
// $var1 = 0;
$var2 = "";

// EMPTY test si une varirable a la valeur de '0', si elle est vide ou si elle n'est pas définie.
if(empty($var1))
{
    echo '0, vide ou non définie<br>';  // s'affiche car condition bien respectée : elle est en comm mais pas définie !!
}
if(empty($var2))

{
    echo '0, vide ou non définiee<br>';  // s'affiche ça car condition bien respectée : elle existe mais pas définie !!
}

// ISSET test l'existence d'une variable, si elle existe, si elle est déclarée, si elle est définie
if(isset($var2))
{
    echo "$var2 existe et est définie par rien<br>"; // on rentre ds condition
}

if(isset($var1))
{
    echo "$var2 existe et est définie par rien<br>"; // on ne rentre pas ds condition
}


// opérateurs de comparaison -------------------------------------------------------
/*
=       est égal à / affectation
==      comparaison de la valeur
===     comparaison de la valeur et du type
>       strictement supérieur à 
<       strictement inférieur à
=>      supérieur ou égal à 
<=      inférieur ou égal à
!=      différent de
!       n'est pas
&& AND  et
|| or   ou
XOR ou  exclusif
*/

$a = 10; $b = 5; $c = 2;
if($a > $b)
{
    echo "A est bien supérieur à B<br>";
}
else     // cas par défaut, dans tous les autres cas, on tombe dans la condition else
{
    echo "Non c'est B qui est supérieur à A<br>";
}
// -------------------------------------------------------------

if ($a > $b && $b > $c)
{
    echo "OK pour les 2 conditions<br>";        // on rentre ds les 2 condtions
}
if($a == 9 || $b > $c)
{
    echo "OK pour au moins l'une des 2 conditions<br>";     // on rentre ds une dc ok
}
else{
    echo "Nous sommes dans le else<br>";
}
// -------------------------------------------------------------

if ($a == 8)
{
    echo "1 - A est égal à 8<br>";
}
else if ($a != 10)
{
    echo "2 - A est différent de 10<br>";
}
else
{
    echo "3 - tout le monde a faux<br>";
}

// --------
if ($a == 10)
{
    echo "1 - A est égal à 10<br>";
}
elseif ($b == 5)    // le elseif bloque le script ! > n'affiche pas alors que condition respectée..
{
    echo "2 - B est égal à 10<br>";
}
else
{
    echo "3 - tout le monde a faux<br>";
}
// Si la 1ère condition est respectée, avec le ELSEIF le script stop le script malgré que la 2è condition soit respectée.
// On peut déclarer une condition ac plusieurs elseif, en revanche il n'y aqu'un seul cas par défaut "else".

// -------------------------------------------------------------
// condition exclusive
if($a == 10 XOR $b == 6)
{
    echo "ok condition exclusive<br>";  // ac XOR SEULEMENT une des 2 doit ê respectée
    // Si les 2 conditions sont bonnes ou si les conditionsq sont mauvaises, nous ne rentrons pas ici
}

// -------------------------------------------------------------
// Forme contractée : 2è possibilité d'écriture d'un if
echo ($a == 10) ? "A est égal à 10<br>" : "A n'est pas égal à 10<br>";
// Le ? remplace le if et les ':' remplacent le else


// -------------------------------------------------------------
// comparaison
$vara = 1;
$varb = "1";
if($vara == $varb)
{
    echo "il s'agit de la même chose<br>";
}
// Avec la présence du ===, la condition n'est pas respectée car les valeurs sont les mêmes 
// mais les types sont différents.
// Avec le ==, le test fct car les valeurs sont les mêmes.
// == comparaison de la valeur
// === comapraison valeur et type


// -------------------------------------------------------------
echo '<hr><h2>Condition switch</h2>';
$couleur = "jaune";
switch($couleur)
{
    case 'bleu':
    echo "Vous aimez le bleu";
    break;

    case 'rouge':
    echo "Vous aimez le rouge";
    break;

    case 'vert':
    echo "Vous aimez le vert";
    break;

    default:
    echo "Vous n'aimez rien";
    break;
}
echo "<br>";
// Les case représentes les différents cas ds lesquels nous pouvons potentiellement tomber, 
// break stop l'exécution du script si un des cas est vérifié
// Si un des cas n'est pas vérifié, nous tombons dans le cas par défaut "default"

// Exo : pouvez-vous faire la même chose que le switch avec des else ?
$couleur = "jaune";

if ($couleur == 'bleu')
{
    echo "Vous aimez le bleu<br>";
}
elseif ($couleur == 'rouge')
{
    echo "Vous aimez le rouge<br>";
}
elseif ($couleur == 'vert')
{
    echo "Vous aimez le vert<br>";
}
else
{
    echo "Vous n'aimez rien<br>";
}


/* ----------------------------------
    FONCTIONS PREDEFINIES
-----------------------------------*/
echo '<hr><h2>Fonction prédéfinie : traitement des chaines</h2>';
//une fonction prédéfinie permet de réaliser un traitement spécifiq

echo "Date : ";
echo date ("d/m/Y") . "<br>";  // ex. de fct prédéfinie retournant la date du jr.
// Qd on utilise une fct prédéfinie, tjrs se poser la question : 
// quels paramètres doit-on envoyer à cette fct et surtout savoir ce qu'elle retourne.
// > Penser à consulter la doc  ! (pour voir formats de date  de la fct Date)

// -------------------------------------------------------------
$email1 = "a2line8@yahoo.fr";
echo strpos($email1, "@"); // retourne la position du caract. "@" dans la chaine de c.
// strpos est une fct prédéfinie peemettant de trouver un caractère spécifique ds une chaine
/*
    arguments : 
    1 - nous devons lui fournir la chaine ds laquelle nous souahitons chercher un signe
    2 - nous lui donnons l'info à chercher
*/
echo "<br>";
$email2 = "bonjour";
echo strpos($email2, "@"); // > cette lg ne sort rien pourtant il y a bien qqch à l'intérieur : FALSE !! >>>
var_dump(strpos($email2, "@")); // Grâce à var_dump on aperçoit le FALSE si le caractère "@" n'est pas trouvé. 
// var_dump est donc une instruction d'affichage améliorée, on l'utilise régulièrement en phase de développement.

echo "<br>";
// -------------------------------------------------------------
$phrase = "Mettez du texte à cet endroit";
echo iconv_strlen($phrase); // -> 29 
/*
    iconv_strlen() est une fct prédéfinie permettant de retourner la taille d'une chaine.
    Succès > INT
    Echec > boolean FALSE
    Contexte > nous pourrons l'utiliser pour savoir si le pseudo et le mdp lors d'une inscription ont des tailles conformes
*/

echo "<br>";
// -------------------------------------------------------------
$texte = "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo";

echo substr($texte, 0, 20) . "... <a href=''> Lire la suite </a>";
// retourne les 20 premiers caract. de la chaine et affiche "Lire la suite
/*
    substr() est une fct prédéfinie permettant de retourner une partie de la chaine.
    arguments : 
    1 - La chaine à couper
    2 - la position de début
    3 - La position de fin
    contexte : sur certains articles, on a le début en accroche et un lieu pour voir la suite de l'article.
*/



/* ----------------------------
    FONCTIONS UTILISATEUR
------------------------------*/
echo '<hr><h2>Fonction utilisateur</h2>';
// Qui ne sont pas prédéfinies ds le langage, mais déclarées puis exécutées par l'utilisateur

function separation() // déclar° d'une fct prévue pour ne pas recevoir d'arguments
{
    echo "<hr><hr><hr>";    // voici une simple fct permettant de tirer 3 trais sur la pg web
}
separation();   // exécution de la fct



/* ---------------------------------------------------
    FONCTIONS AVEC avec ARGUMENTS :
    Les arguments sont des paramètres fournis à la fct 
    pour lui permettre de complèter ou modifier son comportement initial prévu
/*

    function bonjour ($qui)     // variable de réception dc pas besoin de lui attribuer une valeur
    {
        echo "Bonjour $qui <br>";
    }
    bonjour();    //  --> erreur !
    */

// On peut affecter une valeur par défaut à la variable de réception, ds ce cas à l'exécution, 
// il n'est pas nécessaire de lui envoyer un argument si l'on veut afficher sa valeur par défaut.
function bonjour ($qui)     // $qui ne sort pas de nulle part :permet de prévoir un argument, 
// il s'agit d'une variable de réception, pas besoin de lui attribuer une valeur
{
    echo "Salut $qui <br>";
}
bonjour("Pierre");      //  --> Pierre
$prenom = "Adeline";    
bonjour($prenom);   //  --> Ad

// Quand on est ds 1 fct = espace LOCAL / Tout ce qui est à l'extérieur = espace GLOBAL


// ----------------------------------------------------------------
// var déclarée en LOCAL

function joursemaine()
{
    $jour = "Jeudi";    // var déclarée en local = à l'int de la fct
    return $jour;       // RETURN : nous sort de fct !!
    // une fct peut retourner 1 résultat, c pour cela que l'on utilise le mot clé "return", 
    // pour sortir de la fct > tt le code exécuté après ne sera pas exécuté
    echo'ALLO';         // -> n'apparait pas à cause du "return" !
}

echo joursemaine();         // 'jeudi'
echo $jour;                 //  rien /!\ car variable connue que à l'intérieur de la fct

$recup = joursemaine();     // on récup
echo $recup ;               // jeudi : on affiche
echo "<br>";

// ----------------------------------------------------------------
// var déclarée en GLOBAL

$pays = "France";       // var déclarée ds l'espace global = à l'ext. d'une fct = espace par défaut
function affichagePays()
{
   global $pays;        // Pour importer une var déclarée en global vers l'espace local => 'global'
   echo $pays;          // inutile ?
}
affichagePays();        // France : exécution de la fct
// On ne peut pas déclarer 2 fois une fct ac le même nom.
echo "<br>";


// ---------------------------------------------------------------- 

function appliqueTva($nombre)   // var de reception
{
    return $nombre*1.2;
}
echo appliqueTva(500) . "<br>";          // 600


// EXO : Pourriez-vous améliorez cette fct afin que l'on puisse calculer un nb ac les taux de notre choix (19,6%, 5,5%, 7%)

// /!\ On ne peut déclarer 2 fois la même fct > changer nom
function appliqueTva2($nombre, $taux = 20)  // argument initialisé par défaut à 20%
{
    return $nombre*(1 + $taux/100);     // calcul tva = 1 + taux/100
}
echo appliqueTva2(500) . "<br>";        // 600   $taux a une val par défaut, dc à l'éxé pas necess de lui envoyer un 2è
echo appliqueTva2(500, 5.5) . "<br>";   // 527.5  Le 2è argument écrase la val par défaut de la variable $taux
echo appliqueTva2(500, 19.6) . "<br>";  // 598
echo appliqueTva2(500, 7) . "<br>";     // 535


// ---------------------------------------------------------------- 
/*
meteo("hiver", 0);      // --> on peut exécuter fct avant de l'avoir déclarée !
function meteo($saison, $temperature)
{
    echo "Nous sommes en $saison et il fait $temperature degré(s)<br>";
    
}
*/

// EXO : gérer le 's' de degrés    
function exometeo($saison, $temperature)
{
    echo "Nous sommes en $saison et il fait $temperature";
    if ($temperature > 1 || $temperature < -1)
    {
         echo " degrés<br>";
    }   
    else
    {
        echo " degré<br>";
    }
}
exometeo("hiver", 0);
exometeo("été", 1);
exometeo("hiver", -1);
exometeo("hiver", -15);
exometeo("hiver", 15);



/* ----------------------------
         Les BOUCLES
------------------------------*/
echo '<hr><h2>Boucle : structure itérative</h2>';

$i = 0;                 // val de départ de la boucle
while($i < 3)           // Tant que $i < 3
{
    echo "$i---";       // pour chq tour de boucle, on affiche $i suivi de '---'
    $i++;               // équivaut à $i = $i + 1 = l'incrémentation du "compteur" effectué à chq tour
}                       // 0---1---2---


echo "<br>";
// EXO : faites en sorte de ne pas avoir les '-' à la fin
$j = 0;
while($j < 3)
{
    if ($j == 2)
        echo $j;        // je ne rentre qu'une seule fois ici
    else
        echo "$j---";   // dans ts les autres cas on tombe ds le else ac l'incrémentation
        $j++;
}   
// {} : pas necess si UNE SEULE instruction dans un IF, else. Conseillé de les mettre en débutant.


echo "<br>";
//------------------------------------------------------------------------------
//  BOUCLE FOR

for ($j = 0; $j < 16; $j++)     // valeur de départ ; condition d'entrée ; incrémentation.
{
    echo $j;
}

echo "<br>";
// EXO : afficher 30 options via une boucle

echo '<select>';
for ($i = 0; $i < 31; $i++)
{
    echo "<option>$i</option>";     // <option> est une balise html pour menu déroulant !!
}
echo '</select>';       // -> menu déroulant qui va de 0 à 30 !!


echo "<br>";
//-----------------------------------------------------------------
//  EXO : Faites une boucle 0 à 9 sur la même lg ds un tablo HTML |
/*    echo '<table>';         // déclaration de tablo
        echo '<tr>';        //        __        ligne
            echo '<td>';    //        __        cellule
            echo '</td>'
        echo '</tr>';
    echo '</table>';
*/

echo '<table border=1><tr>';
        for($j = 0; $j <=9; $j++)
        {
            echo "<td>$j</td>";         // -> tablo ac cellules de 0 à 9 !!
        }
    echo '</tr></table><br>';



//-----------------------------------------------------------------------------------------------------------------
//  EXO : Faites la même chose en allant de 0 à 99 sur pls lg sans faire 10 boucles (mais 2 boucles imbriquées !) |

$z = 0;
echo '<table border=1>';
    for($ligne = 0; $ligne < 10; $ligne++)      // on déclare la 1ère lg = 1ere boucle
    {
        echo '<tr>';
        for ($cellule = 0; $cellule < 10; $cellule++) // Tant que lg est à 0, la cellule s'incrémente 10 fois,
        // lg est à 1 elles s'incrémente 10 fois etc...
            {
                echo '<td>' . $z . '</td>';     // $z ne revient jamais à 0 puisqu'on incrémente à chq tour de boucle
                $z++;       // (qd on a fini la 1ère boucle, on arrive à 9, 
                //on repart à 1ère boucle lg 613, et on continue à incrémenter z > qui passe à 10 !)
            }
        echo '</tr>';
    }    
echo '</table>';


// Autre méthode :
$z = 0;
echo '<table border=1>';
    for($ligne = 0; $ligne < 10; $ligne++)  
    {
        echo '<tr>';
        for ($cellule = 0; $cellule < 10; $cellule++)
            {
                echo '<td>' . (10 * $ligne + $cellule) . '</td>';
                $z++;      // $z = $z + 1
            }
        echo '</tr>';
    }    
echo '</table>';



/* ----------------------------
    TABLEAUX DE DONNEES
------------------------------*/
echo '<hr><h2> Tableau de données ARRAY </h2>';

$liste = array("Grégory", "John", "Andrei","Adeline");
echo $liste;    //!\\ ERREUR : on ne peut pas afficher les données 
// d'un tableau avec une instruction d'affichage classique

echo '<pre>'; var_dump($liste); echo '</pre>'; // renvoi ça :
    /*    array(4) {
            [0]=>
            string(8) "Grégory"
            [1]=>
            string(4) "John"
            [2]=>
            string(6) "Andrei"
            [3]=>
            string(7) "Adeline"
        }   */

echo '<pre>'; print_r($liste); echo '</pre>'; // renvoi ça :
    /*    Array
        (
            [0] => Grégory
            [1] => John
            [2] => Andrei
            [3] => Adeline
        )   */

// var_dump et print_r sont des instructions d'affichage améliorées.
// pre = balise html pour formater texte = mettre en forme la sortie du print_r ou var_dump
// Contexte : qd on récup des infos en BDD, on les retrouvera sous forme d'ARRAY


//--------------------------------------------------------------------
//  BOUCLE FOR EACH
echo '<hr><h2> Boucle foreach pour les tableaux de données ARRAY </h2>';
$tab[] = "France";
$tab[] = "Italie";
$tab[] = "Espagne";
$tab[] = "Portugal";
$tab[] = "Angleterre";
$tab[] = "Suisse";      // Autre moyen de déclarer un tablo array, à l'aide de crochets

// (echo $tab; --> Marche pas )

echo '<pre>'; print_r($tab); echo '</pre>'; // renvoi ça :
    /*    Array
        (
            [0] => France
            [1] => Italie
            [2] => Espagne
            [3] => Portugal
            [4] => Angleterre
            [5] => Suisse
        )   */

// EXO : tenter de sortir "Italie" en passant par le tableau ARRAY sans faire echo "italie" ;)
echo($tab[1]) . "<hr>"; // -> Italie :  On va crocheter à l'indice 1 du tablo de données ARRAY


foreach($tab as $info) // $info : va parcourir/afficher 1 pays à chq tour de boucle
// Le mot AS fait partie du langage et est oblilgatoire. $info vient parcourir la colonne des valeurs 
// du tablo de données ARRAY, pour chaq tr de boucle, elle possède une valeur différente.
{
    echo $info . "<br>";    // On affiche successivt les élts du tablo
}   //affiche : 
                /*  France
                    Italie
                    Espagne
                    Portugal
                    Angleterre
                    Suisse  */

//--------------------------------------------------------------
foreach ($tab as $indice => $info) // qd 2 variables : la 1ère parcours la col des indices, 
                                   // la 2è parcourt la col des valeurs (infos)
{
    echo $indice . ' -> ' . $info . '<br>';   // on affiche successivt l'indice en fct de la valeur
}       // affiche :   
            /*  0 => France
                1 => Italie
                2 => Espagne
                3 => Portugal
                4 => Angleterre
                5 => Suisse     */


$couleur = array("j" => "jaune", "r" => "rouge", "v" => "vert", "b" => "bleu");
// Possible de définir les indices du tablo de données ARRAY
echo '<pre>'; print_r($couleur); echo '</pre>' . "<hr>";
            /*  Array
                (
                    [j] => jaune
                    [r] => rouge
                    [v] => vert
                    [b] => bleu
                )   */

// EXO : afficher successivt les données (indice, val) du tablo représenté par la $couleur
foreach ($couleur as $indice => $valeur)
echo $indice . ' = ' . $valeur . '<br>';

echo 'Taille du tableau : ' . count($couleur) . "<br>"; // -> affiche 4
echo 'Taille du tableau : ' . sizeof($couleur) . "<br>";
// sizeof = count, ce sont des fct prédéfinies pour retourner la taille du tablo

echo implode("-", $couleur);    // -> jaune-rouge-vert-bleu 
// implode = fct prédéf.  qui rassemble les élts d'1 tablo en une chaine (séparés par un symbole)


//--------------------------------------------------------------------
echo '<hr><h2> Tableaux de données ARRAY multidimensionnel </h2>';

$tab_multi = array(
             0 => array("prenom" => "Grégory", "nom" => "Lacroix"),
             1 => array("prenom" => "Adeline", "nom" => "Clere"),
);
/*
echo '<pre>'; print_r($tab_multi); echo '</pre>';
            Array
            (
                [0] => Array
                    (
                        [prenom] => Grégory
                        [nom] => Lacroix
                    )

                [1] => Array
                    (
                        [prenom] => Adeline
                        [nom] => Clere
                    )
            )   */

// EXO : tenter de sortir "Clere" en passant par les tablo ARRAY et sans faire de echo "clere"
echo $tab_multi[1] ["nom"];
// rq : si on avait pas déclaré nom, prenom, mais just "Adeline", "Clere" => on aurait mis [1] au lieu de nom !

echo '<hr>';
// EXO : extraire les valeurs des tableaux multi à l'aide de boucles

foreach($tab_multi as $premierIindice => $tableau) // [0] on parcourt tablo principal, 
                         // au 1er sous-tablo la boucle lit premierIindice (=prenom)
{
    foreach($tableau as $deuziemeIndice => $prenomNom)  // on est dans le 1er tablo, 
                        // nvlle boucle foreach pour parcourir et lire deuziemeIndice (=nom)
    {
        echo $prenomNom . "<br>";
    }
}                   /*  Grégory
                        Lacroix
                        Adeline
                        Clere   */


echo '<hr>';
// autre choz :

foreach($tab_multi as $indice1 => $valeurs) 
{
        echo implode ("-", $valeurs) . '<br>';                                  
        echo "<br>";
}