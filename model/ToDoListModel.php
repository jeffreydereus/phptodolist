<?php

function SaveListToDatabase($UUID, $data){
    $db = openDatabaseConnection();

    $query = $db->prepare("insert into Lists(UUID,ListName) values(:uid,:name);");

    $query-> bindparam(':uid',$UUID, PDO::PARAM_STR);
    $query-> bindparam(':name',$data[0], PDO::PARAM_STR);

    $query->execute();
    array_shift($data);

    $query2 = $db->prepare("SELECT ListID FROM `Lists` WHERE UUID = :uid order by ListID DESC LIMIT 1");
    $query2-> bindparam(':uid',$UUID, PDO::PARAM_STR);
    $query2->execute();
    $listId = $query2->fetchAll();

    for($i = 0; $i < count($data); $i++){
        $query3 = $db->prepare("insert into ListItems(ListId,ItemName,ItemDescription,Duration) values(:listId,:name,:ListDesc,:ListDur)");

        $query3-> bindparam(':listId', $listId[0]["ListID"]);
        $query3-> bindparam(':name', $data[$i], PDO::PARAM_STR);
        $i++;
        $query3-> bindparam(':ListDesc', $data[$i], PDO::PARAM_STR);
        $i++;
        $query3-> bindparam(':ListDur', $data[$i], PDO::PARAM_INT);

        $query3->execute();
    }
    header('Location:' . URL . "ToDoList/Lists");
}

function getLists($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT * FROM Lists WHERE UUID = :uid");
    $query->bindParam(":uid", $UUID, PDO::PARAM_STR);
    $query->execute();
    $db = null;

    return $query->fetchAll();
}

function GetList($ListID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT ListID,ListName FROM Lists WHERE ListID = :listid");
    $query->bindParam(":listid", $ListID, PDO::PARAM_INT);
    $query->execute();

    $query2 = $db->prepare("SELECT * FROM ListItems WHERE ListID = :listid");
    $query2->bindParam(":listid", $ListID, PDO::PARAM_INT);
    $query2->execute();
    $db = null;
    return $query2->fetchAll();
}

function SaveItemToListInDB($data)
{
    $db = openDatabaseConnection();
    $query = $db->prepare("insert into ListItems(ListId,ItemName,ItemDescription,Duration) values(:listId,:name,:ListDesc,:ListDur)");

    $query->bindparam(':listId', $data[0]);
    $query->bindparam(':name', $data[1], PDO::PARAM_STR);
    $query->bindparam(':ListDesc', $data[2], PDO::PARAM_STR);
    $query->bindparam(':ListDur', $data[3], PDO::PARAM_INT);

    $query->execute();
    $db = null;
    header('Location:' . URL . "ToDoList/ShowList/" . $data[0]);
}

function deleteListItemFromDB($data, $ListID){
    $db = openDatabaseConnection();
    $query = $db->prepare("DELETE FROM ListItems WHERE ListItemID = :ListItemID");

    $query->bindparam(':ListItemID', $data, PDO::PARAM_INT);

    $query->execute();

    $db = null;
//    $_SESSION["msg"] = "Gelukt, Taak verwijderd";
    header('Location:' . URL . "ToDoList/ShowList/" . $ListID);
}

function getListItem($ListItemID){
    $db = openDatabaseConnection();

    $query = $db->prepare("SELECT * FROM ListItems WHERE ListItemID = :listitemid");
    $query->bindParam(":listitemid", $ListItemID, PDO::PARAM_INT);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function SaveEditedItemToDB($data){
    $db = openDatabaseConnection();
    $query = $db->prepare("UPDATE ListItems SET ItemName = :itemname, ItemDescription = :itemdescription, ItemFinished = :itemfinished, Duration = :duration WHERE ListItemID = :ListItemID");

    $query->bindparam(':ListItemID', $data[0], PDO::PARAM_INT);
    $query->bindparam(':itemname', $data[1], PDO::PARAM_STR);
    $query->bindparam(':itemdescription', $data[2], PDO::PARAM_STR);
    $query->bindparam(':itemfinished', $data[4], PDO::PARAM_STR);
    $query->bindparam(':duration', $data[3], PDO::PARAM_INT);

    $query->execute();

    $db = null;

    header('Location:' . URL . "ToDoList/lists/");
}

function getListInfo($ListID){
    $db = openDatabaseConnection();

    $query = $db->prepare("SELECT * FROM Lists WHERE ListID = :listid");
    $query->bindParam(":listid", $ListID, PDO::PARAM_INT);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function SaveEditedListToDB($data){
    $db = openDatabaseConnection();
    $query = $db->prepare("UPDATE Lists SET ListName = :listname WHERE ListID = :ListID");

    $query->bindparam(':ListID', $data[0], PDO::PARAM_INT);
    $query->bindparam(':listname', $data[1], PDO::PARAM_STR);

    $query->execute();
    $db = null;
    header('Location:' . URL . "ToDoList/lists/");
}

function deleteListFromDatabase($listID){
    session_start();
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT UUID FROM Lists WHERE ListID = :listid");
    $query->bindParam(":listid", $listID, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll();

    if ($_SESSION["UUID"] == $result[0]["UUID"]) {

        $query2 = $db->prepare("DELETE FROM ListItems WHERE ListID = :ListID");
        $query2->bindparam(':ListID', $listID, PDO::PARAM_INT);
        $query2->execute();

        $query3 = $db->prepare("DELETE FROM Lists WHERE ListID = :ListID");
        $query3->bindparam(':ListID', $listID, PDO::PARAM_INT);
        $query3->execute();

        $db = null;
        header('Location:' . URL . "ToDoList/lists");
    } else {
        $db = null;
        header('Location:' . URL . "ToDoList/UnAuthorized");
    }

}

