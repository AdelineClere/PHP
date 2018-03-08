<?php

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

echo '<pre>'; var_dump($pdo); echo '</pre>';


/* 5.2  AFFICHER contenu annuaire */
echo '<pre>'; print_r($_POST); echo '</pre>';



/* 5.3  INSÉRER dans annuaire */
if($_POST)
{
   $resultat = $pdo->exec("INSERT INTO annuaire (nom, prenom, telephone, profession, ville, codepostal, adresse, date_de_naissance, description) VALUES ('$_POST[nom]', '$_POST[prenom]','$_POST[telephone]','$_POST[profession]','$_POST[ville]','$_POST[codepostal]','$_POST[adresse]','$_POST[date_de_naissance]','$_POST[description]')");

    echo '<div style="background: green; color: #fff; padding: 10px; text-align: center; border-radius: 5px; width: 
    200px;">Enregistrement OK !!</div>';

    echo "Nombre d'enregistrement affecté par l'insert : $resultat" . '<br>'; 
}

/* 5.3  CORRECTION 
if(isset($_POST['enregistrement']))
{	// --- recuperation ET contrôle des données
    foreach($_POST as $indice => $valeur)
    { 
        echo $indice . " : " . $valeur . "<br />"; 
    }
	$date_de_naissance =  $_POST['annee'] . "-" . $_POST['mois'] . "-" . $_POST['jour'];

    if(strlen($_POST['telephone']) < 10)
    { 
        print "<div class='erreur'>n° de telephone mobile incorrect</div>"; 
    }		
    if(strlen($_POST['nom']) < 2)
    { 
        print "<div class='erreur'>nom trop court</div>"; 
    }		
    if(strlen($_POST['prenom']) < 2)
    { 
        print "<div class='erreur'>prenom trop court</div>";
    }
	
	if(strlen($_POST['telephone']) == 10 && strlen($_POST['nom']) > 2 && strlen($_POST['prenom']) > 2)
	{
		$mysqli->query("insert into annuaire (nom,prenom,telephone,profession,ville,codepostal,adresse,date_de_naissance,sexe,description) 
								values ('$_POST[nom]', '$_POST[prenom]', '$_POST[telephone]', '$_POST[profession]', '$_POST[ville]', '$_POST[codepostal]', '$_POST[adresse]',  '$date_de_naissance', '$_POST[sexe]', '$_POST[description]')");
		print "<div class='succes'>Votre inscription à bien été enregistrée dans l'annuaire</div>";
	}
}
*/


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
    <form method="post" action="5.1.affichage_formulaire.php" class="col-md-8 col-md-offset-2 formulaire">
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
	
        <button type="submit" class="btn btn-primary col-md-12" name="enregistrement">Enregistrement</button>
    </form>
</body>
</html>


