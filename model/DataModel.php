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
    $PassHash = hash('sha256', $data[2]); //Hash the password
    $UUID = uuid();
    $db = openDatabaseConnection();
    $sql = "INSERT INTO Gebruikers (UsrEmail, `UsrName`, `UsrPass`, `UUID`) VALUES(:UsrEmail, :UsrName, :UsrPass, :UUID)";
    $query = $db->prepare($sql);
    $query->bindParam(':UsrEmail', $data[0], PDO::PARAM_STR);
    $query->bindParam(':UsrName', $data[1], PDO::PARAM_STR);
    $query->bindParam(':UsrPass', $PassHash, PDO::PARAM_STR);
    $query->bindParam(':UUID', $UUID, PDO::PARAM_STR);
    $query->execute();
    $query2 = $db->prepare("INSERT INTO Roles (`UUID`) VALUES(:UUID)");
    $query2->bindParam(':UUID', $UUID, PDO::PARAM_STR);
    $query2->execute();
    $db = null;
}

function CheckUsr($pass, $UsrName){

    $db = openDatabaseConnection();
    $query = $db->prepare("
            select
            (CASE 
                when (SELECT g.UsrId FROM Gebruikers g WHERE (g.UsrName = :UsrName OR g.UsrEmail = :UsrName) AND g.UsrPass = :UsrPass) is not null then 'true'
                else 'false'
            END) as 'Allowed',
            g.UsrID,
            g.UsrName,
            g.UsrEmail,
            g.UUID,
            c.ColorName
            from Gebruikers g
            left join Colors c on c.Id = g.UsrColor
            where (g.UsrName = :UsrName OR g.UsrEmail = :UsrName) and g.UsrPass = :UsrPass
            ");

    $query->bindValue(':UsrName', $UsrName, PDO::PARAM_STR);
    $query->bindValue(':UsrPass', $pass, PDO::PARAM_STR);

    $query->execute();
    return $result = $query->fetchAll();
}

function getRole($UUID){
    $db = openDatabaseConnection();
    $query = $db->prepare("SELECT UUID, RoleName FROM Roles WHERE UUID = :UUID");
    $query->bindParam(":UUID", $UUID, PDO::PARAM_INT);
    $query->execute();

    $db = null;
    return $query->fetchAll();
}

function LoginSessionDestroy(){
    session_start();
    session_destroy();
}