<?php
session_start();
// lorsque j'effectue un session_start() ⚠️ session pas recrée car elle existe déjà 
// (grace au session_start() lancé ds le fichier session1)

echo '<pre>'; print_r($_SESSION); echo '</pre>';
// on retrouve infos sessions 1 <=> ⚠️ on est tjrs sur même session en fait



/*
⚠️ Les infos d'une session sont enregistrées ds la session côté serveur, cela créé ⚠️ un cookie précisément 
à l'identifiant de la session, sur le PC du client
(-> cf "cn4lai2123e61b9t306cf3l1fp ds cookies !)
Il ne pourra pas être modifié par l'internaute car c'est 1 fichier enregistré directt sur le serveur.
⚠️ Les sessions permettent d'avoir une connexion constante à un site, sans elles on ne pourrait pas naviguer
sur le site, on serait constamment déconnecté.
*/


?>