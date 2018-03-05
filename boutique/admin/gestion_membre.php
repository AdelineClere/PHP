<?php
require_once("../inc/init.inc.php");


//⚠️⚠️⚠️ BACK OFFICE ------------------------------------------------
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center"> BACK OFFICE </h3>'; 
$content .= '<a href="?action=affichage" class="list-group-item text-center"> Affichage des membres </a>';  // ⚠️ act° AFFICHAGE
$content .= '<hr></div>';


//⚠️⚠️⚠️ AFF TABLO MEMBRES ------------------------------------------------

if(isset($_GET['action']) && $_GET['action'] == 'affichage')  
{
    $resultat = $pdo->query("SELECT * FROM membre");   // => objet class PDOStatement
    $content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert alert-success"> Affichage des membres </h3>';
    $content .= 'Nombre de membres(s) dans la boutique : <span class="badge text-danger">' . $resultat->rowCount() . '</span></div>';

        $content .= '<table class="col-md-10 table" style="margin-top: 15px;"><tr>';
            for($i = 0; $i < $resultat->columnCount(); $i++)
            // ⚠️️ retourne NB de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle.
            {
                $colonne = $resultat->getColumnMeta($i);
                // ⚠️️ récolte INFOS des champs/colonnes à chq tour $colonne contient un ARRAY des infos d'une colonne.
        
                $content .= '<th>' . $colonne['name'] . '</th>';
                //⚠️️  On va crocheter à l'indice 'name' pour afficher le nom des colonnes => 1ère lg
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
                                <a href="?action=modification&id_membre=' . $ligne['id_membre'] . '">
                                <span class="glyphicon glyphicon-pencil"></span>
                                </a></td>';     
                    $content .= '<td class="text-center">
                                <a href="?action=suppression&id_membre=' . $ligne['id_membre'] . '" 
                                Onclick="return(confirm(\'En êtes vous certain ?\'));">
                                <span class="glyphicon glyphicon-trash"></span>
                                </a></td>';

                    $content .= '</tr>';
                }           
        $content .= '</table>';
}


require_once("../inc/header.inc.php");
echo $content;



//⚠️⚠️⚠️ ------------- MODIF MEMBRES (> afficher infos ds champs)
if(isset($_GET['action']) && $_GET['action'] == 'modification')  // Formulaire HTML de table membre de la BDD
{        
    if(isset($_GET['id_membre']))  // <=> c une MODIF
    {
        $resultat = $pdo->prepare("SELECT * FROM membre WHERE id_membre = :id_membre");
        $resultat->bindValue(':id_membre', $_GET['id_membre'], PDO::PARAM_INT);
        $resultat->execute();

        $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
          // => fetch pr obtenir tablo new pdt
          //debug($membre_actuel);
    }
    
    //⚠️ si id_membre est défini ds BDD > on l'affiche sinon > on aff chaine de caract vide !
    $id_membre = (isset($membre_actuel['id_membre'])) ? $membre_actuel['id_membre'] : '';
    $pseudo = (isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] : ''; 
    $mdp = (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] : ''; 
    $nom = (isset($membre_actuel['nom'])) ? $membre_actuel['nom'] : ''; 
    $prenom = (isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] : ''; 
    $email = (isset($membre_actuel['email'])) ? $membre_actuel['email'] : ''; 
    $civilite = (isset($membre_actuel['civilite'])) ? $membre_actuel['civilite'] : ''; 
    $ville = (isset($membre_actuel['ville'])) ? $membre_actuel['ville'] : ''; 
    $code_postal = (isset($membre_actuel['code_postal'])) ? $membre_actuel['code_postal'] : ''; 
    $adresse = (isset($membre_actuel['adresse'])) ? $membre_actuel['adresse'] : '';

          
    echo '  <form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
                <h1 class="alert alert-info text-center">' . ($_GET['action']) . '</h1>
                <input type="hidden" class="form-control" id="id_membre" name="id_membre" placeholder="id_membre" value="' . $id_membre . '" >
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo" value="' . $pseudo . '" >
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="mot de passe" value="' . $mdp . '" >
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="' . $nom . '" >
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="' . $prenom . '" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" value="' . $email . '" >
                </div>
                <div class="form-group">
                    <label for="civilite">Civilité</label>
                    <select class="form-control" id="civilite" name="civilite">
                        <option value="f"'; if($civilite == 'f') echo 'selected'; echo '>Femme</option>
                        <option value="m"'; if($civilite == 'm') echo 'selected'; echo '>Homme</option>
                    </select>
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
                    <label for="adresse">Adresse</label>
                    <textarea class="form-control" rows="3" id="adresse" name="adresse">' .  $adresse . '</textarea>
                </div>	
                
                <button type="submit" class="btn btn-primary col-md-12">Valider modification</button>
            </form>';

}

require_once("../inc/footer.inc.php");
?>