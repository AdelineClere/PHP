<?php
require_once("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action']='deconnexion')
// ⚠️  Si on a bien cliqué sur lien deconnexion (= envoyé act° ds URL) + est-ce que action est bien = deconnexion, alors...
//     > ... on supprime la session (cf. header '?action' lg 65) :
{
    session_destroy();
}

if(internauteEstConnecte())
// Si internaute est connecté => ⚠️  rien à faire sur pg connexion => on le redirige vers sa pg profil
{
    header("location:profil.php");
}

// debug($_POST);   // on vérif que infos saisies rentrent bien



//⚠️ ⚠️ ⚠️ -------------  VERIF SAISIES de CONNEXION
if($_POST)  // qd le formulaire est soumis
{
    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'"); //⚠️ on verif que pseudo est dans la BDD
    // On selectionne ts les membres qui possèdent le même pseudo que celui saisi ds formulaire

    if($resultat->rowCount() != 0)  // Si resultat différent de 0 = pseudo connu en BDD
    {
        // echo 'OK';  // ⚠️  dc associer une methode (fetch) pour récup ses infos en ARRAY (= $membre => stockées la)
        $membre = $resultat->fetch(PDO::FETCH_ASSOC);  // On associe méthode fetch() pour rendre exploitable le résultat et récup les données de l'internaute ayant saisi le bon pseudo.

        // debug($membre);
        // if() password_verifiy($_POST['mdp'], $membre['mdp'])    //⚠️ si mdp haché => utliser cette fct pr reconnaissance
        if($membre['mdp'] == $_POST['mdp']) // => ⚠️  on contrôle si mdp saisi = mdp BDD
        {
            foreach($membre as $indice => $valeur)  //⚠️  On passe en revue infos du membre qui a bon pseudo + bon mdp
            {
                if($indice != 'mdp')    //⚠️  On exclu le mdp qui n'est pas conservé ds le fichier session
                {
                    $_SESSION['membre'][$indice] = $valeur; 
                    //⚠️  On créé ds le fichier session un tablo membre et on enregistre les données de l'internaute qui pourra dès à présent naviguer sur le site sans être connecté (cf. xamp/mtp)
                }
            }
            // debug($_SESSION);
            header("location:profil.php");  //⚠️  ayant bons identifiants, on le redirige vers sa pg profil
        }
        else    // sinon : internaute a saisi un mauvais mdp
        {
            $content .='<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Erreur mot de passe</div>';
        }
    }    
    else    // sinon : internaute a saisi un mauvais pseudo
    {
        $content .='<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Erreur de pseudo</div>';
    }
}




require_once("inc/header.inc.php");  
echo $content;


?>


<!-- Réal. formulaire HTML de connexion (champs pseudo, mdp, et bouton submit) -->

<form method="post" action="" class="col-md-8 col-md-offset-2">
	<h1 class="alert alert-info text-center">Connexion</h1>

  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="mot de passe">
  </div>
 
  <button type="submit" class="btn btn-primary col-md-12">Connexion</button>
</form>


<?php
require_once("inc/footer.inc.php");  
?>