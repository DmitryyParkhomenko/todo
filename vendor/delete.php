<?php
	require 'connect.php';

	$taskID = $_GET['id'];
	$userID = $_GET['userID'];

	if (isset($_SESSION['logged']) && $userID == $_SESSION['logged']['id']) {
		$sql = "DELETE FROM tasks WHERE `tasks`.`id` = '$taskID'";
		$query = $pdo->prepare($sql);
		$query->execute();

		header('Location: ../index.php');
	} else {
		echo '<h1>Ooops, mistake!</h1>';
		echo '<h2>You cannot delete not yours task </h2>';
		echo '<button><a href="../index.php">Go back</a></button>';
	}

 ?>