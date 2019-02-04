<?php

require(ROOT . "model/LoginModel.php");

function index()
{
	render("Login/index", array(
		'students' => getAllStudents()
	));
}
