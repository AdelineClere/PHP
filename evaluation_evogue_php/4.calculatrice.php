



<form method="post" action=""> 
    <div class="form-group">
        <label for="nb1">Entrez un nombre</label>
        <input type="text" class="form-control" id="nb1" name="nb1" placeholder="nb1">
    </div>
    <div class="form-group">
        <select class="form-control" name="choix">
            <option value="adition">+</option>
            <option value="soustraction">-</option>
            <option value="multiplication">*</option>
            <option value="division">/</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nb2">Entrez un nombre</label>
        <input type="number" class="form-control" id="nb2" name="nb2" placeholder="nb2">
    </div>
    <button type="submit" class="btn btn-primary col-md-12">calculer</button>
    <input type="reset" value="effacer"><br>
</form>


<?php

if(isset($_POST['nb1']) && (isset($_POST['nb2']))) 
{

    $nb1 = $_POST['nb1'];
    $nb2 = $_POST['nb2'];
    $choix = $_POST['choix'];

   
    switch($choix)
    {
        case 'adition':
        echo 'Résultat = ' . ($nb1+$nb2);
        break;

        case 'soustraction':
        echo 'Résultat = ' . ($nb1-$nb2);
        break;

        case 'multiplication':
        echo 'Résultat = ' . ($nb1*$nb2);
        break;

        case 'division':
        echo 'Résultat = ' . ($nb1/$nb2);
        break;

        default:
        echo '';
        break;
    } 
}

?>


  




