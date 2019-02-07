<?php

require(ROOT . "model/ToDoListModel.php");

function index()
{
    render("ToDoList/index");
}

function SaveList($UUID){
    $data = array($_POST["ListName"]);
    for($i = 1; $i < 21; $i++){
        if($_POST["ListItemName" . $i] == null){
            break;
        }
        array_push($data, $_POST["ListItemName" . $i]);
        array_push($data, $_POST["ListItemDescription" . $i]);
        array_push($data, $_POST["ListItemDuration" . $i]);
    }
    SaveListToDatabase($UUID, $data);

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
}

function deleteListItem($ListItemID){
    deleteListItemFromDB($ListItemID);
}

function EditListItem($ListItemID){
    render("ToDoList/EditItem", array(
        'ItemValues' => getListItem($ListItemID)
    ));
}

function SaveEditedItem($itemID){
    $data = array($itemID, $_POST["ListItemName"], $_POST["ListItemDescription"], $_POST["ListItemDuration"], $_POST["ListItemFinished"]);
    SaveEditedItemToDB($data);
}

function EditList($listid){
    render("ToDoList/EditList", array(
        'ListValues' => getListInfo($listid)
    ));
}

function SaveEditedList($ListID){
    $data = array($ListID, $_POST["ListName"]);
    SaveEditedListToDB($data);
}

function DeleteList($listID){
    deleteListFromDatabase($listID);
}

function UnAuthorized(){
    render("ToDoList/UnAuthorized");
}