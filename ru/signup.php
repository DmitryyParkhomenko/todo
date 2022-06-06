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
	<title>Регистрация - ToDo</title>
</head>
<body>

<div class="wrapper">
	<div class="settings">
		<div>
			<a href="index.php" >Вернуться на главную</a>
		</div>
		<div>
			<a href="signin.php" >У Вас уже есть аккаунт?</a>
		</div>
	</div>
	<form class="addtask-form" method="POST" action="vendor/register.php">
		<h1 class="form-title">Регистрация</h1>
		<div class="form-content">
			<input name="login" class="form-input" type="text" placeholder="Придумайте ваш логин">
			<input name="email" class="form-input" type="email" placeholder="Введите ваш email">
			<input name="password" class="form-input" type="password" placeholder="Придумайте надёжный пароль">
			<input name="confirm-password" class="form-input" type="password" placeholder="Подтвердите Ваш пароль">
			<button class="form-btn" type="submit">Зарегистрироваться!</button>
		</div>
	</form>

	<?php
		echo $_SESSION['reg-error'];
		unset($_SESSION['reg-error']);
	?>

</div>

</body>
</html>