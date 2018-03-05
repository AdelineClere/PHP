<?php
   
   
echo '<pre>'; print_r($_GET); echo '</pre>'; 




    if(isset($_GET['choix']) && ($_GET['choix'] == ['pizza']))
    {
        echo 'Vous avez choisi de manger une pizza';    
    }






    if(isset($_GET['pizza']))
    {
        echo 'Vous avez choisi de manger une pizza';
    }
    if(isset($_GET['salade']))
    {
        echo 'Vous avez choisi de manger une salade';
    }
    if(isset($_GET['viande']))
    {
        echo 'Vous avez choisi de manger une viande';
    }
    if(isset($_GET['poisson']))
    {
        echo 'Vous avez choisi de manger un poisson';
    }


?>



