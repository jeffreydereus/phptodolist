<?php

function AddLog($Action, $Controller, $Target){
    session_start();
    $db = openDatabaseConnection();
    $sql = "INSERT INTO Log (ActionType, ControllerAction, TargetID, UUID) VALUES (:ActionType, :ControllerAction, :TargetID, :UUID)";
    $query = $db->prepare($sql);
    $query->bindParam(":ActionType", $Action);
    $query->bindParam(":ControllerAction", $Controller);
    $query->bindParam(":TargetID", $Target);
    $query->bindParam(":UUID", $_SESSION["UUID"]);

    $query->execute();
    $db = null;
}

function AddErrorLog($Action, $Controller, $Target, $ExceptionData){
    session_start();
    $db = openDatabaseConnection();
    $sql = "INSERT INTO Log (ActionType, ControllerAction, TargetID, UUID, Exception, ExceptionThrown) VALUES (:ActionType, :ControllerAction, :TargetID, :UUID, :Exception, 1)";
    $query = $db->prepare($sql);
    $query->bindParam(":ActionType", $Action);
    $query->bindParam(":ControllerAction", $Controller);
    $query->bindParam(":TargetID", $Target);
    $query->bindParam(":Exception", $ExceptionData);
    $query->bindParam(":UUID", $_SESSION["UUID"]);

    $query->execute();
    $db = null;
}

function GetLogs(){
    $db = openDatabaseConnection();
    $sql = "SELECT * FROM Log ORDER BY LogDate DESC LIMIT 100";
    $query = $db->prepare($sql);
    $query->execute();
    $db = null;
    return $query->fetchAll();
}