<?php
echo '<h2>01. PDO : Connexion BDD </h2>';
/****************************************/
// ⚠️ PDO = une classe qui instancie $pdo - Ici que l'on modifie BDD qd on créé un site qui en a une (⚠️ ⚠️ ⚠️ 'root' en mdp sur Mac)
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO :: ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
));
// arguments : 1 (serveur + bdd), 2 (identifiant), 3 (mdp), 4 (options)


echo '<pre>'; var_dump($pdo); echo '</pre>';
// ⚠️ $pdo représente un OBJET issu de la classe PDO ⚠️ = instance de la classe PDO. Il représente notre BDD.
// Créer une instance de PDO nécessite de fournir en arguments les informations de connexion à la BDD. 
// et de pvr formuler des requêtes SQL.
        /*  object(PDO)#1 (0) {
            }   */
/*
Cette class possède ses propres propriétés et méthodes = ⚠️ class déjà instanciée :
La classe PDO contient plusieurs méthodes permettant d'effectuer des requêtes à la BDD (query(), exec(), prepare(), execute()).
*/

echo '<pre>'; print_r(get_class_methods($pdo)); echo'</pre>';
//⚠️ get_class_methods = fct° PREDEFINIE pour afficher les méthodes issues de la classe PDO via l'objet $pdo ⚠️ 
        /*  Array
            (
                [0] => __construct
                [1] => prepare
                [2] => beginTransaction
                [3] => commit
                [4] => rollBack
                [5] => inTransaction
                [6] => setAttribute
                [7] => exec  ⚠️ 
                [8] => query ⚠️ 
                [9] => lastInsertId
                [10] => errorCode
                [11] => errorInfo
                [12] => getAttribute
                [13] => quote
                [14] => __wakeup
                [15] => __sleep
                [16] => getAvailableDrivers
            )   */

            

echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>02. PDO : EXEC - INSERT, UPDATE, DELETE </h2>';
//------------------------------------------------------------------------------------------------------------
// Formuler une requête pour vous insérer dans la table employes
/*
⚠️  INSERT
$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) 
VALUES ('Grégory', 'LACROIX', 'm', 'informatique', '2018-02-26', 15000)");      // auto-incrément° de l'id_employe
*/
        // en comm sinon se rajoute à chaq rafraichissement...!
        // on déclare une variable de réception = $resultat
// echo "Nombre d'enregistrement affecté par l'insert : $resultat" . '<br>';    // -> 1


// ⚠️ UPDATE
// Modif du salaire de employe 350 à 1300
$resultat = $pdo->exec("UPDATE employes SET salaire = 1300 WHERE id_employes = 350");
    echo "Nombre d'enregistrement affecté par l'update : $resultat" . '<br>'; 
// $resultat =  ⚠️ variable de réception créée
// Je pioche dans l'objet $pdo grâce à '->' , et la je vais formuler et executer ma requête

// ⚠️ DELETE
// Réaliser le script pour suppr l'employé 350
$resultat = $pdo->exec("DELETE FROM employes WHERE id_employes = 350");
    echo "Nombre d'enregistrement affecté par le delete : $resultat" . '<br>';  
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'Grégory'");

/*
⚠️ ⚠️ exec() est une METHODE issue de la class PDO permettant de formuler et exécuter des requêtes SQL ⚠️
⚠️ ⚠️ exec() est utilisé pour la formulation de requêtes ne retournant PAS de résultat ⚠️
⚠️ ⚠️ exec() renvoie le nb de lg affectées par la requête ⚠️ 
*/


echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>03. QUERY - SELECT + FETCH_ASSOC (1 seul résultat) </h2>';
//------------------------------------------------------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 699");
    echo'<pre>'; var_dump($resultat); echo '</pre>';
//  > query a mis résultat dans un objet (PDOStatement) ! > on peut pas aller piocher les infos > utiliser une fct pr
                /*  object(PDOStatement)#2 (1) {
                        ["queryString"]=>
                        string(46) "SELECT * FROM employes WHERE id_employes = 699"
                    }   */
