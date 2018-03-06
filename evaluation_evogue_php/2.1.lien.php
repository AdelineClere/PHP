<?php

echo '<pre>'; print_r($_GET); echo '</pre>'; 
// superglobal ⚠️  $_GET aura ttes les infos contenues dans l'url !!

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Liens pays</title>

    </head>
    <body>
    <h1>Liens pays</h1>
    <div>
        <a href="?choix=france">France</a><br>
        <a href="2?choix=italie">Italie</a><br>    
        <a href="?choix=espagne">Espagne</a><br>    
        <a href="?choix=angleterre">Angleterre</a><br>         
        <p><hr>Vous êtes espagnol ?</p>
    </div>
    <div>
        <a href="?choix=france">France</a><br>
        <a href="?choix=italie">Italie</a><br>    
        <a href="?choix=espagne">Espagne</a><br>    
        <a href="?choix=angleterre">Angleterre</a><br>         
        <p><hr>Vous êtes français ?</p>
    </div>



    </body>
</html>