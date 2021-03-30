<?php
require_once("_connect.php");
$pdo = new PDO(DSN, USER, PASS);
$friends = [];
if (!empty($_GET)) {
    $lastname = trim($_GET['lastname']);
    $firstname = trim($_GET['firstname']);
    /**
     * Insert avec retour de validation 
     */
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:lastname, :firstname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':firstname', $firstname);
    $statement->execute();
    header('Location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste friends</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    /**
     * paramettrage de connection
     */
    require_once '_connect.php';
    $pdo = new \PDO(DSN, USER, PASS);
    $query = "SELECT * FROM friend";

    /**
     * La méthode query() de l'objet PDO (préalablement instancié et stocké dans la variable $pdo) 
     * permet d'exécuter une requête qui renvoie des résultats. La méthode retourne un objet
     * de type PDOStatement (c'est pour cela que la variable a été nommée $statement).
     * Ce nouvel objet possède lui-même plusieurs 
     * méthodes (dont fetchAll() utilisée ici) permettant de récupérer les données 
     * sous différents formats.
     */
    $statement = $pdo->query($query);
    /**
     *  récuperation des données 
     */
    $friends = $statement->fetchAll();
    ?>
    <div class="listfriends">
        <h3>Liste des "friends"</h3>
        <?php
        foreach ($friends as $key => $friend) :
            $lignepair = $key % 2;
        ?>
            <div class="friend">
                <div class="infosFriends<?= $lignepair ?>"><?= $friend["lastname"] ?></div>
                <div class="infosFriends<?= $lignepair ?>"><?= $friend["firstname"] ?></div>
            </div>
        <?php endforeach; ?>       
    </div>

    <div class="container">
        <h3>Recherche d'un ami friends</h3>
        <form id="login" action="" method="get">
            <div>
                <label for="lastname">Nom</label>
                <input id="lastname" name="lastname" type="text">
            </div>
            <div>
                <label for="firstname">Prenom</label>
                <input id="firstname" name="firstname" type="text">
            </div>
            <div>
                <input type="submit" value="Enregistrer">
            </div>
        </form>
    </div>
</body>

</html>