<?php
	session_start();
	$user = 'root';
	$password = 'root';
	$host = 'localhost';
	$db = "todo";

	$dsn = 'mysql:host='.$host.';dbname='.$db;
	$pdo = new PDO($dsn, $user, $password);


?>

