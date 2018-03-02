<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");

/*
Réal. fiche pdt avec infos : titre, categorie, couleur, taille, photo, description, public, prix
Réal. un sélecteur pr choisir la quantité de pdt (5 max)
Prévoir un message d'erreur en cas de rupture de stock
*/

// quand j'ai l'id_produit ds l'URL =
if(isset($_GET['id_produit'])): // ' : ' car la fin n'est plus en php (cf tt en bas le 'endif;)
    $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();

    if($resultat->rowCount() <= 0)  // si qqn rentre ref inconnue ds URL >> le rediriger vers Boutiq (sinon erreur 'undifined sur pg pdt)!
    {
        header("location:boutique.php");    // redirection
        exit();     // on stop exéc du scritp (on le sort tt de suite de la pg)
    }
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    // debug($produit);

?>


<!-- <div class="row"> // AFFICHER photo + prix + lien envoi vers fiche pdt-->
<div class="col-md-6 col-md-offset-3"> 
            <div class="panel-default border">  <!--cf Bootstrap/Components/Panels-->
                <div class="panel-heading text-center">
                    <h2> <?= $produit['titre'] ?> </h2>     <!-- Guillemts?=  > remplace un echo-->
                </div>
                <div class="panel-body">
                    <p class="text-center"><img src=" <?= $produit['photo'] ?>" alt="" class="img-responsive tofProduit"></p>   <!-- Aff tof -->
                    <p class="text-center">Catégorie : <?= $produit['categorie'] ?> <br></p>
                    <p class="text-center">Couleur : <?= $produit['couleur'] ?> <br>
                    <p class="text-center">Taille : <?= $produit['taille'] ?> <br>
                    <p class="text-center">Description : <?= $produit['description'] ?> <br>
                    <p class="text-center">Prix : <?= $produit['prix'] ?> € <br></p>    
                
                    <?php  if($produit['stock'] > 0) : ?>
                    <!-- on aurait pu mettre : ...0) {} else{} ... et ?> à la fin -->

                        <em>Nombre de produit(s) disponible(s) : <?= $produit['stock'] ?> </em><hr>
                        <form method="post" action="panier.php">
                            <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>"> 
                            <!--input caché pr que PANIR sache de quel pdt il s'agit -->
                                <label for="quantite"> Quantité </label>
                                <select class="form-control" id="quantite" name="quantite"> <!-- selecteur de Qtt -->
                                    <?php   for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++) // 5 pr pas aff tout !
                                            {
                                                echo "<option>$i</option>";
                                            }
                                    ?>
                                </select><br>
                            <input type="submit" name="ajout_panier" class="btn btn-primary col-md-12" value="Ajouter au panier">   <!-- btn ajout panier-->
                    
                    <?php else: ?>
                        <div class="alert alert-danger text-center">Rupture de stock !!</div>  <!-- RUPTURE stock-->

                    <?php endif; ?>

                </div> <!-- panel-body -->
            </div> <!-- panel-default border -->
</div> <!-- class row --> 


<?php
endif;
require_once("inc/footer.inc.php");
?>