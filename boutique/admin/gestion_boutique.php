<?php
require_once("../inc/init.inc.php");

//⚠️⚠️⚠️  -------------  VERIF ADMINISTRATEUR 
if(!internauteEstConnecteEtEstAdmin()) // Si internaute est pas administrateur -> ⚠️ on le redirige vers pg connexion :
{
    header("location: " . URL . "connexion.php");   // ici mettre URL car pas même dossier
}
// debug($_POST);  // Verif infos se saisissent bien


//⚠️⚠️⚠️ ------------- SUPPRESSION PDT
if(isset($_GET['action']) && $_GET['action'] == 'suppression')  
// On rentre ds la condition que ds cas où l'on cliq sur le lien de suppr de l'affichage des pdts.
{
    // debug ($_GET);   --> pr voir contenu URL /   Préparer marqueur
    $resultat = $pdo->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();

    // on affecte nvll valeur à indice 'action'qui est ds URL, pr être redirigé sur l'affichage des pdts après la suppr° :
    $_GET['action']  = 'affichage';  

    $content .='<div class="alert alert-sucess col-md-8 col-md-offset-2 text-center">Le produit n° <span class="text-success">' . $_GET['id_produit'] . '</span>a bien été supprimé</div>'; //' .= ' : ⚠️ pour pas effacer données déjà contenues dedans : on ajoute)
}
            /* NON PREPAREE :
                if(isset($_GET['action']) && $_GET['action'] == 'suppression')  
                {
                    // debug ($_GET);   --> pr voir contenu URL
                    $resultat = $pdo->exec("DELETE FROM produit WHERE id_produit = '$_GET[id_produit]'");  
                }    */


//⚠️⚠️⚠️  ------------- ENREGISTREMENT / MODIF PDT 

