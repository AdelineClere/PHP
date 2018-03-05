<?php
require_once("../inc/init.inc.php");


//⚠️⚠️⚠️ BACK OFFICE ------------------------------------------------
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center"> BACK OFFICE </h3>'; 
$content .= '<a href="?action=affichage" class="list-group-item text-center"> Affichage des commandes </a>';  // ⚠️ act° AFFICHAGE
$content .= '<hr></div>';


//⚠️⚠️⚠️ AFF TABLO COMMANDES ------------------------------------------------

if(isset($_GET['action']) && $_GET['action'] == 'affichage')  
{
    $resultat = $pdo->query("SELECT * FROM commande");   // => objet class PDOStatement
    $content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert alert-success"> Affichage des commandes </h3>';
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

            $content .= '<th> details </th>';
            $content .= '<th> suppression </th>';
            $content .= '<th> etat </th>';
            $content .= '<th> modification </th>';
            $content .= '</tr>';
        
            while($ligne = $resultat->fetch(PDO ::FETCH_ASSOC)) 
            {
                $content .= '<tr>';
                    foreach($ligne as $indice => $valeur)  // parcourt chq tablo de chq pdt
                    {                       
                        $content .= '<td>' . $valeur . '</td>';
                    }                      
                   
                    $content .= '<td class="text-center">
                                <a href="?action=modification&id_membre=' . $ligne['id_commande'] . '">
                                <span class="glyphicon glyphicon-pencil"></span>
                                </a></td>';     
                    $content .= '<td class="text-center">
                                <a href="?action=suppression&id_membre=' . $ligne['id_commande'] . '" 
                                Onclick="return(confirm(\'En êtes vous certain ?\'));">
                                <span class="glyphicon glyphicon-trash"></span>
                                </a></td>';
                    $content .= '<td> <div class="form-group">
                                    <form method="post" action="">
                                        <select class="form-control" id="etat" name="etat">
                                            <option value="en_cours_de_traitement"'; if($ligne == 'en_cours') echo 'selected'; $content .= '>En cours de traitement</option>
                                            <option value="envoye"'; if($ligne == 'envoye') echo 'selected'; $content .= '>Envoyé</option>
                                            <option value="livre"'; if($ligne == 'livre') echo 'selected'; $content .= '>Livré</option>
                                        </select>
                                    <td>
                                        <button type="submit" class="btn btn-primary col-md-12">Modifier état</button>
                                    </td>
                                    </form>   
                                </div></td>';
                                debug($_POST);
                                    
                                if($_POST['commande']['id_commande'])
                                
                                
                                
                                

                    $content .= '</tr>';
                }           
        $content .= '</table>';
}


require_once("../inc/header.inc.php");
echo $content;



//⚠️⚠️⚠️ ------------- MODIF COMMANDE (> afficher infos ds champs)
if(isset($_GET['action']) && $_GET['action'] == 'modification')  // Formulaire HTML de table membre de la BDD
{        
    if(isset($_GET['id_commande']))  // <=> c une MODIF
    {
        $resultat = $pdo->prepare("SELECT * FROM commande WHERE id_commande = :id_commande");
        $resultat->bindValue(':id_commande', $_GET['id_commande'], PDO::PARAM_INT);
        $resultat->execute();

        $commande_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
          // => fetch pr obtenir tablo new pdt
          //debug($membre_actuel);
    }
    
    //⚠️ si id_membre est défini ds BDD > on l'affiche sinon > on aff chaine de caract vide !
    $id_membre = (isset($commande_actuel['id_membre'])) ? $commande_actuel['id_membre'] : '';
    $email = (isset($commande_actuel['email'])) ? $commande_actuel['email'] : ''; 
    $nom = (isset($commande_actuel['nom'])) ? $commande_actuel['nom'] : ''; 
    $prenom = (isset($commande_actuel['prenom'])) ? $commande_actuel['prenom'] : ''; 
    $adresse = (isset($commande_actuel['adresse'])) ? $commande_actuel['adresse'] : '';
    $id_commande = (isset($id_commande['pseudo'])) ? $id_commande['pseudo'] : ''; 
   
            
    echo '  <form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
                <h1 class="alert alert-info text-center">' . ($_GET['action']) . '</h1>
                
                <input type="hidden" class="form-control" id="id_membre" name="id_membre" placeholder="id_membre" value="' . $id_membre . '" >
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" value="' . $email . '" >
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
                    <label for="adresse">Adresse</label>
                    <textarea class="form-control" rows="3" id="adresse" name="adresse">' .  $adresse . '</textarea>
                </div>	
             
            </form>';

}

require_once("../inc/footer.inc.php");
?>