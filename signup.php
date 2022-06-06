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
	<title>Sign Up - ToDo</title>
</head>
<body>

<div class="wrapper">
	<div class="settings">
		<div>
			<a href="index.php" >Return back</a>
		</div>
		<div>
			<a href="signin.php" >You already have an account?</a>
		</div>
	</div>
	<form class="addtask-form" method="POST" action="vendor/register.php">
		<h1 class="form-title">Sign Up</h1>
		<div class="form-content">
			<input name="login" class="form-input" type="text" placeholder="Write your login">
			<input name="email" class="form-input" type="email" placeholder="Write your email">
			<input name="password" class="form-input" type="password" placeholder="Write your password">
			<input name="confirm-password" class="form-input" type="password" placeholder="Confirm your password">
			<button class="form-btn" type="submit">Sign Up</button>
		</div>
	</form>

	<?php
		echo $_SESSION['reg-error'];
		unset($_SESSION['reg-error']);
	?>

</div>

</body>
</html>