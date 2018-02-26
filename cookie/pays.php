<h1>Votre langue :</h1>
<ul>
    <li><a href="?pays=fr">France</a></li>   <!-- ⚠️  ?pays=fr -> envoie l'info dans url -->
    <li><a href="?pays=es">Espagne</a></li>
    <li><a href="?pays=an">Angleterre</a></li>
    <li><a href="?pays=it">Italie</a></li>
</ul>

<?php

if(isset($_GET['pays']))  // ⚠️  si un pays est passé dans url c'est que nous avons cliqué sur un lien
{
    $pays = $_GET['pays'];   // ⚠️  alors je vais stocker l'info dans une variable
}
elseif(isset($_COOKIE['pays']))   // on ne rentre ds elseif uniqut si cond° if n'est pas passée et qu'un cookie existe déjà
// ex : on rentre ds cette condition si je reviens sur site 15 jrs plus tard
{
    $pays = $_COOKIE['pays'];
}
else   // ⚠️  sinon = 1ère fois sur site, pas encore de cookie créé > va être créé
{
    $pays = 'fr';
}

/*
Un cookie est sauvegardé sur PC internaute et on y mettra infos d'importance mineure, des pref., traces de visite :
ex : pour vous proposez des suggestions de shoes ds le même modèle de dernière shoes que vous avez regardé sur une boutiq.
Packe le cookie est directt conservé sur le PC d'internaute et qu'il peut se le faire voler, nous ne mettrons pas des infos
comme pseudo et mdp.
*/

echo time() . '<br>';
$un_an = 365*24*3600;  // ⚠️  sec/an (on créé cette variable)
setCookie("pays", $pays, time()+$un_an);
// Dans tous les cas un cookie est créé car ce morceau de code n'est pas dans une condition.
// ⚠️ setCookie() permet de créer un cookie : setCookie("nom", "valeur", durée de vie"  (= maintenant + 1 an)

switch($pays)
{
    case 'fr':
    echo 'Bonjour vous êtes sur un site en français';
    break;

    case 'es':
    echo 'Bonjour vous êtes sur un site en espagnol';
    break;

    case 'an':
    echo 'Bonjour vous êtes sur un site en angleterre';
    break;
    
    case 'it':
    echo 'Bonjour vous êtes sur un site en italien';
    break;
}


/*
 vérif création du cookie > Goog Chrome > param > param avancés / vider tout > cookie > afficher tous
 (⚠️ créé & conservé côté navigateur = client dc)
 - même sans cliquer sur un lien (=> condition else lg 20)  >>> cookie créé (par défaut 'fr' dc)
 - ⚠️ si on clic sur un lien > contenu cookie change ...
?>
*/