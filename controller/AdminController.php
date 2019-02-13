<?php

require(ROOT . "model/AdminModel.php");
require(ROOT . "model/LogModel.php");


function AdminUserView(){
    render("admins/AdminUsrView");
}

function AdminView($UUID){
    render("admins/AdminView", array(
        'UUID' => $UUID
    ));
}

function EditRole($UUID){
    render("admins/EditRole", array(
        'UUID' => $UUID,
        'Values' => getUserInfo($UUID)
    ));
}

function SaveChangedRole($UUID){
    $data = array($UUID, $_POST["Role"]);
    try {
        SaveChangedRoleToDB($data);
        AddLog("U","Admin/SaveChangedRole", null);
        header('Location:' . URL . "admin/AdminUserView");
    } catch (Exception $Ex){
        AddErrorLog("I","Admin/SaveChangedRole", null, $Ex);
    }
}

function LogView(){
    render('admins/LogView', array(
        'logs' => GetLogs()
    ));
}