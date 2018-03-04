<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");
?>


<div class="row row-offcanvas row-offcanvas-right"> <!-- template Bootstrap -->
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <p class="list-group-item active text-center">CATEGORIES</p>
<!-- ---------------------------------------------------------------------- -->
            <?php //⚠️️ AFFICHER CATEGORIES (= liens) de table pdt ac une boucle dans SIDEBAR
                    
                    //⚠️️ requête pour aller chercher categorie
                    $resultat = $pdo->query("SELECT DISTINCT categorie FROM produit");
                    //⚠️️ methode pr recup info d'objet PDOStatement, ac boucle sinon que 1 ARRAY (cf debug ($categorie);)
                    while($categorie = $resultat->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<a href="?categorie=' . $categorie['categorie'] . '" class="list-group-item">' .  $categorie['categorie'] . '</a>'; 
                    }
            ?>
<!-- ---------------------------------------------------------------------- -->
        </div>
    </div> <!-- fin sidebar-offcanvas-->
        <!-- JUMBOTRON -->            
        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="jumbotron">
            <h1>Ma première boutique from scratch !!!</h1>
            <p>Webforce 3, fevrier 2018</p>
        </div>
<!-- ---------------------------------------------------------------------- -->
            <?php   // créer marqueur categorie
            if(isset($_GET['categorie'])): 
                $donnees = $pdo->prepare("SELECT * FROM produit WHERE categorie = :categorie");
                $donnees->bindValue(':categorie', $_GET['categorie'], PDO::PARAM_STR);
                $donnees->execute();

                while($produit = $donnees->fetch(PDO::FETCH_ASSOC)):
                // debug($produit);    // => aff. le ARRAY des pdts contenus ds categorie cliquée
            ?>
<!-- ---------------------------------------------------------------------- -->           
    <!-- <div class="row"> ???
        ⚠️️ AFFICHER photo + prix + lien envoi vers fiche pdt -->
        <div class="col-xs-6 col-lg-4"> 
            <div class="panel-default border">              <!--cf Bootstrap/Components/Panels-->
                <div class="panel-heading text-center">
                    <h2> <?= $produit['titre'] ?> </h2>     <!--  ⚠️️ sign inf/sup à + ?=  > remplace un echo -->
                </div>
                <div>
                    <p>
                        <a href="fiche_produit.php?id_produit= <?= $produit['id_produit'] ?>">   <!-- lien sur img > fiche pdt -->
                        <img src=" <?= $produit['photo'] ?> "alt="" class="img-responsive tofProduit">
                        </a>
                    </p> <!-- Aff img -->

                    <p class="text-center"> <?= $produit['prix'] ?> € </p>  <!-- Aff prix -->
                    
                    <p class="text-center">
                        <a class="btn btn-primary" href="fiche_produit.php?id_produit= <?= $produit['id_produit'] ?> " role="button">Voir le détail &raquo;</a>     <!-- ⚠️ btn lien vers fiche pdt-->
                    </p>
                </div>          
            </div>
        </div>
    <!-- </div> --> 
<!-- ---------------------------------------------------------------------- -->
            <?php 
                endwhile; 
            endif; 
            ?>     <!-- termine condition if au dessus -->
<!-- ---------------------------------------------------------------------- -->
    </div> 
</div> <!-- fin template Bootstrap -->


<?php
require_once("inc/footer.inc.php");
?>