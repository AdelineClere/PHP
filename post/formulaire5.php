<!--
    Faire notre controle une fois le html écrit:
-->
<?php
echo '<pre>'; print_r($_POST); echo '</pre>'; 
if($_POST)
{
// On va modifier l'entête mail :
    $_POST['expediteur'] = "From: $_POST[expediteur] \n";   // !!! JAMAIS de '' pour 2è [expéditeur]
    $_POST['expediteur'] .= "MIME-Version: 1.0 \r\n";     // ligne OBLIGATOIRE
    $_POST['expediteur'] .= "Content-type: text/html; charset=utf8 /r/n";
    // ⚠️ MIME (Multipurpose Internet Mail Extensions) est un standard qui a été proposé par les laboratoires Bell Communications en 1991 afin 
    //    d'étendre les possibilités limitées du courrier électronique (mail) et notamment de permettre d'insérer des documents (images, sons, texte, ...) dans un courrier. Il est défini à l'origine par les RFC 1341 et 1342 datant de juin 1992.
    // ⚠️ Content-type: text/html = permet d'envoyer du HTML direct ds le message, il sera traduit, 
    //    pratique pr envoi d'une Newsletter

    mail($_POST['destinataire'], $_POST['sujet'], $_POST['message'], $_POST['expéditeur']);
    // ⚠️ La fct mail() reçoit tjrs 4 ARGUMENTS et l'ordre a une importance cruciale.
    // Comme la plupart des fct qd il faut respecter le NOLBRE et l'ORDRE des arguments que l'on transmet.
}
?>




<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>Formulaire 5</title>
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

            <label for="destinataire">Destinataire</label>
            <input type="text" id="destinataire" name="destinataire" placeholder="destinataire"> 
            <br><br>

            <label for="expediteur">Expéditeur</label>
            <input type="text" id="expediteur" name="expediteur" placeholder="expéditeur">
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