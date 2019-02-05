<?php

require(ROOT . "model/LoginModel.php");
require(ROOT . "model/DataModel.php");

function index()
{
	render("Login/index");
}

function register()
{
    render("Login/register");
}

function RegisterToDB(){
    $data = array($_POST["UsrName"], $_POST["UsrPass"]);
    SaveUserToDatabase($data);
}

function LoginSession(){
    $data = array($_POST['UsrName'], $_POST['UsrPass']);
    LoginSessionCreate($data);
}

function ingelogd()
{
    render("Login/ingelogd");
}