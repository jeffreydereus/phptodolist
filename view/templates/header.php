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
    <?php

    session_start();

    ?>
</head>
<body>
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

            <?php
            if ($_SESSION["Role"] == "Gebruiker") {

                echo "<ul class='nav navbar-nav' >";
                echo '<li><a href=' . URL . 'Home/index > Home</a ></li >';
                echo '<li><a href=' . URL . 'ToDoList/index > Maak To Do Lijst Aan </a ></li >';
                echo '<li><a href=' . URL . 'ToDoList/lists> Uw lijstjes </a ></li >';
                echo '<li><a href="#"></a ></li >';
                echo '</ul>';
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li><a href=' . URL . 'Login/logOut>Log uit</a></li></ul>';
            }
            else if ($_SESSION["Role"] == "Admin") {
                echo "<ul class='nav navbar-nav' >";
                echo '<li><a href=' . URL . 'Home/index > Home</a ></li >';
                echo '<li><a href=' . URL . 'ToDoList/index > Maak To Do Lijst Aan </a ></li >';
                echo '<li><a href=' . URL . 'ToDoList/lists> Uw lijstjes </a ></li >';
                echo '<li><a href=' . URL . 'Admin/AdminUserView> Alle Gebruikers</a ></li >';
                echo '<li><a href="#"></a ></li >';
                echo '</ul>';
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li><a href=' . URL . 'Login/logOut>Log uit</a></li></ul>';
            }
            else {
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li><a href=' . URL . 'Login/index>Log in</a></li>';
                echo '<li><a href=' . URL . 'Login/register>Register</a></li>';
                echo '</ul>';
            }

            ?>

        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