/*
⚠️ Lorsqu'on exécute une requête de sélection via la METHODE ⚠️ query() sur l'objet PDO:
Succès : ⚠️ on obtient un autre objet issu d'une autre class : ⚠️️ PDOStatement ⚠️ 
         Cet objet a dc des méthodes et propriétés différentes !!
Echec  : boolean FALSE
$resulat est inexploitable en l'état, ⚠️ nous devons lui associer une METHODE fetch ⚠️ 
(PDO::FETCH_ASSOC) qui permet de rendre le résultat exploitable sous forme de tablo ARRAY.        
*/
    echo'<pre>'; print_r(get_class_methods($resultat)); echo '</pre>'; // > on voit les méthodes de l'objet query
                /*    Array
                    (
                        [0] => execute
                        [1] => fetch  ⚠️ 
                        [2] => bindParam
                        [3] => bindColumn
                        [4] => bindValue
                        [5] => rowCount  ⚠️ 
                        [6] => fetchColumn
                        [7] => fetchAll  ⚠️ 
                        [8] => fetchObject
                        [9] => errorCode
                        [10] => errorInfo
                        [11] => setAttribute
                        [12] => getAttribute
                        [13] => columnCount
                        [14] => getColumnMeta
                        [15] => setFetchMode
                        [16] => nextRowset
                        [17] => closeCursor
                        [18] => debugDumpParams
                        [19] => __wakeup
                        [20] => __sleep
                    )   */

$employe = $resultat->fetch(PDO::FETCH_ASSOC);  
// ⚠️  METHODE FETCH va retourner résultat en ⚠️ ARRAY  (1 par employé)
// ⚠️ fetch = méthode issue de l'objet PDOStatement, pas de l'objet query !

echo'<pre>'; print_r($employe); echo '</pre>';
                /*  Array
                    (
                        [id_employes] => 699
                        [prenom] => Julien
                        [nom] => Cottet
                        [sexe] => m
                        [service] => secretariat
                        [date_embauche] => 2007-01-18
                        [salaire] => 1490
                    )   */


// $employe = $resultat->fetch(PDO::FETCH_BOTH);    // => ⚠️  ARRAY qui index à la fois numériqt + le nom des champs
    // echo'<pre>'; print_r($employe); echo '</pre>';
                    /*   Array
                        (
                            [id_employes] => 699
                            [0] => 699
                            [prenom] => Julien
                            [1] => Julien
                            [nom] => Cottet
                            [2] => Cottet
                            [sexe] => m
                            [3] => m
                            [service] => secretariat
                            [4] => secretariat
                            [date_embauche] => 2007-01-18
                            [5] => 2007-01-18
                            [salaire] => 1490
                            [6] => 1490
                        )   */


// $employe = $resultat->fetch(PDO::FETCH_OBJ);    // => ⚠️  retourne un OBJET ac le nom des champs
// comme propriété public, on va POINTER AVEC une FLECHE pour afficher la valeur de la propriété
    // echo $employe->nom;
                    /*  stdClass Object
                        (
                            [id_employes] => 699
                            [prenom] => Julien
                            [nom] => Cottet
                            [sexe] => m
                            [service] => secretariat
                            [date_embauche] => 2007-01-18
                            [salaire] => 1490
                        )   */


    
// EXO : Afficher les données en affichage conventionnel
foreach($employe as $indice => $valeur) // on définie une valeur qd les indices sont parcourues
{
    echo $indice . ' : ' . $valeur . '<br>';    // ou echo "$indice : $valeur";
}
        /*  id_employes : 699
            prenom : Julien
            nom : Cottet
            sexe : m
            service : secretariat
            date_embauche : 2007-01-18
            salaire : 1490                  */
       



echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>04. PDO : QUERY - SELECT + WHILE + FETCH_ASSOC (plusieurs résultat) </h2>';
//------------------------------------------------------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes"); // ⚠️ on pioche ds class PDO ac la méthode query
    echo'<pre>'; var_dump($resultat); echo '</pre>';    // => retourne objet class PDOStatement

    echo 'Nombre d\'employe(s) : ' . $resultat->rowCount() . "<br>";    
    // ⚠️ ⚠️ rowCount = METHODE issue de class PDOStatement pr compter nb lg retournées par la requête de sel° (=19)


