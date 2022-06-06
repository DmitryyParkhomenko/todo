<?php session_start(); require 'vendor/connect.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="styles/main.css">
	<link rel="icon" type="image/x-icon" href="images/favicon.ico">
	<title>ToDo App</title>
</head>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&display=swap');
</style>
<body>

<div class="wrapper">
	<div class="settings">
		<div class="lang">
			<?php
				if (isset($_SESSION['logged'])) {
					echo '<span class="username" >Привет, '. $_SESSION['logged']['login'] .'! </span>';
				}
				else {
					echo '<a href="../" >ENG</a><span class="or">/</span><a href="#">RUS</a>';
				}
			?>
		</div>
		<div class="user">
			<?php
			if (isset($_SESSION['logged'])) {
				echo '
					<a href="vendor/logout.php">Выйти</a>
				';
			}
			else {
				echo '
					<a href="signin.php">Войти</a><span class="or">/</span><a href="signup.php">Зарегистрироваться</a>
				';
			}
			?>
		</div>
	</div>
	<form class="addtask-form" method="POST" action="vendor/addtask.php">
		<h1 class="form-title">ToDo:</h1>
		<div class="form-content">
			<input name="task" class="form-input" type="text" placeholder="Введите сюда свою задачу...">
			<div class="form-important">
				<input name="checkbox" class="form-checkbox" type="checkbox">
				<span class="form-span">Отметить как важное?</span>
			</div>
			<?php
				if (isset($_SESSION['logged'])) {
					echo '<button class="form-btn" type="submit">Добавить задачу</button>';
				} else {
					echo '<button class="form-btn" type="submit" disabled>Добавить задачу</button>';
					echo '<span class="notlogged">Вы должны быть зарегистрированы, чтобы добавить задачу <a href="signin.php">Войти здесь.</a></span>';
				}
			 ?>
		</div>
	</form>

	<?php

		if(isset($_SESSION['addtask-error'])) {
			echo $_SESSION['addtask-error'];
		}
		unset($_SESSION['addtask-error']);

 	?>

	<h3 class="mytasks-h3">Мои задачи:</h3>
	<div class="tasks">
		<?php
		if (isset($_SESSION['logged'])) {
			$userID = $_SESSION['logged']['id'];
			$sql = "SELECT * FROM `tasks` WHERE `userID` = '$userID' ORDER BY `tasks`.`id` DESC";
			$query = $pdo->prepare($sql);
			$query->execute();
			$tasks = $query->fetchAll(PDO::FETCH_ASSOC);
			if (count($tasks) == 0) {
				echo "<h3 class='notauth'>У вас пока нет задач.</h3>";
			}
			foreach ($tasks as $task) {
				if ($task['important'] == '1') {
					$imp = 'important';
				} else {
					$imp = '';
				}
				echo '
					<div class="task '. $imp .'">
						<h5 class="task-content">'. $task['task'] .'</h5>
						<a href="vendor/delete.php?id='. $task['id'] .'&userID=' . $task['userID'] .'"><button class="task-button '. $imp .'">+</button></a>
					</div>
				';
			}
		} else {
			echo "<h3 class='notauth'>Пожалуйста, <a href='signin.php'>авторизируйтесь</a></h3>";
		}
		?>
	</div>
</div>

<footer>
	<h2>ToDo</h2>
	<span>Контакты: </span><a href="mail@email.ua">email@sample.com</a>
</footer>

<script src="scripts/main.js"></script>
</body>
</html>