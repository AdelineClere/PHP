<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Formulaire</title>
        <style>
                label{
                    float: left;
                    width: 120px;
                    font-family: Calibri;
                }
        </style>
    </head>
    

<?php

echo '<pre>'; print_r($_POST); echo '</pre>'; 

    if($_POST) 
    {

        // déclarer une valeur 'erreur' vide
        $erreur = "";
        
        if (iconv_strlen($_POST['pseudo']) < 3 || iconv_strlen($_POST['pseudo']) > 10) // on crochète l'indice pseudo
        {
            $erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
            Votre pseudo doit contenir entre 3 et 10 caractères</div>'; // idem
        }

        if(empty($erreur))  // Si elle est restée vide c ok ! > je lance boucle foreach 
        {
            echo '<div style="background: green; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
            Inscription ok</div>';
        }
        echo $erreur;   // Pas oublier d'appeler message $erreur si pas bon !
    }

 ?>




   
    <body>
        <form method="post" action="" class="col-md-8 col-md-offset-2">
        
            <h1 class="alert alert-info text-center">Membre</h1>

            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo">
            </div><br>

            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="text" class="form-control" id="mdp" name="mdp" placeholder="mdp">
            </div><br>
        
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="email">
            </div><br>
        
            <button type="submit" class="btn btn-primary col-md-12"> valider </a></button>
        </form>
    </body>


</html>