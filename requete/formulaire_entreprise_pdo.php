<?php
/*
EXO 1
1 - Réaliser un formulaire HTML correspondant à la table 'employes' de la BDD entp
2 - Réaliser le script permettant d'insérer un employé ds la BDD en soumettant le formulaire
        - connexion BDD
        - contrôle de récupération des données du formulaire
        - script de requête d'insertion
*/


echo '<pre>'; print_r($_POST); echo '</pre>'; 
// ⚠️ Contrôler que l'on stock bien les données saisiees de $_POST

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => 
PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));


if($_POST)  // ⚠️ on a soumis le formulaire => values stockées ds superglobal $_POST
{
    $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) 
    VALUES ('$_POST[prenom]', '$_POST[nom]', '$_POST[sexe]', '$_POST[service]', '$_POST[date_embauche]', '$_POST[salaire]')");  

    echo '<div style="background: green; color: #fff; padding: 10px; text-align: center; border-radius: 5px; width: 
    200px;">Inscription OK !!</div>';
}


?>

<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>Nouveaux employés</title>
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
        <h1>Employés</h1>
        <hr>
        <form method="post" action="">  
            
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" placeholder="prénom"><br><br>

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="nom"><br><br>

            <label for="sexe">Sexe</label>
            <select name="sexe">
                <option value="m">Homme</option>
                <option value="f">Femme</option>
            </select><br><br>

            <label for="service">Service</label>
            <input type="text" id="service" name="service" placeholder="service"><br><br>

            <label for="date_embauche">Date d'embauche</label>
            <input type="date" id="date_embauche" name="date_embauche" placeholder="date_embauche"><br><br><br>
                                    
            <label for="salaire">Salaire</label>
            <input type="text" id="salaire" name="salaire" placeholder="salaire"><br><br>

            <input type="submit" value="envoi">
        </form>
    </body>
</html>