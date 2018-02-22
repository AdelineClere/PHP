<?php
require_once("inc/header.php");
require_once("inc/nav.php");
/*
require_once() && include_once() :
Aucune différence entre les 2 sauf en cas d'erreur sur le nom de fichier :
    - include fait une erreur et continue l'exécution du script
    - require fait une erreur et stop l'exécution du script
Le once vérifie si le fichier a déjà été inclus, si c'est le cas, il ne le ré-inclut pas.
*/
?>

    <section>
        Voici le contenu de la page d'accueil<br>
        Voici le contenu de la page d'accueil<br>
        Voici le contenu de la page d'accueil<br>
        Voici le contenu de la page d'accueil<br>
        Voici le contenu de la page d'accueil<br>    
    </section>
    
<?php
require_once("inc/footer.php");
?>