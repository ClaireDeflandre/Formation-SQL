<?php

include 'mesFonctionsSQL.php';
include 'mesFonctionsTable.php';
$action = $_GET["action"];

if ($action == "DELETE"){
    $id = $_GET["id"];
} else {
    $id = $_GET['id'];
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $age = $_GET['age'];
    $adresse = $_GET['adresse'];
}


if ($action == "CREATE"){
createUser($nom, $prenom, $age, $adresse);

    echo "utilisateur créé <br>";
    echo "<a href='index.php'>Liste des utilisateurs</a>";
}

if ($action == "UPDATE"){
    updateUser($id, $nom, $prenom, $age, $adresse);
    echo "utilisateur mis à jour <br>";
    echo "<a href='index.php'>Liste des utilisateurs</a>";
}

if ($action == "DELETE"){
    deleteUser($id);
    echo "user delete <br>";
    echo "<a href='index.php'>Liste des utilisateurs</a>";
}



?>