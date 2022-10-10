<?php
require_once '_connect.php';

$pdo = new \PDO(DSN, USER, PASS);

// A exécuter afin d'afficher vos lignes déjà insérées dans la table friends
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);


foreach($friendsArray as $friend) {
    echo '<ul>';
    echo '<li>'.$friend['firstname'] . ' ' . $friend['lastname']. '</li>';
    echo '</ul>';
}


//// vérification données ////

// $data = array_map('trim', $_POST);
// $errors = [];

// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (!isset($data['firstName']) || empty($data['firstName'])) 
//     $errors[] = "Le prénom est obligatoire";
//     if (!isset($data['lastName']) || empty($data['lastName'])) 
//     $errors[] = "Le nom est obligatoire";
//     if (strlen($data['firstName']) > 45)
//     $errors[] = "Le prénom doit contenir au maximum 45 caractères";
//     if (strlen($data['lastName']) > 45)
//     $errors[] = "Le prénom doit contenir au maximum 45 caractères";
//     if (!empty($errors)) {
//         echo 'Attention !'. "<br>";
//         foreach ($errors as $error)
//         echo $error. "<br>";
//     }
// }



// On récupère les informations saisies précédemment dans un formulaire
$firstname = trim($_POST['firstName']); 
$lastname = trim($_POST['lastName']);

// On prépare notre requête d'insertion
$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);

// On lie les valeurs saisies dans le formulaire à nos placeholders
$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    
<form action="index.php" method='post' class="container">

    <p>
    <label for="firstName">Firstname : </label>
    <input type="text" id='firstName' name='firstName' class="form-control" required>
    </p>

    <p>
    <label for="lastName">Lastname : </label>
    <input type="text" id='lastName' name='lastName' class="form-control" required>
    </p>

    <button>Send</button>

</form>

</body>
</html>



