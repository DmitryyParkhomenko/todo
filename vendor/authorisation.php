<?php
	require 'connect.php';

	$errors = [];

	$login = trim(filter_var($_POST['login']));
	$password = $_POST['password'];

	$sql = "SELECT * FROM `users` WHERE `login` = '$login' ";
	$query = $pdo->prepare($sql);
	$query->execute();
	$users = $query->fetchAll(PDO::FETCH_ASSOC);
	if (count($users) == 1) {
		foreach ($users as $user) {

			$hashpass = $user['password'];
			if (password_verify($password, $hashpass)) {
				$_SESSION['logged'] = $user;
				header('Location: ../index.php');
			}
			else {
				array_push($errors, "Password is not correct");
				$_SESSION['auth-errors'] = '
					<div class="errors">
						'. $errors[0] .'
					</div>
				';
				header('Location: ../signin.php');
			}
		}
	} else {
		array_push($errors, "User with this login doesn't exist");
		$_SESSION['auth-errors'] = '
			<div class="errors">
				'. $errors[0] .'
			</div>
		';
		header('Location: ../signin.php');
	}
?>