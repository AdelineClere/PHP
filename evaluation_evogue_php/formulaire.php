<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Formulaire</title>

    <link href="<?= URL ?>inc/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="<?= URL ?>inc/css/style.css" rel="stylesheet">
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

  </head>
    
    <?php
    //-------------------- ⚠️ CONNEXION BDD
    $pdo = new PDO('mysql:host=localhost;dbname=formulaire', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
    //-------------------- ⚠️ VARIABLES
    $content = ''; 


    echo '<pre>'; var_dump($pdo); echo '</pre>';
    echo '<pre>'; print_r(get_class_methods($pdo)); echo'</pre>';

        if($_POST)
        {
            $erreur = '';
            // ⚠️ on prépare nom ac marqueur pour éviter injections, XSS
            $verif_nom = $pdo->prepare("SELECT * FROM membre WHERE nom = :nom");
            $verif_nom->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
            $verif_nom->execute();
            
                if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20)
                {
                    $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille nom non valide !!</div>';
                }
                $content .= $erreur;
        
                if(empty($erreur)) // si 0 $erreur > ⚠️ s'insérer ds table membre à l'aide de requête préparée
                {                    
                    $resultat = $pdo->prepare("INSERT INTO membre(, nom, prenom, adresse, ville, code_postal, sexe ) VALUES (:nom, :prenom, :adresse, :ville, :code_postal, :sexe)");
        
                    $resultat->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
                    $resultat->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                    $resultat->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
                    $resultat->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
                    $resultat->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
                    $resultat->bindValue(':sexe', $_POST['sexe'], PDO::PARAM_STR);
        
                    $resultat->execute(); 
                    
                    // inscription ok > lien pr se connecter
                    $content .='<div class="alert alert-succes col-md-8 col-md-offset-2 text-center">Vous êtes inscrit(e)<br> <a href="connexion.php" class="alert-link">Cliquez ici pour vous connecter</a></div>';
                }
        }
        
    echo'<pre>'; var_dump($resultat); echo '</pre>';



    ?>
    

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
            <select class="form-control" id="civilite" name="civilite">
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