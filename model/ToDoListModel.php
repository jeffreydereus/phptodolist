<?php

function SaveListToDatabase($UUID, $data){
    $db = openDatabaseConnection();

    $query = $db->prepare("insert into Lists(UUID,ListName) values(:uid,:name);");

    $query-> bindparam(':uid',$UUID);
    $query-> bindparam(':name',$data[0]);

    $query->execute();
    array_shift($data);

    $query2 = $db->prepare("SELECT ListID FROM `Lists` WHERE UUID = :uid order by ListID DESC LIMIT 1");
    $query2-> bindparam(':uid',$UUID, PDO::PARAM_STR);
    $query2->execute();
    $listId = $query2->fetchAll();

    for($i = 0; $i < count($data); $i++){
        $query3 = $db->prepare("insert into ListItems(ListId,ItemName) values(:listId,:name)");

        $query3-> bindparam(':listId', $listId[0]["ListID"]);
        $query3-> bindparam(':name', $data[$i]);
//        $query3-> bindparam(':description', $data[0]["itemDescriptions"][$i]);

        $query3->execute();
    }
}