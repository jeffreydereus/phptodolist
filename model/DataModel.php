<?php
function uuid(){
    Begin:
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    $db = openDatabaseConnection();
    $sql = "SELECT EXISTS(SELECT * from Gebruikers WHERE UUID=:input)";
    $query = $db->prepare($sql);
    $query->bindParam(':input', $uuid, PDO::PARAM_STR);
    $query->execute();
    $db = null;
    if($query == 0){
        goto Begin;
    }
    else {
        return $uuid;
    }
}

function SaveUserToDatabase($data) {
    $PassHash = password_hash($data[1], PASSWORD_DEFAULT); //Hash the password
    $UUID = uuid();
    $db = openDatabaseConnection();
    $sql = "INSERT INTO Gebruikers (`UsrName`, `UsrPass`, `UUID`) VALUES(:UsrName, :UsrPass, :UUID)";
    $query = $db->prepare($sql);
    $query->bindParam(':UsrName', $data[0], PDO::PARAM_STR);
    $query->bindParam(':UsrPass', $PassHash, PDO::PARAM_STR);
    $query->bindParam(':UUID', $UUID, PDO::PARAM_STR);
    $query->execute();

    $db = null;
    header('Location:' . URL .  'home/index');
}