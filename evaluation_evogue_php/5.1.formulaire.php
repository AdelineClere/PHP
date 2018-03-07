<?php

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

echo '<pre>'; var_dump($pdo); echo '</pre>';



echo '<pre>'; print_r($_POST); echo '</pre>';


if($_POST)
{
   $resultat = $pdo->exec("INSERT INTO annuaire (nom, prenom, telephone, profession, ville, codepostal, adresse, date_de_naissance, description) VALUES ('$_POST[nom]', '$_POST[prenom]','$_POST[telephone]','$_POST[profession]','$_POST[ville]','$_POST[codepostal]','$_POST[adresse]','$_POST[date_de_naissance]','$_POST[description]')");

    echo '<div style="background: green; color: #fff; padding: 10px; text-align: center; border-radius: 5px; width: 
    200px;">Enregistrement OK !!</div>';

    echo "Nombre d'enregistrement affecté par l'insert : $resultat" . '<br>';
    
}





?>



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
                .formulaire {
                    border: 1px;
                }
            </style>
    </head>
        

<body>
    <form method="post" action="" class="col-md-8 col-md-offset-2 formulaire">
        <h1 class="alert alert-info text-center">Information</h1>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="nom">
        </div><br>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom">
        </div><br>
        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone">
        </div><br>
        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" class="form-control" id="profession" name="profession" placeholder="profession">
        </div><br>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="ville">
        </div><br>
        <div class="form-group">
            <label for="codepostal">Code postal</label>
            <input type="text" class="form-control" id="codepostal" name="codepostal" placeholder="codepostal">
        </div><br>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse">
        </div><br>
        <div class="form-group">
            <label for="date_de_naissance">Date de naissance</label>
            <input id="date" type="date" name="date_de_naissance">
        </div><br><br>
        <div class="form-group">
            <label for="sexe">Sexe</label>
            <select class="form-control" id="sexe" name="sexe">
                <option value="m">Homme</option>
                <option value="f">Femme</option>
            </select>
        </div><br>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
        </div><br>
	
        <button type="submit" class="btn btn-primary col-md-12">Enregistrement</button>
    </form>
</body>


</html>

