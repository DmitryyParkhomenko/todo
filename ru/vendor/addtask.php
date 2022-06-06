<?php
	require 'connect.php';

	if (strlen($_POST['task']) >= 3) {
		$task = $_POST['task'];
	} else {
		$_SESSION['addtask-error'] = '
			<div class="errors">
				Your task cannot be shorter than 3 characters.
			</div>
		';
	}
	if ($_POST['checkbox'] == 'on') {
		$checkbox = 1;
	} else {
		$checkbox = 0;
	}
	$userID = $_SESSION['logged']['id'];

	$sql = "INSERT INTO tasks(task, userID, important) VALUES(?, ?, ?)";
	$query = $pdo->prepare($sql);
	$query->execute([$task, $userID, $checkbox]);

	header('Location: ../index.php');
?>