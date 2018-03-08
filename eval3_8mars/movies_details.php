<?php

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

//------------- affiche détail film 


if(isset($_GET['id_movie']))       // ⚠on récup quel film dans l'url
{
    echo '<pre>'; print_r($_GET); echo '</pre>'; 

    $resultat = $pdo->query("SELECT * FROM movies WHERE id_movie = $_GET[id_movie]");

    $film = $resultat->fetch(PDO::FETCH_ASSOC);
    
    echo '<pre>'; print_r($_film); echo '</pre>';

    /*
    while($film = $resultat->fetch(PDO::FETCH_ASSOC));  
    {
    echo '<pre>'; print_r($film); echo '<pre>';    
    foreach($film as $indice => $valeur) 
    {
        echo $indice . ' : ' . $valeur . '<br>';   
    }
    echo '<hr>';
    }
    */


    foreach ($id_movie as $indice => $valeur)
    echo $indice . ' = ' . $valeur . '<br>';
}











/*
//------------- affiche détail film et modif

if(isset($_GET['action']) && $_GET['action'] == 'informations')  // 
{        
    if(isset($_GET['id_movie']))  // <=> c une MODIF
    {
        $resultat = $pdo->prepare("SELECT * FROM movies WHERE id_movie = :id_movie");
        $resultat->bindValue(':id_movie', $_GET['id_movie'], PDO::PARAM_INT);
        $resultat->execute();

        $film_choisi = $resultat->fetch(PDO::FETCH_ASSOC);
          // => fetch pr obtenir tablo new pdt
          //debug($membre_actuel);
    }
    
/*
    // si id_movie est défini ds BDD > on l'affiche sinon > on aff chaine de caract vide !
    $id_movie = (isset($film_choisi['id_movie'])) ? $film_choisi['id_movie'] : '';
    $title = (isset($film_choisi['title'])) ? $film_choisi['title'] : ''; 
    $actors = (isset($film_choisi['actors'])) ? $film_choisi['actors'] : ''; 
    $director = (isset($film_choisi['director'])) ? $film_choisi['director'] : ''; 
    $producer = (isset($film_choisi['producer'])) ? $film_choisi['producer'] : ''; 
    $year_of_prod = (isset($film_choisi['year_of_prod'])) ? $film_choisi['year_of_prod'] : ''; 
    $language = (isset($film_choisi['language'])) ? $film_choisi['language'] : ''; 
    $category = (isset($film_choisi['category'])) ? $film_choisi['category'] : ''; 
    $storyline = (isset($film_choisi['storyline'])) ? $film_choisi['storyline'] : ''; 
    $video = (isset($film_choisi['video'])) ? $film_choisi['video'] : '';

          
    echo '  <form method="post" action="" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
                <h1 class="alert alert-info text-center">' . ($_GET['action']) . '</h1>
                <input type="hidden" class="form-control" id="id_membre" name="id_membre" placeholder="id_movie" value="' . $id_movie . '" >
                
                <form method="post" action="" class="col-md-8 col-md-offset-2">
                    <h1 class="alert alert-info text-center">Enregistrement de film</h1>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" value="' . $title . '">
                    </div><br>
                    <div class="form-group">
                        <label for="actors">Actors</label>
                        <input type="text" class="form-control" id="actors" name="actors" placeholder="actors" value="' . $actors . '">
                    </div><br>
                    <div class="form-group">
                        <label for="director">Director</label>
                        <input type="text" class="form-control" id="director" name="director" placeholder="director" value="' . $director . '">
                    </div><br>
                    <div class="form-group">
                        <label for="producer">Producer</label>
                        <input type="text" class="form-control" id="producer" name="producer" placeholder="producer" value="' . $producer . '">
                    </div><br>
                    <div class="form-group">
                        <label for="year_of_prod"> Year of prod</label>
                        <input id="date" type="month" name="date" value="' . $email . '">
                    </div><br>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select class="form-control" id="language" name="language">
                            <option value="anglais"'; if($language == 'anglais') echo 'selected'; echo '>Anglais</option>
                            <option value="français"'; if($language == 'français') echo 'selected'; echo '>Français</option>
                            <option value="espagnol"'; if($language == 'espagnol') echo 'selected'; echo '>Espagnol</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="comedy"'; if($category == 'comedy') echo 'selected'; echo '>Comedie</option>
                            <option value="thriller"'; if($category == 'thriller') echo 'selected'; echo '>Thriller</option>
                            <option value="drame"'; if($category == 'drame') echo 'selected'; echo '>Drame</option>
                            <option value="horreur"'; if($category == 'horreur') echo 'selected'; echo '>Horreur</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="storyline">Storyline</label>
                        <textarea class="form-control" rows="3" id="storyline" name="storyline" value="' . $storyline . '"></textarea>
                    </div><br>
                    <div class="form-group">
                        <label for="video">Video</label>
                        <input type="text" class="form-control" id="video" name="video" placeholder="video" value="' . $video . '">
                    </div><br>
                
                <button type="submit" class="btn btn-primary col-md-12">Valider modification</button>
            </form>';

}
*/
?>