<?php
    /*
        EXO : 
        1 - réaliser un formulaire permettant de sélectionner un fruit et saisir un poids
        2 - réaliser le traitement permettant d'afficher le prix en passant par la fct déclarée "calcul"
        3 - Faire en sorte de garder le dernier fruit sélectionné et le dernier poids saisi 
        dans le formulaire s'il est validé
    */


    
require_once("fonction.inc.php");
if($_POST)      // on récup données choisies
{
    echo '<pre>'; print_r($_POST); echo '</pre>';
    echo calcul($_POST['fruit'], $_POST['poids']);  // affiche le prix calculé
}



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Formulaire</title>
        <style>
            label{
                float: left;
                width: 120px;
                font-style: italic;
            }
        </style>

    </head>
    <body>
        <h1>Formulaire calcul fruits</h1>
        <hr>
        <form method="post" action=""> 
        <!-- method = comment vont circuler les données, action : url de destination -->
            <label for="fruit">Fruit</label>
                <select name='fruit'>   <!-- garde le fruit choisi affiché -->
                    <option value="cerises"<?php if(isset($_POST['fruit']) && $_POST['fruit'] == 'cerises' ) echo "selected";?>>
                    Cerises</option>    
                    <option value="bananes"<?php if(isset($_POST['fruit']) && $_POST['fruit'] == 'bananes' ) echo "selected";?>>
                    Bananes</option>
                    <option value="=pommes"<?php if(isset($_POST['fruit']) && $_POST['fruit'] == 'pommes' ) echo "selected";?>>
                    Pommes</option>
                    <option value="peches"<?php if(isset($_POST['fruit']) && $_POST['fruit'] == 'peches' ) echo "selected";?>>
                    Pêches</option>
                </select><br><br>

                <label for "poids">Poids</label>
                <input type="text" id="poids" name="poids" value="<?php if(isset($_POST['poids'])) echo $_POST['poids']; ?>"
                placeholder="poids"><br><br>  <!-- garde le poids choisi affiché -->

                <input type="submit" value="calculer">
        </form>
    </body>
</html>