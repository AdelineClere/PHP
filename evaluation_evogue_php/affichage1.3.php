<?php
    

    if($_POST)  // ⚠️ si je clique sur le bouton valider alors on rentre dans le if
    {
        // echo '<pre>'; print_r($_POST); echo '</pre>'; 
    
        foreach($_POST as $indice => $valeur)
        {
            echo $indice . ' : ' . $valeur . "<br>";
        }    
    }


    
?>



