<?php
    /*
    EXO : Espace de dialogue
        1.  Modélisation et création (=> on peut la créer par console ou directt sur php/myadmin)
            BDD   : tchat
            table : commentaire
                    id_commentaire          // INT(11) PK - AI (PK = clé primaire - AI = auto-incrémenté)
                    pseudo                  // VARCHAR(20)
                    message                 // TEXT
                    date d'enregistrement   // DATETIME
        2. Connexion à la BDD
        3. Création du formulaire HTML (pour l'ajout de messages)
        4. Contrôle de récupération des données saisiees en PHP
        5. Requête SQL d'enregistrement
        6. Affichage des messages (date au format français)
    */


// Réponse 2 (On se connecte à la BDD 'tchat')
$pdo = new PDO('mysql:host=localhost;dbname=tchat', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
));

// Réponse 4
echo '<pre>'; print_r($pdo); echo'</pre>';

// Réponse 5
if($_POST)  // on a soumis le formulaire => values stockées ds superglobal $_POST
{
        // ⚠️ Pour suppr balises xss ou injections SQL (=> dbl sécurité)
            foreach($_POST as $indice => $valeur)   // parcourt ttes les valeurs du ARRAY superglobal POST
// indice = pour chaq tour de boucle, prend indice pseudo (tour 1), message (tour 2)..., $valeur va avoir a2L (tour 1), le contenu message (tour 2), ... etc.

                {
                    $_POST[$indice] = htmlspecialchars(strip_tags($valeur));  // on exécute ces fcts sur les val lues ds boucle foreach
                //    $_POST[$indice] = htmlspecialchars($valeur);
                //    $_POST[$indice] = htmlentities($valeur);
                }

    /* Le plus 'simple' mais NON :
        $resultat = $pdo->exec("INSERT INTO commentaire(pseudo, dateEnregistrement, message) VALUES('$_POST[pseudo]', 
        NOW(), '$_POST[message]')";);  
    */

    /*  ⚠️ On peut stocker requête ds une variable, puis on l'exécute :
        $req = "INSERT INTO commentaire(pseudo, dateEnregistrement, message) VALUES('$_POST[pseudo]', NOW(), '$_POST[message]')";
        $resultat = $pdo->exec($req);  
        echo $req;
    */

    // ⚠️ On prépare la requête (=> marqueurs nominatifs) pour éviter les injections SQL ou XSS ⚠️
    $resultat = $pdo->prepare("INSERT INTO commentaire (pseudo, dateEnregistrement, message) 
    VALUES (:pseudo, NOW(), :message)");

    $resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat->bindvalue(':message', $_POST['message'], PDO::PARAM_STR);

    $resultat->execute();
}
        // ⚠️ Préparer la requête SQL permet d'éviter les injections SQL qui détournent le comportement initial de la requête.
        // ⚠️ Les marqueuers nomin. peuvent se comparer à des boîtes où sont stockées les données
        // ⚠️ htmlspecialchars() permet de rendre innofensives les balises HTML
        // ⚠️ htmlentities() permet de convertir les caractères éligibles en entités HTML
        // ⚠️ strip_tags() permet de suppr les balises HTML


// Réponse 6
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(dateEnregistrement, '%H:%i:%s') AS heurefr,  DATE_FORMAT(dateEnregistrement, '%d:%m:%Y') AS datefr FROM commentaire ORDER BY dateEnregistrement DESC"); 
// On pointe sur methode query car requête de selection
echo '<legend><h2>' . $resultat->rowCount() . ' commentaire(s)</h2></legend>';



while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC))   // pr chaq tour elle a tt le contenu de chaq comm
{
    // echo '<pre>'; print_r($commentaire); echo'</pre>';
    echo '<div class="message">';
        echo '<div class="titre">Par : ' . $commentaire['pseudo'] . ', le ' . $commentaire['datefr'] . 'à ' . $commentaire['heurefr'] . '</div>';
        echo '<div class="contenu">' . $commentaire['message'] . '</div>';
    echo '</div><hr>';
       // on peut aussi faire une boucle foreach ds le while
}

?>

<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>Tchat</title>
        <link rel="stylesheet" href="style.css">
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
        <h1>Tchat</h1>
        <hr>
        <form method="post" action="">  
            
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="pseudo"><br><br>

            <label for="message">Message</label>
            <textarea id="message" name="message"></textarea><br><br>

            <input type="submit" value="publier">

        </form>
    </body>
</html>



<!-- foreach = 