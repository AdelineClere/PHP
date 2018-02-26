<h1>Les SESSIONS</h1>

<?php
session_start();    // permet de créer un fichier session ou l'ouvrir s'il existe déjà
                    // > xampp / tmp
$_SESSION['pseudo'] = "Greg_formateur"; 
/*  la présence de crochets rappelle l'utilisation de tablo ARRAY, 
    ds le fichier session par la superglobal $_SESSION, on définit un indice 'pseudo' 
    auquel on affecte la valeur de 'Greg_formateur'
*/
$_SESSION['prenom'] = "Grégory";
$_SESSION['nom'] = "LACROIX";    

// unset($_SESSION['nom']); // ⚠️ unset permet de vider une partie de la session

// session_destroy();       // ⚠️ session_destroy permet de supp la sessions (plus rien ds xamp/tmp)

echo '<pre>' ; print_r($_SESSION); echo '<pre>';



?>