while($contenu = $resultat->fetch(PDO::FETCH_ASSOC))  // ⚠️ > donne que le 1er employé si PAS de boucle !
// ⚠️ Pr chaq tour de boucle while, la var $contenu retourne un ARRAY par employé, tant qu'il y a des employés, la boucle tourne
{
    echo '<pre>'; print_r($contenu); echo '<pre>';    // array de chaq employé
    foreach($contenu as $indice => $valeur) // 2è boucle passe chaq tablo array de chaq employé
    {
        echo $indice . ' : ' . $valeur . '<br>';    // on passe en revue les tablox ARRAY de chq employé
    }
    echo '<hr>';
}
     // 2è tour de 206 elle donne 2è employé... etc

                /*  Nombre d'employe(s) : 19
                    id_employes : 388
                    prenom : Clement
                    nom : Gallet
                    sexe : m
                    service : commercial
                    date_embauche : 2000-01-15
                    salaire : 2400
                    id_employes : 415
                    prenom : Thomas         etc.... (tous les autres) */

// ⚠️️ Il n'y a pas 1 ARRAY ac ts les enregistrements deds, mais 1 ARRAY par enregistrement (par employé) !!
// ⚠️ Votre requête sort plusieurs résultats ? : une boucle !!
// ⚠️ Votre requête ne doit sortir qu'un seul et unique résultat ? : pas de boucle
// ⚠️ Votre requête ne sort qu'un seul résultat et peut potentiellement en sortir plusieurs ? : une boucle 



echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>05. PDO : QUERY - FETCHALL + FETCH_ASSOC </h2>';
//------------------------------------------------------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);   // ⚠️️ fetchAll = un tablo array (indexé) pour chaq employé
    echo '<pre>'; print_r($donnees); echo '</pre>';
        /*    Array     => différent de fetch : ici un tablo indexé array indexé pour chaq tablo array
            (
                [0] => Array
                    (
                        [id_employes] => 388
                        [prenom] => Clement
                        [nom] => Gallet
                        [sexe] => m
                        [service] => commercial
                        [date_embauche] => 2000-01-15
                        [salaire] => 2400
                    )   */


// EXO : Afficher successt les données de ts les employés à l'aide de boucle et aff. conventionnel
foreach($donnees AS $indice1 => $valeur )  // $indice = [0] (tt le contenu du 1er tablo )
{
    foreach($valeur as $indice2 => $valeur2)     // ds [0] lire indice 0 > 1ère lg du tablo
    {
        echo $indice2 . ' : ' . $valeur2 . '<br>'; 
    }
    echo '<hr>';
}




echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>06. PDO : QUERY - FETCH + BDD </h2>';
//------------------------------------------------------------------------------------------------------------

// EXO : Afficher la liste des BDD puis la mettre dans une liste ul li.
$resultat = $pdo->query("SHOW DATABASES");  // => ⚠️️ donne objet de la class PDOStatemment, dc :
echo '<pre>'; var_dump($resultat); echo '<pre>';    // => le montre

echo '<ul>';
    while($bdd = $resultat->fetch(PDO::FETCH_ASSOC))    // ⚠️️ appeler $resultat ac méthode fetch
    // pr chaq tour de boucle while, $bdd donne un array de chaq BDD
    {
        // echo '<pre>'; print_r($bdd); echo '<pre>';   //  => donne array pour chaq bdd
        
        echo '<li>' . $bdd['Database'] . '</li> ';  
    }
echo '</ul>';




echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>07. PDO : QUERY - TABLE </h2>';
//------------------------------------------------------------------------------------------------------------
// EXO : Afficher toute la table employes en html :
// ⚠️️ On ne peut pas associer 2 fois la même méthode sur le même résultat !! 
//     = pas poss associer 2 fetch(PDO::FETCH_ASSOC) sur même résultat.

