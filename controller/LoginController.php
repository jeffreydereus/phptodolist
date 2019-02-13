<?php

require(ROOT . "model/LoginModel.php");
require(ROOT . "model/DataModel.php");
require(ROOT . "model/LogModel.php");


function index()
{
	render("Login/index");
}

function register()
{
    render("Login/register");
}

function RegisterToDB(){
    try{
    $data = array($_POST["UserEmail"], $_POST["UsrName"], $_POST["UsrPass"]);
        SaveUserToDatabase($data);
        AddLog("I","Login/RegisterToDB", null);
        header('Location:' . URL .  'Login/ingelogd/aangemaakt');
    } catch (Exception $Ex){
        AddErrorLog("I","Login/RegisterToDB", null, $Ex);
    }
}

function LoginSession(){
    $data = array($_POST['UsrName'], $_POST['UsrPass']);
    if(LoginSessionCreate($data)){
        header('Location:' . URL . "Login/ingelogd/succes");
    } else {
        header('Location:' . URL . "Login/ingelogd/oeps");
    }
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
        $_SESSION["Color"] = $login[0]["ColorName"];
        return true;
    } else {
        return false;
    }
}

function ingelogd($feedback)
{
    render("Login/ingelogd", array(
        'feedback' => $feedback
    ));
}

function logOut(){
    LoginSessionDestroy();
    header('Location:' . URL . "Home/index");
}