<!--
    On récup les infos saisies dans formulaire3 !
-->

<?php
if($_POST)  // -> pour pas avoir message d'erreur
{
    echo '<pre>'; print_r($_POST); echo '</pre>'; 

    foreach($_POST as $indice => $valeur)
    {
        echo $indice . ' : ' . $valeur . "<br>";
    }

    // Ecriture dans un fichier créé dynamiquement (ex : recup email saisis ds form. > vers fichier.txt)
    // Les fonctions prédéfinies suivantes permettent d'écrire dynamiqt ds un fichier : ⚠️ fopen(), fwrite(), fclose()

    $fichier = fopen("liste.txt", "a"); // -> ⚠️ a créé le fichier liste.txt dans notre dossier !!
                                // ⚠️ a ?????

        fwrite($fichier, $_POST['pseudo'] . ' - ' . $_POST['email'] . "\r\n" );
        fclose($fichier);            
}

// (Séquences d'échappement)


?>