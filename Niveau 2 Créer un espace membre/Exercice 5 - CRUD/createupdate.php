<?php

include 'mesfonctionsphp.php';
include 'mesfonctionsTab.php';
$action = $_GET["action"];

if ($action == "DELETE"){
    $id = $_GET["id"];
}else{
    $id = $_GET["id"];
    $nom = $_GET["nom"];
    $prenom = $_GET["prenom"];
    $age = $_GET["age"];
    $adresse = $_GET["adresse"];
}

if ($action =="CREATE"){
    createUser($nom,$prenom,$age,$adresse);
    echo "Nouvel utilisateur créé <br>";
    echo "<a href='index.php'>Liste des utilisateurs</a>";
}

if ($action =="UPDATE"){
    createUser($id,$nom,$prenom,$age,$adresse);
    echo "user update <br>";
    echo "<a href='index.php'>Liste des utilisateurs</a>";
}

if ($action =="DELETE"){
    deleteUser($id);
    echo "Utilisateur supprimé<br>"
    echo "<a href='index.php'>Liste des utilisateurs</a>";
}
?>