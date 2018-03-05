<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Formulaire</title>
  </head>
    
    <?php
    

    if($_POST)  // ⚠️ si je clique sur le bouton connexion alors on rentre dans le if
    {
        echo 'Nom : ' .  $_POST['nom'] . '<br>';
        echo 'Prénom : ' . $_POST['prenom'] . '<br>';
        echo 'Adresse : ' . $_POST['adresse'] . '<br>';
        echo 'Ville : ' . $_POST['ville'] . '<br>';
        echo 'Code postal : ' . $_POST['code_postal'] . '<br>';
        echo 'Email : ' . $_POST['email'] . '<br>';
        echo 'Sexe : ' . $_POST['sexe'] . '<br>';
        
        echo 'Description : ' . $_POST['description'] . '<br>';

    }


    ?>
    
<body>
    <form method="post" action="" class="col-md-8 col-md-offset-2">
        <h1 class="alert alert-info text-center">Inscription</h1>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="nom">
        </div><br>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom">
        </div><br>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse">
        </div><br>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="ville">
        </div><br>
        <div class="form-group">
            <label for="code_postal">Code postal</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="code_postal">
        </div><br>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="email">
        </div><br>
        <div class="form-group">
            <label for="sexe">Sexe</label>
            <select class="form-control" id="sexe" name="sexe">
            <option value="f">Femme</option>
            <option value="m">Homme</option>
            </select>
        </div><br>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
        </div><br>
	
        <button type="submit" class="btn btn-primary col-md-12">Inscription</button>
    </form>
</body>




</html>