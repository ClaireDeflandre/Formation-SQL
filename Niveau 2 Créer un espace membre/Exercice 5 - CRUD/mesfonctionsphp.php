<?php

function getDatabaseConnection(){

}

function getAllUsers(){
    $con = getDatabaseConnection();
    $req = 'SELECT * FROM utilisateurs';
    $rows = $con->query($req);
    return $rows;
}

function readUser($id){ 
    $con = getDatabaseConnection();
    $req = 'SELECT * FROM utilisateurs where id = "$id"';
    $stmt = $con->query($req);
    $row = $stmt->fetchAll();
    if (!empty($row)) {
        return $row[0]; 
    }
}

function createUser($nom,$prenom,$age,$adresse){
    try {
        $con = getDatabaseConnection();
        $sql = "INSERT INTO utilisateurs (nom, prenom, age, adresse)
                VALUES ('$nom','$age', '$adresse')";
        $con->exec($sql);
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage(); 
    }
}

function updateUser($id,$nom,$prenom,$age,$adresse){

    try {
        $con = getDatabaseConnection();
        $req = "UPDATE utilisateurs set
                nom = '$nom,
                prenom = '$prenom',
                age = '$age',
                adresse = '$adresse',
                where id = '$id';
       $stmt = $con->query($req);
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage(); 
    }
}

function deleteUser($id){
    try {
        $con = getDatabaseConnection();
        $req = "DELETE from utilisateurs where id = '$id'";
        $stmt = $con->query($req); 
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }

?>