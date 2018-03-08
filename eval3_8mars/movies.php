<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Formulaire</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet"> 
        <style>
            label{
                float: left;
                width: 120px;
                font-family: Calibri;
            }
            .formulaire {
                border: 1px;
            }
        </style>
    </head>
    <body>
        <div class="container mon-contener">

<?php

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

echo '<pre>'; var_dump($pdo); echo '</pre>';

// debug();  éviter de faire tt le temps des print_r
function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px;">'; 
    $trace = debug_backtrace(); 
    $trace = array_shift($trace);  
    echo "Debug demandé dans le fichier : $trace[file] à la lg $trace[line] . <hr>";
    echo '</div>';
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}


/* AFFICHER contenu movies */
// debug($_POST);


/* VERIF données saisies / AJOUT */

$content = ''; 

if($_POST)
{
    $erreur = '';

        if(strlen($_POST['title']) < 5)
        {
            $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille titre non valide !</div>';
        }
        if(strlen($_POST['actors']) < 5)
        {
            $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille titre non valide!!</div>';
        }
        if(strlen($_POST['producer']) < 5)
        {
            $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille titre non valide !</div>';
        }
        if(strlen($_POST['storyline']) < 5)
        {
            $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">Taille titre non valide !</div>';
        }
        // Vérifie si la chaîne est une URL
        if (!filter_var($_POST['video'], FILTER_VALIDATE_URL))
        {
            $erreur .= '<div class="alert alert-danger col-md-8 col-md-offset-2 text-center">URL non valide !</div>';
        } 
 
       $content .= $erreur;


        if(empty($erreur)) // si 0 $erreur > insérer ds table 
        {     
            $resultat = $pdo->exec("INSERT INTO  movies(title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES ('$_POST[title]', '$_POST[actors]','$_POST[director]','$_POST[producer]','$_POST[year_of_prod]','$_POST[language]','$_POST[category]','$_POST[storyline]','$_POST[video]')");

    echo '<div style="background: green; color: #fff; padding: 10px; text-align: center; border-radius: 5px; width: 
    200px;">Enregistrement OK !!</div>';

    echo "Nombre d'enregistrement affecté par l'insert : $resultat" . '<br>';  
    
    
        /*  AJOUT avec préparation  
            $resultat = $pdo->prepare("INSERT INTO movies(title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES (:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)");
            // ️associer une valeur aux marqueurs
            $resultat->bindValue(':title', $_POST['title'], PDO::PARAM_STR);  
            $resultat->bindValue(':actors', $_POST['actors'], PDO::PARAM_STR);
            $resultat->bindValue(':director', $_POST['director'], PDO::PARAM_STR);
            $resultat->bindValue(':producer', $_POST['producer'], PDO::PARAM_STR);
            $resultat->bindValue(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_STR);
            $resultat->bindValue(':language', $_POST['language'], PDO::PARAM_STR);
            $resultat->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
            $resultat->bindValue(':storyline', $_POST['storyline'], PDO::PARAM_STR);
            $resultat->bindValue(':video', $_POST['video'], PDO::PARAM_STR);
            $resultat->execute(); 
            
            // inscription ok 
            $content .='<div class="alert alert-succes col-md-8 col-md-offset-2 text-center">Film enregistré ! <br></div>';
        */    
        }
}
echo $content;  




// AFFICHER la liste des films
$content = '';

$resultat = $pdo->query("SELECT id_movie, title, director, year_of_prod FROM movies");   // => objet class PDOStatement
    $content .= '<div class="col-md-10 col-md-offset-1 text-center"><h3 class="alert alert-success"> Liste des films enregistrés </h3>';
    $content .= 'Nombre de film(s) enregistrés : <span class="badge text-danger">' . $resultat->rowCount() . '</span></div>';

        $content .= '<table class="col-md-10 table" style="margin-top: 15px;"><tr>';
            for($i = 0; $i < $resultat->columnCount(); $i++)
            // retourne NB de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle.
            {
                $colonne = $resultat->getColumnMeta($i);
                // retourne INFOS des champs/colonnes à chq tour $colonne contient un ARRAY des infos d'une colonne.
        
                $content .= '<th>' . $colonne['name'] . '</th>';
                // crocheter à l'indice 'name' pour afficher le nom des colonnes => 1ère lg
            }

            $content .= '<th> Plus d\'infos </th>';
            $content .= '</tr>';
        
            while($ligne = $resultat->fetch(PDO ::FETCH_ASSOC)) 
            {
                $content .= '<tr>';
                    foreach($ligne as $indice => $valeur)  // parcourt chq tablo de chq pdt
                    {                       
                        $content .= '<td>' . $valeur . '</td>';
                    }                      
                   
                    $content .= '<td class="text-center">
                                <a href="movies_details.php?id_movie=' . $ligne['id_movie'] . '">
                                <span class="glyphicon glyphicon-plus text-center"></span>
                                </a></td>';     

                    $content .= '</tr>';
                }           
        $content .= '</table>';


echo $content;



?>





    <!-- formulaire films -->
    <form method="post" action="" class="col-md-8 col-md-offset-2">
        <h1 class="alert alert-info text-center">Enregistrement de film</h1>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="title">
        </div><br>
        <div class="form-group">
            <label for="actors">Actors</label>
            <input type="text" class="form-control" id="actors" name="actors" placeholder="actors">
        </div><br>
        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" class="form-control" id="director" name="director" placeholder="director">
        </div><br>
        <div class="form-group">
            <label for="producer">Producer</label>
            <input type="text" class="form-control" id="producer" name="producer" placeholder="producer">
        </div><br>
        <div class="form-group">
            <label for="year_of_prod"> Year of prod</label>
            <input id="date" type="month" name="date">
        </div><br>
        <div class="form-group">
            <label for="language">Language</label>
            <select class="form-control" id="language" name="language">
                <option value="anglais">Anglais</option>
                <option value="français">Français</option>
                <option value="espagnol">Espagnol</option>
            </select>
        </div><br>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <option value="comedy">Comedie</option>
                <option value="thriller">Thriller</option>
                <option value="drame">Drame</option>
                <option value="horreur">Horreur</option>
            </select>
        </div><br>
        <div class="form-group">
            <label for="storyline">Storyline</label>
            <textarea class="form-control" rows="3" id="storyline" name="storyline"></textarea>
        </div><br>
        <div class="form-group">
            <label for="video">Video</label>
            <input type="text" class="form-control" id="video" name="video" placeholder="video">
        </div><br>

        <button type="submit" class="btn btn-primary col-md-12"name="enregistrement">Enregistrement</button>
    </form>

    </div>
</body>
</html>