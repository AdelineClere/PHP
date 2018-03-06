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
    

    if($_POST)  // ⚠️ si je clique sur le bouton connexion alors on rentre dans le if
    {
        echo 'Titre : ' .  $_POST['titre'] . '<br>';
        echo 'Couleur : ' . $_POST['couleur'] . '<br>';
        echo 'Taille : ' . $_POST['taille'] . '<br>';
        echo 'Poids : ' . $_POST['poids'] . '<br>';
        echo 'Prix : ' . $_POST['prix'] . '<br>';
        echo 'Description : ' . $_POST['description'] . '<br>';
        echo 'Stock : ' . $_POST['stock'] . '<br>';
        echo 'Fournisseur : ' . $_POST['fournisseur'] . '<br>';
    }


    ?>
    
<body>
    <form method="post" action="" class="col-md-8 col-md-offset-2">
        <h1 class="alert alert-info text-center">Produit</h1>

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="titre">
        </div><br>
        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="text" class="form-control" id="couleur" name="couleur" placeholder="couleur">
        </div><br>
        <div class="form-group">
            <label for="taille">Taille</label>
            <input type="text" class="form-control" id="taille" name="taille" placeholder="taille">
        </div><br>
        <div class="form-group">
            <label for="poids">Poids</label>
            <input type="text" class="form-control" id="poids" name="poids" placeholder="poids">
        </div><br>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" placeholder="prix">
        </div><br>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
        </div><br>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" placeholder="stock">
        </div><br>
        <div class="form-group">
            <label for="fournisseur">Fournisseur</label>
            <input type="text" class="form-control" id="fournisseur" name="fournisseur" placeholder="fournisseur">
        </div><br>
        
        <button type="submit" class="btn btn-primary col-md-12">Inscription</button>
    </form>
</body>




</html>