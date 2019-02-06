<?php

function SaveListToDatabase($data){
    $db = openDatabaseConnection();

    $query = $db->prepare("insert into Lists(UUID,ListName) values(:uid,:name);");

    $query-> bindparam(':uid',$_SESSION["UUID"]);
    $query-> bindparam(':name',$data[1]);

    $query->execute();

    $query2 = $db->prepare("SELECT ListID FROM `Lists` WHERE UUID IS :uid");
    $query-> bindparam(':uid',$_SESSION["UUID"]);
    $query2->execute();
    $listId = $query2->fetchAll();

    for($i = 0; $i < count($data[0]["itemNames"]); $i++){
        $query3 = $db->prepare("insert into ItemsList(ListId,Name,Description) values(:listId,:name,:description)");

        $query3-> bindparam(':listId', $listId[0]["Id"]);
        $query3-> bindparam(':name', $data[0]["itemNames"][$i]);
        $query3-> bindparam(':description', $data[0]["itemDescriptions"][$i]);

        $query3->execute();
    }
}