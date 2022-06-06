<?php
	require 'connect.php';

	$errors = [];

	$sql = 'SELECT `login` FROM users';
	$query = $pdo->prepare($sql);
	$query->execute();
	$logins = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach ($logins as $item) {

		foreach ($item as $i) {
			if (trim(filter_var($_POST['login'])) == $i)
			{
				array_push($errors, "User with this login already exist... try another one");
			}

			else if (strlen(trim(filter_var($_POST['login']))) > 20 || strlen(trim(filter_var($_POST['login']))) < 3)
			{
				array_push($errors, "your login have to be less than 20 and bigger than 2 charechters");
			}

			else if (strlen(trim(filter_var($_POST['login']))) == '')
			{
				array_push($errors, "Your login cannot be filled");
			}

			else {
				$login = trim(filter_var($_POST['login']));
			}
		}

	}

	$sql = 'SELECT `email` FROM users';
	$query = $pdo->prepare($sql);
	$query->execute();
	$emails = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach ($emails as $item) {

		foreach ($item as $i) {
			if (trim(filter_var($_POST['email'])) == $i) {
				array_push($errors, "User with this email already exist");
			} else if ( trim(filter_var($_POST['email'])) == '' ) {
				array_push($errors, "Your email cannot be filled");
			}
			else {
				$email = trim(filter_var($_POST['email']));
			}
		}

	}


	if ( $_POST['password'] != $_POST['confirm-password']) {
		array_push($errors, 'Passwords you wrote are different');
	} else if (trim($_POST['password']) == '') {
		array_push($errors, 'Write your password');
	} else {
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	}

	if (empty($errors)) {
		$sql = 'INSERT INTO users(login, email, password) VALUES(?, ?, ?)';
		$query = $pdo->prepare($sql);
		$query->execute([$login, $email, $password]);
		$_SESSION['reg-success'] = '
			<div class="reg-success">
				Registration completed successfully. Please sign in
			</div>
		';
		header('Location: ../signin.php');
	} else {
		$_SESSION['reg-error'] = '
			<div class="errors">
				'. $errors[0] .'
			</div>
		';
		header('Location: ../signup.php');
	}

?>