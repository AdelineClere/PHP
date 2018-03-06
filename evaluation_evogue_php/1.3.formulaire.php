<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Formulaire</title>
    <style>
            label{
                float: left;
                width: 120px;
                font-family: Calibri;
            }
        </style>
  </head>
    
    
   
<body>
    <form method="post" action="affichage1.3.php" class="col-md-8 col-md-offset-2">
    <!-- ⚠️  method : comment vont circuler les données , action : ⚠️  ici par URL de destination -->
    
        <h1 class="alert alert-info text-center">Voiture</h1>

        <div class="form-group">
            <label for="marque">marque</label>
            <input type="text" class="form-control" id="marque" name="marque" placeholder="marque">
        </div><br>
        <div class="form-group">
            <label for="modele">modele</label>
            <input type="text" class="form-control" id="modele" name="modele" placeholder="modele">
        </div><br>
        <div class="form-group">
            <label for="couleur">couleur</label>
            <input type="text" class="form-control" id="couleur" name="couleur" placeholder="couleur">
        </div><br>
        <div class="form-group">
            <label for="poids">km</label>
            <input type="text" class="form-control" id="poids" name="poids" placeholder="poids">
        </div><br>
        <div class="form-group">
            <label for="carburant">carburant</label>
            <input type="text" class="form-control" id="carburant" name="carburant" placeholder="carburant">
        </div><br>
        <div class="form-group">
            <label for="annee">annee</label>
            <input type="text" class="form-control" id="annee" name="annee" placeholder="annee">
        </div><br>
        <div class="form-group">
            <label for="prix">prix</label>
            <input type="text" class="form-control" id="prix" name="prix" placeholder="prix">
        </div><br>
        <div class="form-group">
            <label for="puissance">puissance</label>
            <input type="text" class="form-control" id="puissance" name="puissance" placeholder="puissance">
        </div><br>
        <div class="form-group">
            <label for="options">options</label>
            <input type="text" class="form-control" id="options" name="options" placeholder="options">
        </div><br>
       
        <button type="submit" class="btn btn-primary col-md-12"> valider </a></button>



    </form>
</body>


</html>