$resultat = $pdo->query("SELECT * FROM employes");

echo '<table border=1><tr>';
    for($i = 0; $i < $resultat->columnCount(); $i++)    // ⚠️️ ⚠️️ columnCount() = méthode issue de la class PDOStatement qui retourne le nb de champs/colonnes de la table, tant qu'il y a des colonnes, on boucle.
    {
        $colonne = $resultat->getColumnMeta($i);    // ⚠️️ ⚠️️ getColumnMeta() = méthode issue de la class PDOStatement qui récolte les infos des champs/colonnes de la table, pour chaque tour de boucle, $colonne contient un tablo ARRAY ac les infos d'une colonne.

        // echo '<pre>'; print_r($colonne);echo '</pre>';
        echo '<th>' . $colonne['name'] . '</th>';   // on a créé la 1ère lg
        // On va crocheter à l'indice 'name' pour afficher le nom des colonnes.
    }
    echo '</tr>';

    while($ligne = $resultat->fetch(PDO ::FETCH_ASSOC)) // On associe le méthode fetch() au résultat, $ligne contient un tablo ARRAY ac les infos d'un employé à chaq tour de boucle.
    {
        echo '<tr>';
            foreach($ligne as $informations)
            {
                echo '<td>' . $informations . '</td>'; // On affiche successivt les valeurs ds les cellules.
            }
        echo '</tr>';
    }
echo '</table>';



//  --> essayer ac méthode foreach (pas while)
/*
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);

echo "<table border=1><tr>"; 
    foreach($donnees AS $indice1 => $valeur )  // $indice = [0] (tt le contenu du 1er tablo )
    {
        echo '</tr>';
        foreach($valeur as $indice2 => $valeur2)     // ds [0] lire indice 0 > 1ère lg du tablo
        {
            echo '<tr>';
            echo $indice2 . ' : ' . $valeur2 . '<br>'; 
            echo '</tr>';
        }
        echo '<hr>';
    }
*/






echo '<hr>';
//------------------------------------------------------------------------------------------------------------
echo '<h2>08. PREPARE + BINDVALUE + EXECUTE </h2>';
//------------------------------------------------------------------------------------------------------------
// (=> on créée un genre de fct où l'on changera juste le nom du marqueur pour changer son utilité)
// ⚠️️ Préparation de la requête :
// ⚠️️ Soulage le serveur et la BDD à l'exécution, previens pour les injections SQL et les failles XSS
// ⚠️️ ':nom' est un marqueur nominatif, on prépare la requête mais on ne l'éxécute pas.

$nom = "Blanchet";
$resultat = $pdo->prepare('SELECT * FROM employes WHERE nom = :nom'); // requête de sélection où ...
// ⚠️️ on déclare un marqueur (:nom) : on prépare requête, à aucun moment exécutée

echo '<pre>'; print_r($resultat); echo '</pre>';    // objet PDOStatement
echo '<pre>'; print_r(get_class_methods($resultat)); echo'</pre>';  // on voit ttes les méthodes de PDOStatement

$resultat->bindValue(':nom', $nom, PDO::PARAM_STR); // on associe une valeur à notre marqueur mais tjrs pas exécutée
// ⚠️️ bindValue() = méthode pr associer une valeur au marqueur :
// ':nom' . nom du marqueur/valeur du marqueur/type de données.

$resultat->execute();   // Exécution de la requête
// ⚠️️ On le formule une seule fois et à tout moment dans le script nous pouvons l'exécuter.

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);  
// Une fois exécutée, ⚠️️ on associe une méthode pour rendre le résultat exploitable.
echo '<pre>'; print_r($donnees); echo '</pre>';     

//------------------------------------------------------------------------------------------------------------

$resultat->bindValue(':nom', 'Grand', PDO::PARAM_STR);    // ⚠️️ On associe une nvlle valeur au marqueur

$resultat->execute();   // Exécution de la requête

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';     

// ==> permet de pas ré-écrire une requête puor chaque requête !! ⚠️️ 