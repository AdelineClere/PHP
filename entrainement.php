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
    iconv_strlen() est une fct prédéfinie permettant de retourner la taille d'ubne chaine.
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