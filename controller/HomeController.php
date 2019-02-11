<?php

require(ROOT . "model/HomeModel.php");

function index()
{
	render("home/index");	
}

function usrconfig()
{
    render("home/userConfig", array(
        "colors" => getColors()
    ));
}

function SaveConfig()
{
    SaveConfigToDB($_POST["UserColor"]);
}