<?php

require(ROOT . "model/ToDoListModel.php");

function index()
{
    render("ToDoList/index");
}

function SaveList(){
    $data = array($_POST["ListName"]);
    for($i = 1; $i < 21; $i++){
        if($_POST["ListItemName" . $i] == null){
            break;
        }
        array_push($data, $_POST["ListItemName" . $i]);
    }
    SaveListToDatabase($data);
}