<!--
    Récupérer en les affichant les infos saisies directement sur la pg formulaire4.php grâce à action ! 
-->


<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>Formulaire 3</title>
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
        <h1>Formulaire 3</h1>
        <hr>
        <form method="post" action="formulaire4.php"> <!-- method : comment vont circuler les données , action : URL de destination -->

            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
            <br><br> 

            <label for="email">Mot de passe</label>
            <input type="text" id="email" name="email" placeholder="email">
            <br><br>
            <input type="submit" value="envoi">
        </form>
    </body>
</html>