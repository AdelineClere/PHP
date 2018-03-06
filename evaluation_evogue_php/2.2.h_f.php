<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>H_F</title>

    </head>


    <?php

    echo '<pre>'; print_r($_GET); echo '</pre>'; 

    
    if(isset($_GET['femme']))
    {
        echo 'Vous êtes une femme';
    }
    else
    {
        echo 'Vous êtes un homme';
    }

    ?>



    <body>
        <h1>H/F</h1>
            <div>
                <a href="?femme">Femme</a><br>
                <a href="?homme">Homme</a><br>
            </div>
    </body>
</html>