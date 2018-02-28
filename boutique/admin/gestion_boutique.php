<?php
require_once("../inc/init.inc.php");

//----------- VERIF ADMINISTRATEUR
if(!internauteEstConnecteEtEstAdmin())
// Si internaute pas administrateur rien à faire sur cette pg, on le redirige ers la pg connexion :
{
    header("location: " . URL . "connexion.php");   // ici mettre URL car pas même dossier
}

debug($_POST);  // Verif infos se saisissent bien

//------------- ENREGISTREMENT PDT
if(!empty($_POST))  // Si mon formulaire pas vide
{
    // debug($_FILES);     // => infos ARRAY de tof chargée
    if(!empty($_FILES['photo']['name']))    // si indice name différent de vide (= une tof est chargée)
    {
        $nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name'];  // retourne NOM + REF (concaténés) de la tof
        // echo $nom_photo . '<br>';
        $photo_bdd = URL . "photo/$nom_photo";  // retourne URL de la tof => elle que l'on va enregistrer ds la BDD
        // echo $photo_bdd . '<br>';
        $photo_dossier = RACINE_SITE . "photo/$nom_photo";  // retourne le CHEMIN de la tof
        // echo $photo_dossier . '<br>';
        copy($_FILES['photo']['tmp_name'], $photo_dossier); // met la tof dans le dossier PHOTO àa la racine !!
    }
}



require_once("../inc/header.inc.php");
?>


<!-- Réal un formulaire HTML correspondant à la table produit de la BDD (sauf l'id produit) -->
    <form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
        <h1 class="alert alert-info text-center">Ajout produit</h1>
<!-- enctype="multipart/form-data" = pour recup infos sur photo -->
        <div class="form-group">
            <label for="reference">Reference</label>
            <input type="text" class="form-control" id="reference" name="reference" placeholder="reference">
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" placeholder="categorie">
        </div>
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="titre">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="text" class="form-control" id="couleur" name="couleur" placeholder="couleur">
        </div>
        <div class="form-group">
            <label for="taille">Taille</label>
            <select class="form-control" id="civilite" name="civilite">
                <option value="s">S</option>
                <option value="m">M</option>
                <option value="l">L</option>
                <option value="xl">XL</option>
            </select>
        </div>
        <div class="form-group">
            <label for="public">Public</label>
            <select class="form-control" id="civilite" name="civilite">
                <option value="m">Homme</option>
                <option value="f">Femme</option>
                <option value="mixte">Mixte</option>
            </select>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">
        </div>
        <div class="form-group">
            <label for="adresse">Prix</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse">
        </div>	
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" placeholder="stock">
        </div>

        <button type="submit" class="btn btn-primary col-md-12">Ajout d'un produit</button>
    </form>





















<?php
require_once("../inc/footer.inc.php");
?>