if(!empty($_POST))
{
    //⚠️⚠️  ENREGISTREMENT PHOTO

        // ⚠️ Quand MODIF pdt
        $photo_bdd ='';
        if(isset($_GET['action']) && $_GET['action'] == 'modification')
        // = si cliqué 'Modif pdt' (= envoyé act° ds URL) + que act° est bien = modification, alors...
        {
            $photo_bdd = $_POST['photo_actuelle'];  // ⚠️ pour renvoyer même img ds BDD, pas du vide, et garder la même img
            // si on veut garder mêm photo > on affecte la val du champ 'hidden' (ds formul./photo) càd URL de photo actuelle
        }

        // debug($_FILES);     // => infos ARRAY de tof chargée
        if(!empty($_FILES['photo']['name']))    // ⚠️ si indice name différent de vide (= une tof est chargée) dc >
        {
            $nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name'];  //⚠️ On concatène REF saisie +  NOM tof via superglobal $_FILES      
            // echo $nom_photo . '<br>';
            $photo_bdd = URL . "photo/$nom_photo";  //⚠️ On défini URL de la tof (> elle qu'on va enregistrer ds BDD)
            // echo $photo_bdd . '<br>';
            $photo_dossier = RACINE_SITE . "photo/$nom_photo";  //⚠️ Défini  le CHEMIN de la tof sur le serveur
            // echo $photo_dossier . '<br>';
            copy($_FILES['photo']['tmp_name'], $photo_dossier); //⚠️ Copie la tof directt ds dossier PHOTO à la racine !
            //⚠️ La fct copy() reçoit 2 arguments : 1 - le nom temporaire de la photo --- 2. le chemin du dossier photo  
        }


    //⚠️⚠️  INSERER (-> lg 193) / MODIFIER PDT avec requête préparée    => ⚠️⚠️  CONTRÔLER et STOCKER infos
                 
        if(isset($_GET['action']) && $_GET['action'] == 'ajout')    // ds URL on a ' ...?action=ajout ' = ⚠️⚠️ INSÉRER
        {   
            //⚠️ CONTROLER dispo d'une réf (on prépare reference ac marqueur pour éviter injections, XSS):
            $erreur = '';
            $verif_ref = $pdo->prepare("SELECT * FROM produit WHERE reference = :reference");
            $verif_ref->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
            $verif_ref->execute();  // execute, rowCount,... : methodes de PDOStatement
        
            if($verif_ref->rowCount() > 0)   //⚠️ cpt nb de lg sélectionnées par ma requête => Réf existe déjà !
            {
                $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center"> La référence existe déjà. Merci de rentrer un référence valide ! </div>';
            }
                $content .= $erreur;    //⚠️ pr stocker ce que contient la variable $erreur

            if(empty($erreur))  // on rentre pas ici dc mettre un if empty lg 93
            {   // ⚠️ on prépare marqueurs de tous les champs :
                $resultat = $pdo->prepare("INSERT INTO produit(reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)");

                $content .='<div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Le produit n° <strong class="text-success">' . $_POST['reference'] . '</strong> a bien été ajouté</div>';   // ⚠️ OK AJOUTÉ
            }
        }
        else    // si ?action=modification ds URL > ⚠️⚠️ MODIFIER pdt à l'aide d'une requête préparée :
        {
            $resultat = $pdo->prepare("UPDATE produit SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, public = :public, photo = :photo, prix = :prix, stock = :stock WHERE id_produit = '$_POST[id_produit]'");

            $content .='<div class="alert alert-success col-md-8 col-md-offset-2 text-center">Le produit n° <span class="text-success">' . $_GET['id_produit'] . '</span> a bien été modifié</div>';    // OK MODIFIÉ
        }
            //⚠️ on affecte val aux marqueurs à afficher ds les champs à modif :

            if(empty($erreur))  // mettre ici pas lg 83 : après avoir prep les marqueurs
            {        
                $resultat->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR); 
                $resultat->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
                $resultat->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
                $resultat->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
                $resultat->bindValue(':couleur', $_POST['couleur'], PDO::PARAM_STR);
                $resultat->bindValue(':taille', $_POST['taille'], PDO::PARAM_STR);
                $resultat->bindValue(':public', $_POST['public'], PDO::PARAM_STR);
                $resultat->bindValue(':photo', $photo_bdd, PDO::PARAM_STR);         //⚠️ car c'est URL de tof que l'on prend
                $resultat->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);      // INT !
                $resultat->bindValue(':stock', $_POST['stock'], PDO::PARAM_INT);    // INT !

                $resultat->execute(); 
            }    
}


//⚠️⚠️⚠️ -------------  BACK OFFICE //⚠️⚠️⚠️  
$content .= '<div class="list-group col-md-6 col-md-offset-3">';
$content .= '<h3 class="list-group-item active text-center"> BACK OFFICE </h3>';  // 'active' -> met en bleu
$content .= '<a href="?action=affichage" class="list-group-item text-center"> Affichage produit </a>';  // ⚠️ act° AFFICHAGE
$content .= '<a href="?action=ajout" class="list-group-item text-center"> Ajout produit </a>';  // ⚠️ act° AJOUT
$content .= '<hr></div>';


