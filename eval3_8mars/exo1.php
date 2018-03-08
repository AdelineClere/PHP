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
    
    $fiche = array("prenom" => "adeline", "nom" => "clere", "adresse" => "4 rue de la plaine", "code_postal" => "75020", "ville" => "paris", "email" => "adeline@clere.me", "telephone" => "0662299584", "date_naissance" => "01/08/1970");

    echo '<pre>'; print_r($fiche); echo '</pre>' . "<hr>";
 
    foreach ($fiche as $indice => $valeur)
    echo $indice . ' = ' . $valeur . '<br>';


?>

  

    <body>
        <form method="post" action="" class="col-md-8 col-md-offset-2">
            <h1 class="alert alert-info text-center">Inscription</h1>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom">
            </div><br>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="nom">
            </div><br>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse">
            </div><br>
            <div class="form-group">
                <label for="code_postal">Code postal</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="code_postal">
            </div><br>
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="ville">
            </div><br>    
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="email">
            </div><br>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone">
            </div><br>
            <div class="form-group">
                <label for="date_de_naissance">Date de naissance</label>
                <input id="date" type="date" name="date_de_naissance">
            </div><br><br>
        
            <button type="submit" class="btn btn-primary col-md-12">Inscription</button>
        </form>
    </body>
</html>



<?php



    


