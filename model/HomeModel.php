<?php

function getColors()
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM Colors";
    $query = $db->prepare($sql);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function SaveConfigToDB($data){
    session_start();
    $db = openDatabaseConnection();
    $query = $db->prepare("UPDATE Gebruikers SET UsrColor = :UserColor WHERE UUID = :UUID");

    $query->bindparam(':UserColor', $data, PDO::PARAM_INT);
    $query->bindparam(':UUID', $_SESSION["UUID"], PDO::PARAM_STR);

    $query->execute();
    $db = null;

    header('Location:' . URL . "Home/index");
}