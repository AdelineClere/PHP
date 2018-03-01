<?php
require_once("inc/init.inc.php");
// debug($_SESSION);   // pr voir le ARRAY


if(!internauteEstConnecte())   
// Si internaute pas connecté => rien à faire sur pg profil => ⚠️  on le redirige vers la pg connexion
{
    header("location:connexion.php");
}


require_once("inc/header.inc.php");
?>


<div class="col-md-8 col-md-offset-2 panel-default border">
    <div class="panel-heading text-center"><h1>PROFIL</h1></div>
    <div class="col-md-12 text-align: left">
    
    <!-- Afficher le pseudo de l'internaute pour lui dire bonjour -->
    <h2>Bonjour <span class="text-danger"><?= $_SESSION ['membre']['pseudo'] ?></span></h2>

        <ul class="list-unstyled">  <!-- ⚠️ list-unstyled = liste sans les puces -->

            <li><h3>Voici les informations de votre profil</h3></li>
            <li>Nom : <?= $_SESSION ['membre']['nom']; ?></li>
            <li>Prénom : <?= $_SESSION ['membre']['prenom']; ?></li>
            <li>Email : <?= $_SESSION ['membre']['email']; ?></li>
            <li>Ville : <?= $_SESSION ['membre']['ville']; ?></li>
            <li>Code postal : <?= $_SESSION ['membre']['code_postal']; ?></li>
            <li>Adresse : <?= $_SESSION ['membre']['adresse']; ?></li>
            <li>Nom : <?= $_SESSION ['membre']['nom']; ?></li>      
            <!-- On se sert du FICHIER SESSION ⚠️ pour afficher les données de l'internaute qui a une session en cours -->             
        </ul>

    </div>
</div>







<?php
require_once("inc/footer.inc.php");
?>