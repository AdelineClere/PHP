<?php
require_once("inc/init.inc.php");

// -------------------- ⚠️⚠️ AJOUT PANIER --------------------
if(isset($_POST['ajout_panier']))   //⚠️ = le btn ajout-panier a été cliqué
{
    // debug($_POST);  // retourne ARRAY saisies pdt ajouté
    $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_POST[id_produit]'");   //⚠️  recup pdts ajoutés
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);  //⚠️  > ARRAY des infos pdt
    // debug($produit); 

    ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix']);
    // debug($_SESSION);   // retourne en ARRAY indexé les infos commande : titre, id_pdt, Qtt, prix
}


//------------------- ⚠️⚠️ SUPPRIMER 1 PDT --------------------- 

if(isset($_GET['action']) && $_GET['action'] == 'suppression') //=> si clic sur 'suppression'
{   

    retirerProduitDuPanier($_GET['id_produit']); // exec° de fct° pr suppr pdt de la session, grâce à son id
    
    $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();

    $produit_supp = $resultat->fetch(PDO::FETCH_ASSOC);
    
    $content .= '<hr><div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Le produit <strong>' . $produit_supp['titre'] . '</strong> a bien été supprimé du panier ! </div>';
}


//------------------- ⚠️⚠️ VIDER PANIER --------------------- 

if(isset($_GET['action']) && $_GET['action'] == 'vider') // si clic sur 'Vider', on rentre ds condition
{
    unset($_SESSION['panier']); //⚠️on suppr seult le tablo 'panier' de la session
}


//---------------------- ⚠️⚠️ PAIEMENT ----------------------- 
// debug($_SESSION);
if(isset($_POST['payer']))  // si bien clic sur 'Valider le paiement'
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)  //⚠️ => tant qu'il y a des id_pdt ds session, boucle tourne
    {
        $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit =" . $_SESSION['panier']['id_produit'][$i]);  //⚠️On sél. en BDD les infos des pdts ajoutés ds panier (on compare id_pdt de BDD à id_pdt ds SESSION)
        $produit = $resultat->fetch(PDO::FETCH_ASSOC);  
        // assoc. méthod fetch pour exploiter résultat sous forme de tablo <=> $produit = ARRAY ac infos d'1 pdt à chq tour de boucle for
        // debug($produit);

        $erreur ='';
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i]) 
        //⚠️si STOCK BDD < DEMANDE => on alerte :
        {
            $erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center"> Stock restant du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> : ' . $produit['stock'] . '</div>';  //  aff. messg stock restant

            $erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center"> Quantité demandée du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> : ' . $_SESSION['panier']['quantite'][$i] . '</div>';  // aff. messg Qtt demandée

                if($produit['stock'] > 0)   //⚠️ = rest stock mais insuff. > + on REDUIT la Qtt
                {
                    $erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center"> La quantité du produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> a été réduite car notre stock est insuffisant, veuillez vérifier vos achats ! </div>';
                    // aff. messg de réduction du panier

                    $_SESSION['panier']['quantite'][$i] = $produit['stock'];
                    // affecte Qtt restante en BDD directt ds session pdt, au lieu de celle demandée 
                }
                else  //⚠️ > stock = 0  => on va suppr pdt du panier
                {
                    $erreur .= '<hr><div class="alert alert-danger col-md-8 col-md-offset-2 text-center"> Le produit <strong>' . $_SESSION['panier']['titre'][$i] . '</strong> a été supprimé car nous sommes en rupture de stock ! </div>';

                    retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]); // suppr pdt de session
                    $i--;   //⚠️on décrément boucle -> si pdt [2] suppr, le [3] remonte en [2] --> il faut remonter ds boucle pr qu'il ne soit pas zappé mais lu !
                }

                $content .= $erreur; //⚠️ds tout ce 1er if, pb de stock => ttes potentielles erreurs stockées ds $content
        }
    }
    if(empty($erreur))  //⚠️<=> $erreur vide = assez de stock => INSERTION ds table commande
    {
        $resultat = $pdo->exec("INSERT INTO commande(id_membre, montant, date_enregistrement) VALUES(" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
        // => est ajouté ds la BDD, ac état 'en cours de traitement'

        $id_commande = $pdo->lastInsertId();    //⚠️ on récup dernier id_commande généré par cmd > servira pour l'insertion du detail de la commande.
        // echo $id_commande;

        for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)   //⚠️for tourne tant que pdts ds session panier.
        {
            $resultat = $pdo->exec("INSERT INTO details_commande(id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i]  . "," . $_SESSION['panier']['prix'][$i] . ")");  //⚠️on a rajouté la cmd ds ' commande '
            //⚠️A chaq tour de boucle, on insère detail cmd pr chq pdt, ds 'details_commande' + màj stock ds 'pdt'

            $resultat = $pdo->exec("UPDATE produit SET stock = stock - " . $_SESSION['panier']['quantite'][$i] . " WHERE id_produit = " . $_SESSION['panier']['id_produit'][$i]);   
            //Dépréciation des stocks : on modifie ds 'pdt' où id_pdt = id_pdt ds la session, en soustrayant la Qtt commandée (=> stocks mis à jour ds pdt)      
        }
        unset($_SESSION['panier']); //⚠️ qd paiement validé, on vide session panier + mssg Votre panier est vide :

        $content .= '<hr><div class="alert alert-success col-md-8 col-md-offset-2 text-center"> Votre commande a été validée. Votre numéro de suivi cmd est : <strong>' . $id_commande . '</strong></div>';  
    }
}



