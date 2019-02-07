<?php

require(ROOT . "model/AdminModel.php");

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
    SaveChangedRoleToDB($data);
}