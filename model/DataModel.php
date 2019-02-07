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
    $PassHash = hash('sha256', $data[1]); //Hash the password
    $UUID = uuid();
    $db = openDatabaseConnection();
    $sql = "INSERT INTO Gebruikers (`UsrName`, `UsrPass`, `UUID`) VALUES(:UsrName, :UsrPass, :UUID)";
    $query = $db->prepare($sql);
    $query->bindParam(':UsrName', $data[0], PDO::PARAM_STR);
    $query->bindParam(':UsrPass', $PassHash, PDO::PARAM_STR);
    $query->bindParam(':UUID', $UUID, PDO::PARAM_STR);
    $query->execute();
    $query2 = $db->prepare("INSERT INTO Roles (`UUID`) VALUES(:UUID)");
    $query2->bindParam(':UUID', $UUID, PDO::PARAM_STR);
    $query2->execute();
    $db = null;
    header('Location:' . URL .  'home/index');
}

function LoginSessionCreate($data){ //Login a user
    $PassHash = hash('sha256', $data[1]);
    $UsrName = $data[0];
    $login = CheckUsr($PassHash, $UsrName);
    $role = getRole($login[0]["UUID"]);
    if ($login[0]["Allowed"] == "true"){ //Verify a password
        session_start();
        $_SESSION["type"] = 'gebruiker';
        $_SESSION["UsrName"] = $data[0];
        $_SESSION["UUID"] = $login[0]["UUID"];
        $_SESSION["Role"] = $role[0]["RoleName"];
        header('Location:' . URL . "Login/ingelogd");
        return;
    } else {
        header('Location:' . URL . "Home/index");
    }
}

function CheckUsr($pass, $UsrName){
    $db = openDatabaseConnection();
    $query = $db->prepare("
            select
            (CASE 
                when (select g.UsrId from Gebruikers g where g.UsrName = :UsrName and g.UsrPass = :UsrPass) is not null then 'true'
                else 'false'
            END) as 'Allowed',
            g.UsrID,
            g.UsrName,
            g.UUID
            from Gebruikers g where g.UsrName = :UsrName and g.UsrPass = :UsrPass
            ");

    $query->bindParam(':UsrName', $UsrName);
    $query->bindParam(':UsrPass', $pass);

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
    header('Location:' . URL . "Home/index");
}