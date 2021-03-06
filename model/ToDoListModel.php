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

    for($i = 0; $i < count($data); $i++) {
        $query3 = $db->prepare("insert into ListItems(ListId,ItemName,ItemDescription,Duration) values(:listId,:name,:ListDesc,:ListDur)");

        $query3->bindparam(':listId', $listId[0]["ListID"]);
        $query3->bindparam(':name', $data[$i], PDO::PARAM_STR);
        $i++;
        $query3->bindparam(':ListDesc', $data[$i], PDO::PARAM_STR);
        $i++;
        $query3->bindparam(':ListDur', $data[$i], PDO::PARAM_INT);

        $query3->execute();
    }
}

function getLists($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT 
            L.ListID,
            L.ListName,
            (SELECT count(i.ListItemID) from ListItems i where i.ListID = L.ListID) as 'ListItemsCount' 
            FROM Lists L 
            where L.UUID = :uid");
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
}

function deleteListItemFromDB($data, $ListID){
    $db = openDatabaseConnection();
    $query = $db->prepare("DELETE FROM ListItems WHERE ListItemID = :ListItemID");

    $query->bindparam(':ListItemID', $data, PDO::PARAM_INT);

    $query->execute();

    $db = null;

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
        return true;
    } else {
        $db = null;
        return false;
    }

}

function GetVisitors($ListID){
    session_start();
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT * FROM SharedLists WHERE InitialCreatorID = :ICI AND SharedListID = :SLI");
    $query->bindParam(":ICI", $_SESSION["UUID"]);
    $query->bindParam(":SLI", $ListID);
    $query->execute();
    $db = null;
    return $query->fetchAll();
}

function AddVisitor($data){
    $db = openDatabaseConnection();
    $query = $db->prepare("INSERT INTO SharedLists (InitialCreatorID, VisitorID, VisitorEmail, SharedListID, ListName) VALUES (:ICI, :VI, :VE, :SLI, :LN)");
    $query->bindParam(":ICI", $data[0]);
    $query->bindParam(":VI", $data[1]);
    $query->bindParam(":VE", $data[2]);
    $query->bindParam(":SLI", $data[3]);
    $query->bindParam(":LN", $data[4]);
    $query->execute();
    $db = null;
}

function GetVisitorUUID($UsrName){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT UUID FROM Gebruikers WHERE UsrEmail = :email");
    $query->bindParam(":email", $UsrName);
    $query->execute();
    $db = null;
    return $query->fetchAll();
}

function GetListName($ListID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT ListName FROM Lists WHERE ListID = :ListID");
    $query->bindParam(":ListID", $ListID);
    $query->execute();
    $db = null;
    return $query->fetchAll();
}

function GetSharedListFromDB($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT ListName, SharedListID FROM SharedLists WHERE VisitorID = :VI");
    $query->bindParam(":VI", $UUID);
    $query->execute();
    $db = null;
    return $query->fetchAll();
}

function RemoveVisitorInDB($VUUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("DELETE FROM SharedLists WHERE VisitorID = :VI");
    $query->bindParam(":VI", $VUUID);
    $query->execute();
    $db = null;
    return $query->fetchAll();
}