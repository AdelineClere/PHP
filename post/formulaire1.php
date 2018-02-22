<?php
    /*
        Les SUPERGLOBALES (http://php.net/manual/fr/language.variables.superglobals.php):
        Ce sont des variables de type ARRAY qui sont prédéfinies dans le code et qui permettent 
        de véhiculer des données.
        On peut les appeler partout ds le code, dans les espaces local & global.
        $_GLOBALS - $_SERVEUR - $_GET - $_POST - $_FILES - $_COOKIE - $_SESSION - $_REQUEST - $_ENV
    */
    // ex. : echo '<pre>'; print_r($_SERVER); echo '</pre>'; 
    // affiche (ss forme ARRAY) des infos sur notre serveur local XAMPP (MAMPP)

    echo '<pre>'; print_r($_POST); echo '</pre>'; 
    // Les données que l'on rentre en pseudo et mdp se stock la !!

    // EXO : afficher les données saisies ds le formulaire ac affichage classiq
    if($_POST)  // si je rentre ds condition le formulaire est soumis, je stock données ds cette superglobale
    {
        echo '<hr>Pseudo : ' .  $_POST['pseudo'] . '<br>';
        echo 'Mot de passe : ' . $_POST['mdp'] . '<br>';
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire 1</title>
        <style>
            label{
                float: left;
                width: 120px;
                font-style: italic;
                font-family: Calibri;
            }
        </style>
    </head>
    <body>
        <h1>Formulaire de connexion</h1>
        <hr>
        <form method="post" action=""> 
            <!-- METHOD : comment vont circuler les données (on peut récup données depuis le formulaire (= POST) 
                 ou url (= méthode GET)) - ACTION : URL de destination -->
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">  
            <br><br> <!-- l'attribut 'name' est indisp. pr exploiter les données en PHP -->

            <label for="mdp">Mot de passe</label>
            <input type="text" id="mdp" name="mdp" placeholder="mot de passe">
            <br><br>
            <input type="submit" value="connexion">
        </form>
    </body>
</html>

