<?php
/*
    EXO : Améliorer le formulaire5.php : 
        1 - procéder au changement permettant d'être l'unique destinataire du message >>> suppr champ 'Destinataire
        2 - Ajouter les champs : Société, Nom, Prénom. 
        3 - Ajouter au corps du message : Nom, prenom, société, message.
*/

if($_POST)
{
    $_POST['email'] = "From: $_POST[expediteur] \n";    // toujours FROM!!
    $_POST['email'] .= "MIME-Version: 1.0 \r\n";  
    $_POST['email'] .= "Content-type: text/html; charset=utf8 /r/n";


    $_POST['message'] = "Nom : " . $_POST['nom'] . "\nPrénom : " . $_POST['prenom'] . 
    "\nSociété : " . $_POST['societe'] . "\nMessage : " . $_POST['message'];

    // on pointe champ message pour le modifier : comme le bloc en fin de mail :
    //   ------- message de ---------
    //   Expéditeur etc...


    $email = "glx78@free.fr";
    mail($email, $_POST['destinataire'], $_POST['sujet'], $_POST['message'], $_POST['expéditeur']);

}
?>

<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>Formulaire 6</title>
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
        <h1>MAIL</h1>
        <hr>
        <form method="post" action="">  
            
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="nom">
            <br><br>

            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="nprenomom" placeholder="prénom"> 
            <br><br>

            <label for="societe">Société</label>
            <input type="text" id="societe" name="societe" placeholder="Societe">
            <br><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email">
            <br><br>

            <label for="sujet">Sujet</label>
            <input type="text" id="sujet" name="sujet" placeholder="sujet">
            <br><br>
                                    
            <label for="message">Message</label>
            <textarea id="message" name="message"></textarea>
            <br><br>

            <input type="submit" value="envoi">
        </form>
    </body>
</html>