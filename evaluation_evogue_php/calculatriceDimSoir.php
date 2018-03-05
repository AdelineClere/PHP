<?php



if($_POST)  
{

$nb1 = $_POST['nb1'];
$nb2 = $_POST['nb2'];
$choix = $_POST['choix'];

function adition($nb1, $nb2) 
    {
        return $nb1+$nb2;
    }
echo adition($nb1, $nb2) . "<br>";   


    if($nb1 != 0 && $nb2 != 0)
    {
        if($choix = 'division' && $nb2 = 0)
        {
            echo 'On ne peut pas diviser par 0';
        }
        else
        {
           if($choix = 'addition')
           {
               echo adition($nb1+$nb2);
           }
        }
    }
    else
    {
        echo 'Veuillez renseigner tous les champs';
    }

    

}



?>

<form method="post" action=""> 
    <div class="form-group">
        <label for="nb1">Entrez un nombre</label>
        <input type="text" class="form-control" id="nb1" name="nb1" placeholder="nb1">
    </div>
    <div class="form-group">
        <select class="form-control" name="choix">
            <option value="+">adition</option>
            <option value="-">soustraction</option>
            <option value="*">multiplication</option>
            <option value="/">division</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nb2">Entrez un nombre</label>
        <input type="number" class="form-control" id="nb2" name="nb2" placeholder="nb2">
    </div>
    <button type="submit" class="btn btn-primary col-md-12">calculer</button>
    <input type="reset" value="effacer"><br>
</form>





    echo '<pre>'; print_r($_POST); echo '</pre>';
    echo calculatrice($_POST['nb1'], $_POST['nb2']);