//⚠️⚠️⚠️ ------------- AFFICHAGE PRODUITS (tablo)
if(isset($_GET['action']) && $_GET['action'] == 'affichage')  
// = si bien cliqué sur 'Affichage pdt' (= envoyé act° ds URL) + que action est bien = affichage pdt > alors j'afficherai tablo pdt :
{
    // Aff table pdt en tablo HTML + prévoir un lien modification et suppression pour chq pdt (= + 2 col)
    $resultat = $pdo->query("SELECT * FROM produit");   // => objet class PDOStatement
    $content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert alert-success"> Affichage produits </h3>';
    $content .= 'Nombre de produit(s) dans la boutique : <span class="badge text-danger">' . $resultat->rowCount() . '</span></div>';

        $content .= '<table class="col-md-10 table" style="margin-top: 15px;"><tr>';
            for($i = 0; $i < $resultat->columnCount(); $i++)    // ⚠️️ columnCount() = méthode from class PDOStatement 
            // ⚠️️ retourne NB de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle.
            {
                $colonne = $resultat->getColumnMeta($i);    // ⚠️️ getColumnMeta() = méthode from class PDOStatement
                // ⚠️️ récolte INFOS des champs/colonnes à chq tour $colonne contient un ARRAY des infos d'une colonne.
        
                $content .= '<th>' . $colonne['name'] . '</th>';
                //⚠️️  On va crocheter à l'indice 'name' pour afficher le nom des colonnes => 1ère lg
            }

            // On ajoute 2 col
            $content .= '<th> modification </th>';
            $content .= '<th> suppression </th>';
            $content .= '</tr>';
        
                while($ligne = $resultat->fetch(PDO ::FETCH_ASSOC)) // On associe le méthode fetch() au résultat, 
                // ⚠️️ $ligne CONTIENT un ARRAY des infos d'1 pdt à chaq tour de boucle.
                {
                    // debug($ligne);  // --> pr voir contenu URL (le ARRAY pdt)           
                    $content .= '<tr>';
                        foreach($ligne as $indice => $valeur)  // parcourt chq tablo de chq pdt
                        {                       
                            // Aff. des tofs pdt
                            if($indice == 'photo')
                            {
                                $content .= '<td><img src="' . $valeur . '" alt="" width="70" height="70"</td>';
                                // ⚠️️ Chaq tour créé une cellule ac une val d'1 indice
                            }
                            else
                            {
                                $content .= '<td>' . $valeur . '</td>';
                            }                      
                        }

                    // ⚠️️⚠️️ Créer lien + Envoyer l'action MODIF + id du pdt ds l'URL :
                    $content .= '<td class="text-center">
                                <a href="?action=modification&id_produit=' . $ligne['id_produit'] . '">
                                <span class="glyphicon glyphicon-pencil"></span>
                                </a></td>';     
                    // url passe de http:...admin/gestion_boutique.php
                    //        à --> http:...admin/gestion_boutique.php?action=modification&id_produit=1
                    // ⚠️️⚠️️ Créer lien + Envoyer l'action SUPPR + id du pdt ds l'URL :
                    $content .= '<td class="text-center">
                                <a href="?action=suppression&id_produit=' . $ligne['id_produit'] . '" 
                                Onclick="return(confirm(\'En êtes vous certain ?\'));">
                                <span class="glyphicon glyphicon-trash"></span>
                                </a></td>';
                            // ⚠️️ Onclick="return(confirm(\'En êtes vous certain ?\')); = alerte avant de jeter

                    $content .= '</tr>';
                }           
        $content .= '</table>';
}    

require_once("../inc/header.inc.php");
echo $content;  // ⚠️⚠️⚠️  Appelle tt le contenu stocké depuis debut) le message d'erreur (ref déjà présente, cf lg 21)


//-------------------------------------------------------------------------------------------------------------------


// ⚠️️ Normalement faire aussi le contrôle des champs...

//⚠️⚠️⚠️ ------------- AJOUT ou MODIF des pdts
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{   // Formulaire HTML de table produit de la BDD (⚠️ sauf l'id produit) -->
            
    if(isset($_GET['id_produit']))  // <=> c une MODIF
    {
        $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
        $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_INT);
        $resultat->execute();
            // but = recup en 1 objet : ttes les infos du pdt requis > associer méthode :
        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC);   // => fetch pr obtenir tablo nex pdt
            // debug($produit_actuel);  --> on voit le tablo du pdt à modifier   
    }
    
    // ⚠️ si id_produit est défini ds BDD > on l'affiche sinon > on aff chaine de caract vide ! ⚠️ ifelse RÉDUIT : ?..=.. ⚠️ !
    $id_produit = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit'] : '';
    $reference = (isset($produit_actuel['reference'])) ? $produit_actuel['reference'] : ''; 
    $categorie = (isset($produit_actuel['categorie'])) ? $produit_actuel['categorie'] : ''; 
    $titre = (isset($produit_actuel['titre'])) ? $produit_actuel['titre'] : ''; 
    $description = (isset($produit_actuel['description'])) ? $produit_actuel['description'] : ''; 
    $couleur = (isset($produit_actuel['couleur'])) ? $produit_actuel['couleur'] : ''; 
    $taille = (isset($produit_actuel['taille'])) ? $produit_actuel['taille'] : ''; 
    $public = (isset($produit_actuel['public'])) ? $produit_actuel['public'] : ''; 
    $photo = (isset($produit_actuel['photo'])) ? $produit_actuel['photo'] : ''; 
    $prix = (isset($produit_actuel['prix'])) ? $produit_actuel['prix'] : ''; 
    $stock = (isset($produit_actuel['stock'])) ? $produit_actuel['stock'] : '';
    // ou
        // if(isset($produit_actuel['id_produit']))
        // {
        //     echo $produit_actuel['id_produit'];
        // } 
        // else
        // {
        //     echo '';
        // }    

