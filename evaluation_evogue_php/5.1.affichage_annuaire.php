<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <title>Aff. Form.</title>
    </head>
    <body>
        
    </body>
    </html>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

/* 5.4  RÉCUP ET AFF. des données de annuaire 

$resultat = $pdo->query("SELECT * FROM annuaire");

    echo '<table border=1><tr>';
        for($i = 0; $i < $resultat->columnCount(); $i++)    // retourne le nb de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle.
        {
            $colonne = $resultat->getColumnMeta($i);    // retourne les infos des champs/colonnes de la table, pour chaque tour de boucle, $colonne contient un tablo ARRAY ac infos d'une colonne

            // echo '<pre>'; print_r($colonne);echo '</pre>';
            echo '<th>' . $colonne['name'] . '</th>';   // on a créé la 1ère lg
            // On va crocheter à l'indice 'name' pour afficher le nom des colonnes.
        }
        echo '</tr>';

        $colonne .= '<th> modification </th>';
        $colonne .= '<th> suppression </th>';
        $colonne .= '</tr>';

        while($ligne = $resultat->fetch(PDO ::FETCH_ASSOC)) // On associe le méthode fetch() au résultat, $ligne contient un tablo ARRAY ac les infos d'une personne à chaq tour de boucle.
        {
            echo '<tr>';
                foreach($ligne as $informations)
                {
                    echo '<td>' . $informations . '</td>'; // On affiche successivt les valeurs ds cellules
                }
            echo '</tr>';
        }
    echo '</table>';
*/



echo '<pre>'; print_r($_POST); echo '</pre>';

$content = '';
  
$resultat = $pdo->query("SELECT * FROM annuaire");   // => objet class PDOStatement
    $content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert alert-success"> Affichage des personnes </h3>';
    $content .= 'Nombre de personnes(s) dans l\'annuaire : <span class="badge text-danger">' . $resultat->rowCount() . '</span></div>';

        $content .= '<table class="col-md-10 table" style="margin-top: 15px;"><tr>';
            for($i = 0; $i < $resultat->columnCount(); $i++)
            // retourne NB de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle.
            {
                $colonne = $resultat->getColumnMeta($i);
                // retourne INFOS des champs/colonnes à chq tour $colonne contient un ARRAY des infos d'une colonne.
        
                $content .= '<th>' . $colonne['name'] . '</th>';
                // crocheter à l'indice 'name' pour afficher le nom des colonnes => 1ère lg
            }

            $content .= '<th> modification </th>';
            $content .= '<th> suppression </th>';
            $content .= '</tr>';
        
            while($ligne = $resultat->fetch(PDO ::FETCH_ASSOC)) 
            {
                $content .= '<tr>';
                    foreach($ligne as $indice => $valeur)  // parcourt chq tablo de chq pdt
                    {                       
                        $content .= '<td>' . $valeur . '</td>';
                    }                      
                   
                    $content .= '<td class="text-center">
                                <a href="?action=modification&id_annuaire=' . $ligne['id_annuaire'] . '">
                                <span class="glyphicon glyphicon-pencil"></span>
                                </a></td>';     
                    $content .= '<td class="text-center">
                                <a href="?action=suppression&id_annuaire=' . $ligne['id_annuaire'] . '" 
                                Onclick="return(confirm(\'En êtes vous certain ?\'));">
                                <span class="glyphicon glyphicon-trash"></span>
                                </a></td>';

                    $content .= '</tr>';
                }           
        $content .= '</table>';

echo $content;




/*  5.5  Nb H/F   */

$resultat_femme = $pdo->query("SELECT * FROM annuaire WHERE sexe = 'f' ");
$resultat_homme = $pdo->query("SELECT * FROM annuaire WHERE sexe = 'm' ");

    $femme = $resultat_femme->fetch(PDO::FETCH_ASSOC); 
    $homme = $resultat_homme->fetch(PDO::FETCH_ASSOC); 
    echo '<pre>'; print_r($femme);echo '</pre>';
    echo '<pre>'; print_r($femme);echo '</pre>';
    echo '<br>';
    echo '<br>';

    echo '<br>il y a ' . $resultat_homme->num_rows . ' homme(s) et ' . $resultat_femme->num_rows . ' femme(s)';
    echo '<br>';





// 5.6  MODIF  (> afficher infos ds champs)
if(isset($_GET['action']) && $_GET['action'] == 'modification')  // Formulaire HTML de la BDD
{        
    if(isset($_GET['id_annuaire']))  // <=> c une MODIF
    {
        $resultat = $pdo->prepare("SELECT * FROM annuaire WHERE id_annuaire = :id_annuaire");
        $resultat->bindValue(':id_annuaire', $_GET['id_annuaire'], PDO::PARAM_INT);
        $resultat->execute();

            $annuaire_actuel = $resultat->fetch(PDO::FETCH_ASSOC);  // => fetch pr obtenir tablo 
          //debug($annuaire_actuel);
    }
    
    
    $id_annuaire = (isset($annuaire_actuel['id_membre'])) ? $annuaire_actuel['id_membre'] : '';
    $nom = (isset($annuaire_actuel['nom'])) ? $annuaire_actuel['nom'] : ''; 
    $prenom = (isset($annuaire_actuel['prenom'])) ? $annuaire_actuel['prenom'] : ''; 
    $profession = (isset($annuaire_actuel['profession'])) ? $annuaire_actuel['profession'] : ''; 
    $ville = (isset($annuaire_actuel['ville'])) ? $annuaire_actuel['ville'] : ''; 
    $code_postal = (isset($annuaire_actuel['code_postal'])) ? $annuaire_actuel['code_postal'] : ''; 
    $adresse = (isset($annuaire_actuel['adresse'])) ? $annuaire_actuel['adresse'] : '';
    $date_de_naissance = (isset($annuaire_actuel['date_de_naissance'])) ? $annuaire_actuel['date_de_naissance'] : ''; 
    $sexe = (isset($annuaire_actuel['sexe'])) ? $annuaire_actuel['sexe'] : ''; 
    $description = (isset($annuaire_actuel['description'])) ? $annuaire_actuel['description'] : ''; 

          
    echo '  <form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
                <h1 class="alert alert-info text-center">' . ($_GET['action']) . '</h1>
                
                <input type="hidden" class="form-control" id="id_membre" name="id_membre" placeholder="id_membre" value="' . $id_annuaire . '" >

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="' . $nom . '" >
                </div>
                <div class="form-group">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" id="nom" name="prenom" placeholder="prenom" value="' . $prenom . '" >
                </div>
                <div class="form-group">
                    <label for="profession">Profession</label>
                    <input type="text" class="form-control" id="prenom" name="profession" placeholder="profession" value="' . $profession . '" >
                </div>
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville" placeholder="ville" value="' . $ville . '" >
                </div>
                <div class="form-group">
                    <label for="code_postal">Code postal</label>
                    <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="code_postal" value="' . $code_postal . '" >
                </div>
                <div class="form-group">
                    <label for="sexe">sexe</label>
                    <select class="form-control" id="sexe" name="sexe">
                        <option value="f"'; if($sexe == 'f') echo 'selected'; echo '>Femme</option>
                        <option value="m"'; if($sexe == 'm') echo 'selected'; echo '>Homme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <textarea class="form-control" rows="3" id="description" name="description">' .  $description . '</textarea>
                </div>	
                
                <button type="submit" class="btn btn-primary col-md-12">' . ucfirst($_GET['action']) . '</button>
            </form>';

}







?>