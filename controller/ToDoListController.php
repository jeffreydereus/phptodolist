<?php

require(ROOT . "model/ToDoListModel.php");
require(ROOT . "model/LogModel.php");

function index()
{
    render("ToDoList/index");
}

function SaveList($UUID){
    try {

        session_start();
        $data = array($_POST["ListName"]);
        for ($i = 1; $i < 21; $i++) {
            if ($_POST["ListItemName" . $i] == null) {
                break;
            }
            array_push($data, $_POST["ListItemName" . $i]);
            array_push($data, $_POST["ListItemDescription" . $i]);
            array_push($data, $_POST["ListItemDuration" . $i]);
        }
        SaveListToDatabase($UUID, $data);
        AddLog("I","ToDoList/SaveList", null);
        $_SESSION["msg"] = "Gelukt, Lijst Aangemaakt";
        header('Location:' . URL . "ToDoList/Lists/");
    } catch (Exception $Ex){
        AddErrorLog("I","ToDoList/SaveList", null, $Ex);
    }
}

function Lists()
{
    render("ToDoList/Lists");
}

function ShowList($ListID){
    render("ToDoList/ShowList", array(
        'VisibleList' => GetList($ListID),
        'ListID' => $ListID
    ));
}

function SaveItemToList($ListID){
    try {
    $data = array($ListID);
    for($i = 1; $i < 21; $i++) {
        if ($_POST["ListItemName" . $i] == null) {
            break;
        }
        array_push($data, $_POST["ListItemName" . $i]);
        array_push($data, $_POST["ListItemDescription" . $i]);
        array_push($data, $_POST["ListItemDuration" . $i]);
    }
    SaveItemToListInDB($data);
    AddLog("I","ToDoList/SaveitemToList", $ListID);
    header('Location:' . URL . "ToDoList/ShowList/" . $ListID);
    } catch (Exception $Ex){
        AddErrorLog("I","ToDoList/SaveItemToList", $ListID, $Ex);
    }
}

function deleteListItem($ListItemID, $ListID){
    session_start();
    try{
    deleteListItemFromDB($ListItemID, $ListID);
    $_SESSION["msg"] = "Gelukt! Taak verwijderd";
    header('Location:' . URL . 'ToDoList/ShowList/' . $ListID);
    AddLog("D","ToDoList/deleteListItem", $ListItemID);
    } catch (Exception $Ex){
        AddErrorLog("D","ToDoList/deleteListItem", $ListItemID, $Ex);
    }
}

function EditListItem($ListItemID){
    render("ToDoList/EditItem", array(
        'ItemValues' => getListItem($ListItemID)
    ));
}

function SaveEditedItem($itemID){
    $data = array($itemID, $_POST["ListItemName"], $_POST["ListItemDescription"], $_POST["ListItemDuration"], $_POST["ListItemFinished"]);
    try {
    SaveEditedItemToDB($data);
    AddLog("U","ToDoList/SaveEditedItem", $itemID);
    header('Location:' . URL . "ToDoList/lists/");
    } catch (Exception $Ex){
        AddErrorLog("U","ToDoList/SaveEditedItem", $itemID, $Ex);
    }
}

function EditList($listid){
    render("ToDoList/EditList", array(
        'ListValues' => getListInfo($listid)
    ));
}

function SaveEditedList($ListID){
    $data = array($ListID, $_POST["ListName"]);
    try{
    SaveEditedListToDB($data);
    AddLog("U","ToDoList/SaveEditedList", $ListID);
    header('Location:' . URL . "ToDoList/lists/");
    } catch (Exception $Ex){
        AddErrorLog("U","ToDoList/SaveEditedList", $ListID, $Ex);
    }
}

function DeleteList($listID){
    try{
    if (deleteListFromDatabase($listID) == true) {
        $_SESSION["msg"] = "Gelukt, Lijst verwijderd.";
        header('Location:' . URL . "ToDoList/Lists/");
    } else {
        header('Location:' . URL . "ToDoList/UnAuthorized/");
    }
        AddLog("D","ToDoList/DeleteList", $listID);
    } catch (Exception $Ex){
        AddErrorLog("D","ToDoList/DeleteList", $listID, $Ex);
    }
}

function UnAuthorized(){
    render("ToDoList/UnAuthorized");
}