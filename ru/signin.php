<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/sign.css">
	<title>Авторизация - ToDo</title>
</head>
<body>

<div class="wrapper">
	<div class="settings">
		<div>
			<a href="index.php" >Вернуться на главную</a>
		</div>
		<div>
			<a href="signup.php" >У меня нет аккаунта</a>
		</div>
	</div>

	<form class="addtask-form" method="POST" action="vendor/authorisation.php">
		<h1 class="form-title">Вход</h1>
		<div class="form-content">
			<input name="login" class="form-input" type="text" placeholder="Введите Ваш логин">
			<input name="password" class="form-input" type="password" placeholder="Введите ваш пароль">
			<button class="form-btn" type="submit">Войти</button>
		</div>
	</form>
	<?php
		echo $_SESSION['reg-success'];
		echo $_SESSION['auth-errors'];
		unset($_SESSION['reg-success']);
		unset($_SESSION['auth-errors']);
 	?>

</div>

</body>
</html>