require_once("inc/header.inc.php");
echo $content;
?>


<!---------------- AFFICHAGE PANIER ---------------- -->

<div class="col-md-8 col-md-offset-2">
    <table class="table">   <!-- cellpadding="17" : classe html, pas besoin -->

        <tr><th colspan="5" class="text-center">
            <div class="alert alert-success">PANIER</div>
        </th></tr>
        
        <tr >
            <th>Titre</th>
            <th>quantité</th>
            <th>prix unitaire</th>
            <th>prix total</th>
            <th>supprimer</th>

        <?php
            if(empty($_SESSION['panier']['id_produit']))    // Si ds session 'panier' pas d'id pdt <=> pas de pdt ajouté ds panier
            {
                echo '<tr><td colspan="5"><div class="alert alert-danger text-center">Votre panier est vide !</div></td></tr>';
            }
            else
            {   // ⚠️ Boucle sur SESSION PANIER pr stocker infos de chaq pdt qu'il contient
                for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
                {
                    echo    '<tr>';
                    echo    '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';   
                    //  pr 1er tour de boucle va me chercher titre qui se trouve à [0] ds tablo titre
                    echo    '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
                    echo    '<td>' . $_SESSION['panier']['prix'][$i] . ' €</td>';
                    echo    '<td>' . $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i] . '€</td>';
                    
                    // ⚠️ colonne SUPPRIMER (on retrouve ' suppression ' + id ds URL)
                    echo    '<td>
                                <a href="?action=suppression&id_produit=' . $_SESSION['panier']['id_produit'][$i] . '" 
                                onClick="return(confirm(\'En êtes-vous certain ?\'));">
                                <span class="glyphicon glyphicon-trash"</span></a>
                            </td>';
                    echo    '</tr>';
                }
                    // ⚠️ Aff. TOTAL
                    echo '<tr><th colspan="3">Total</th><th colspan="2">' . montantTotal() . ' €</th></tr>';

                    // ⚠️ CONDITION connecté > lien paiement, ou pas.
                    if(internauteEstConnecte())
                    {
                        echo    '<form method="post" action="">';
                        echo    '<tr><td colspan="5"><input type="submit" name="payer" class="col-md-12 btn btn-primary" value="valider le paiement"></td></tr>';
                        echo    '</form>';
                    }
                    else
                    {   // ⚠️ > connex° ou >inscript°
                         echo   '<tr><td colspan="5">
                                    <div class="alert alert-warning text-center Veuillez vous 
                                        <a href="inscription.php"class="alert-link">inscrire</a>
                                        ou vous <a href="connexion.php" class="alert-link">connecter</a>
                                        pour valider le paiement>
                                    </div>
                                </td></tr>';
                    }
                    // ⚠️ VIDER panier
                    echo    '<tr><td colspan="5">   
                                <a href="?action=vider" 
                                onClick="return(confirm(\'En êtes-vous certain ?\'));">
                                <span class="glyphicon glyphicon-trash">
                                </span> Vider mon panier</a>
                            </td></tr>';
            }

        ?>
        </div>

    </table>    
</div>



<?php
require_once("inc/footer.inc.php");
?>