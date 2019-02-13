<?php

function getAllLists($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT * FROM Lists WHERE UUID = :UUID");
    $query->bindParam(":UUID", $UUID, PDO::PARAM_INT);
    $query->execute();

    $db = null;
    return $query->fetchAll();
}

function getAllUsers(){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT UsrName,UUID FROM Gebruikers");
    $query->execute();

    $db = null;
    return $query->fetchAll();
}

function getUserInfo($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT UsrName,UsrRole,UUID FROM Gebruikers WHERE UUID = :UUID");
    $query->bindParam(":UUID", $UUID, PDO::PARAM_INT);
    $query->execute();

    $db = null;
    return $query->fetchAll();
}

function SaveChangedRoleToDB($data){
    $db = openDatabaseConnection();
    $query = $db->prepare("UPDATE Roles SET RoleName = :rolename WHERE UUID = :UUID");

    $query->bindparam(':rolename', $data[1], PDO::PARAM_INT);
    $query->bindparam(':UUID', $data[0], PDO::PARAM_STR);

    $query->execute();
    $db = null;
}

function GetUserRole($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT UUID, RoleName FROM Roles WHERE UUID = :UUID");
    $query->bindParam(":UUID", $UUID, PDO::PARAM_INT);
    $query->execute();

    $db = null;
    return $query->fetchAll();
}