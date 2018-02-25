<!-- 1.
- ⚠️ Contôler que l'on récupère en php ttes les données saisies du formulaire
- afficher au dessus les données du form. à l'aide d'un affichage conventionnel
-->

<?php

echo '<pre>'; print_r($_POST); echo '</pre>'; 

if($_POST) 
{
// 2. Informer l'internaute si la taille du pseudo n'est pas compris entre 5 et 20 caractères
//    si données valides on affiche on les affiche.
// 3. Contrôler la validité du champs email à l'aide d'une fct prédéfinie
// 4. Contrôler CP : taille et type numériq

    // déclarer une valeur 'erreur' vide
    $erreur = "";
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))    // ⚠️ Vérifie si la chaine ressemble à un email
    {
        $erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
        Saisir un email valide</div>';  // donc la $erreur n'est plus vide !
    }
    
    if (iconv_strlen($_POST['pseudo']) < 5 || iconv_strlen($_POST['pseudo']) > 20) // on crochète l'indice pseudo
    {
        $erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
        Votre pseudo doit contenir entre 5 et 20 caractères</div>'; // idem
    }
   
    if (iconv_strlen($_POST['codepostal']) !== 5 || !is_numeric($_POST['codepostal']))  // ou is_string ou...
    {
        $erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
        Merci de saisir un code postal valide</div>';
    }
   
    if (!preg_match('#^[a-zA-Z0-9.-_]+$#', $_POST['prenom']))   // 
    {
        $erreur .= '<div style="background: red; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
        Merci de saisir un prenom valide</div>';    
    }
        /*
            ⚠️ preg_match() : expr° régulière REGEX est tjrs entourée de # pour préciser les opt° :
            (Effectue une recherche de corresp. avec une expression rationnelle standard)
            ^ = début de la chaine
            $ = fin de la chaine
            + = lettres autorisées peuvent apparaitre plusieurs fois
        */

    if(empty($erreur))  // Si elle est restée vide c ok ! > je lance boucle foreach 
    {
        foreach($_POST as $indice => $valeur)    
        {
        echo $indice . ' : ' . $valeur . '<br>'; 
        }   
        echo '<div style="background: green; padding: 10px; color: #fff; width: 200px; border-radius: 5px;">
        Inscritpion ok</div>';
    }
    echo $erreur;   // Pas oublier d'appeler message $erreur si pas bon !
}
?>
<!--
Réaliser un formulaire d'inscription avec les champs suivant : 
Pseudo, mdp, prenom, nom, email, adresse, cp, bouton submit
 - Contôler que l'on récupère en PHP toute les données saisies du formulaire
 - afficher au dessus les données du formulaire à l'aide d'un affichage conventionnelle 
 -->
<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>Formulaire 2</title>
        <style>
            label{
                float: left;
                width: 120px;
                font-style: italic;
                font-family: Calibri;
            }
        </style>
    </head>
    <body>
        <h1>Formulaire de connexion</h1>
        <hr>
        <form method="post" action=""> <!-- method : comment vont circuler les données , action : URL de destination -->

            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="pseudo"> <!-- l'attribut name est indispansable pour exploiter les données en PHP --> 
            <br><br>

            <label for="mdp">Mot de passe</label>
            <input type="text" id="mdp" name="mdp" placeholder="mot de passe">
            <br><br>
            
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="nom">
            <br><br>
            
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" placeholder="prenom"   >
            <!-- pattern="[a-zA-Z0-9.-_]" title="caractères acceptés : a-zA-z0-9.-_"  -->
            <br><br>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="email"> 
            <!-- Si on met type="email" > on peut modif dans inspecteur et ça pass !!
                 >>> sécu html pas top -->
            <br><br>
            
            <label for="adresse">Adresse</label>
            <textarea id="adresse" name="adresse"></textarea>
            <br><br>
            
            <label for="cp">Code postal</label>
            <input type="text" id="cp" name="codepostal" placeholder="code postal">
            <br><br>
            <input type="submit" value="inscritpion">
        </form>
    </body>
</html>


          
