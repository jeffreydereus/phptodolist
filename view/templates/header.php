<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>To Do List</title>
	<link rel="stylesheet" href="<?= URL ?>public/css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://rawgit.com/padolsey/jQuery-Plugins/master/sortElements/jquery.sortElements.js"></script>
    <?php

    session_start();
    ?>
</head>
<?php
if ($_SESSION["Color"] == "White") {
    echo '<body style="background-color:' . $_SESSION["Color"] . '">';
} else {
    echo '<body style="background-color:' . $_SESSION["Color"] . '; color:White">';
}

?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">To Do List</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">


            <?php if ($_SESSION["Role"] == "Gebruiker"):?>

                <ul class='nav navbar-nav' >
                    <li><a href='<?=URL?>Home/index'> Home</a ></li >
                    <li><a href='<?=URL?>ToDoList/index'> Maak To Do Lijst Aan </a ></li >
                    <li><a href='<?=URL?>ToDoList/lists'> Uw lijstjes</a ></li >
                    <li><a href="#"></a ></li >
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href='<?=URL?>Home/usrconfig'> Verander opties </a ></li >
                    <li><a href='<?=URL?>Login/logOut'>Log uit</a></li>
                </ul>

            <?php elseif ($_SESSION["Role"] == "Admin"):?>
                <ul class='nav navbar-nav' >
                    <li><a href='<?=URL?>Home/index'> Home</a ></li >
                    <li><a href='<?=URL?>ToDoList/index '> Maak To Do Lijst Aan </a ></li >
                    <li><a href='<?=URL?>ToDoList/lists'> Uw lijstjes </a ></li >
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=URL?>Admin/AdminUserView">Alle Gebruikers</a></li>
                            <li><a class="dropdown-item" href="<?=URL?>Admin/LogView">Log</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href='<?=URL?>Home/usrconfig'> Verander opties</a ></li >
                    <li><a href='<?=URL?>Login/logOut'>Log uit</a></li>
                </ul>

            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href='<?=URL?>Login/index'>Log in</a></li>
                    <li><a href='<?=URL?>Login/register'>Register</a></li>
                </ul>

            <?php endif ?>

        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
