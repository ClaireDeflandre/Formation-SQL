<?php
    include 'mesfonctionsphp.php';
    include 'mesfonctionstable.php';

    $id = $_GET["id"];
    if ($id == 0){
        $user = getNewUser();
        $action = "CREATE";
        $libelle = "Créer";
        } else {
            $user = readUser($id);
            $action = "UPDATE";
            $libelle = "Mettre à jour";
        }

?>

<html>
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau utilisateurs</title>
</head>
<body>
    <form action="createUpdate.php" method="get">
    <p>
        <a href='index.php'>Liste des utilisateurs</a>

        <input type="hidden" name="id" value="<?php echo $user['id']; ?>"/>
        <input type="hidden" name="action" value="<?php echo $action; ?>"/>

        <div>
            <label for='nom'>Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>">
        </div>

        <div>
            <label for='nom'>Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>">
        </div>

        <div>
            <label for='nom'>Age :</label>
            <input type="text" id="age" name="age" value="<?php echo $user['age']; ?>">
        </div>
    </p>
    </form>


</body>
</html>