// Besoin d'un champs caché pour stocker infos de ce pdt :  <input type="hidden" id="id_produit" name="id_produit">
    // -> si on met text au lieu de hidden > on voit bien que l'on est sur l'id du pdt cliqué pr modif
// ⚠️ eucfirst($_GET['action']) ⚠️  => pr récup action de URL : 'Ajout' ou 'Modification' et adapter ainsi titre formulaire !
// ⚠️ enctype="multipart/form-data" = pour recup infos sur photo
// ⚠️ $php ou if() js => pour afficher dans les champs de objet à modif
// disabled = pas modifiable ! (après réf avant ' > ')

    echo '<form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
            <h1 class="alert alert-info text-center">' . ucfirst($_GET['action']) . '</h1> 

            <input type="hidden" id="id_produit" name="id_produit" value="' . $id_produit . '"> 
                            
            <div class="form-group">
                <label for="reference">Référence</label>
                <input type="text" class="form-control" id="reference" name="reference" placeholder="reference"
                value="' . $reference . '" >
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" placeholder="categorie"
                value="' . $categorie . '">
            </div>
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="titre"
                value="' . $titre . '">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="3" id="description" name="description">' . $description . '</textarea>
            </div>
            <div class="form-group">
                <label for="couleur">Couleur</label>
                <input type="text" class="form-control" id="couleur" name="couleur" placeholder="couleur"
                value="' . $couleur . '">
            </div>
            <div class="form-group">
                <label for="taille">Taille</label>
                <select class="form-control" id="taille" name="taille">
                    <option value="aucune"'; if($taille == 'aucune') echo 'selected'; echo '>-</option>
                    <option value="s"'; if($taille == 's') echo 'selected'; echo '>S</option>
                    <option value="m"'; if($taille == 'm') echo 'selected'; echo '>M</option>
                    <option value="l"'; if($taille == 'l') echo 'selected'; echo '>L</option>
                    <option value="xl"'; if($taille == 'xl') echo 'selected'; echo '>XL</option>
                </select>
            </div>
            <div class="form-group">
                <label for="public">Public</label>
                <select class="form-control" id="public" name="public">
                    <option value="aucune">-</option>
                    <option value="m"'; if($public == 'm') echo 'selected'; echo '>Homme</option>
                    <option value="f"'; if($public == 'f') echo 'selected'; echo '>Femme</option>
                    <option value="mixte"'; if($public == 'mixte') echo 'selected'; echo '>Mixte</option>
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" value="' . $photo . '"><br>';
                if(!empty($photo))
                {
                    echo '<i> Vous pouvez uploader une nouvelle photo si vous souhaitez la changer </i><br>';
                    echo '<img src="' . $photo . '"width="90 height="90" value="' . $photo . '"><br>';
                }
                echo '<input type="hidden" id="photo_actuelle" name="photo_actuelle" value="' . $photo . '">';
            echo '</div>
                

            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="prix"
                value="' . $prix . '">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock" placeholder="stock"
                value="' . $stock . '">
            </div>
            
            <button type="submit" class="btn btn-primary col-md-12">' . ucfirst($_GET['action']) . '</button>
        
    </form>';
}

//-------------------------------------------------------------------------------------------------------------------
require_once("../inc/footer.inc.php");
?>