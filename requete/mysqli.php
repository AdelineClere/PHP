<?php

$mysqli = new Mysqli('localhost', 'root', '', 'entreprise');
// $mysqli représente un objet de la classe Mysqli. On parle d'instanciation. Cette objet représente en réalité notre connexion à la BDD. 
// Pour créer une instance de la classe Mysqli on a besoin de 4 arguments : 
/*
	1: serveur de BDD
	2: Login
	3: password
	4: Nom de la BDD
*/
 
// echo '<pre>'; 
// var_dump($mysqli);
// echo '</pre>';
// $mysqli est bien le premier objet de la classe Mysqli. 
// Un objet contient des propriétés (variables) et des méthodes (fonctions). 
/*
L'objet $mysqli contient une méthode query() qui va nous permettre de faire des requêtes SQL auprès de la base de  donnée. 

valeurs de retour : 
	
	- SELECT/SHOW : 
		succès : Mysqli_result (OBJ)
		echec : FALSE (BOOL)
	
	- INSERT/REPLACE/UPDATE/DELETE : 
		succès : TRUE (BOOL)
		echec : FALSE (BOOL)
*/


//0 : Erreur volontaire
//$mysqli -> query("qsdqsdqsdqsd") or die('Erreur SQL :<br/>' . $mysqli -> error); 
// les erreur SQL ne s'affichent pas !
// echo $mysqli -> error; 
// La propriété error de notre objet $mysqli nous permet d'afficher les erreur SQL s'il y a. 


//1 : Requete INSERT (DELETE, UPDATE, REPLACE)
$mysqli -> query("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES ('toto', 'tata', 'm', 'informatique', 1500, CURDATE())"); 

echo 'Nombre de lignes affecté(s) par la requête : ' . $mysqli -> affected_rows . '<br/>'; 

//2 : Requête SELECT (1 résultat)

$resultat = $mysqli -> query("SELECT * FROM employes WHERE id_employes = 9");
// Pour les requêtes SELECT et SHOW on doit stocker le résultat de la requête dans une variable. 

echo '<pre>'; 
print_r($resultat);
echo '</pre>';
// $resultat est un objet de la classe Mysqli_result. Dommage nous savons travailler avec des ARRAY mais pas avec des objets. 
// En l'état il INEXPLOITABLE !!!! 

$employe = $resultat -> fetch_assoc(); 

echo '<pre>'; 
print_r($employe);
echo '</pre>';

echo 'Bonjour ' . $employe['prenom'] . ' !<br/>';

//La méthode fetch_assoc() de l'objet $resultat issu de la classe Mysqli_result, va indéxer les résultats de la requête sous forme d'un array. 
// Fetch_assoc() : array indéxé de manière associative (les nom des champs dans la BDD deviennent les indices de notre array).
// Fetch_row() : array indéxé de manière numérique
// fetch_array() : array indéxé à la fois numériquement et associativement. 


//3 : Requête SELECT (plusieurs résultats)

$resultat = $mysqli -> query("SELECT * FROM employes");

// $resultat : OBJ de la classe Mysqli_resultat. En l'état il est INEXPLOITABLE !! 
echo 'Nbre d\'enregistrement : ' . $resultat -> num_rows . '<br/>';
while($employes = $resultat -> fetch_assoc()){
	// echo '<pre>'; 
	// print_r($employes);
	// echo '</pre>';
	
	echo '<h3>Employé numéro : ' . $employes['id_employes'] . '</h3>';
	echo 'Prénom : ' . $employes['prenom'] . '<br/>'; 
	echo 'Salaire : ' . $employes['salaire'] . '€<hr/>'; 
}

// fetch_assoc() nous fait UN ARRAY PAR ENREGISTREMENT et non pas un array pour tous les enregistrements. Donc on doit OBLIGATOIREMENT le faire dans une boucle While. 
// La boucle While se comporte comme un curseur qui va parcourir tous les enregistrements pendant que fetch_assoc créé un tableau pour chacun. 

//Si la requête sort un seul résultat = PAS DE BOUCLE
//Si la requête sort plusieurs résultats = BOUCLE
//Si la requête doit sortir un seul enregistrement mais peut-être plusieurs : UNE BOUCLE ! 


//4 : Copie d'une table SQL en tableau HTML

$resultat = $mysqli -> query("SELECT * FROM employes");


echo '<table border="1">';

//On va d'abord afficher la ligne des titres (des champs) : 
echo '<tr>'; 
while($champs = $resultat -> fetch_field()){ // Cette boucle while va tourner tant qu'elle trouve des champs dans notre table SQL, et grâce à fetch_field() elle va nous récupérer les infos de chaque champs dans un objet $champs. Ce qui nous interesse nous c'est $champs -> name qui nous retourne le nom de chaque champs. 
	//var_dump($champs);
	echo '<th>' . $champs -> name  . '</th>';
}
echo '</tr>';
while($infos = $resultat -> fetch_assoc()){ // Cette boucle va tourner autant de fois qu'il y a des résultats dans ma requête.
	echo '<tr>'; // ON créé une ligne pour chaque enregistrement. 
	
	// ensuite je souhaite créer une cellule pour chaque info de chaque enregistrement... 
	foreach($infos as $indice => $valeur){
		// Cette boucle foreach, parcourt chaque information de l'enregistrement dans lequel nous sommes et les affiche un TD
		echo '<td>' . $valeur . '</td>';
	}
	echo '</tr>'; 
}
echo '</table>'; 












echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';




