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
					echo '<span class="username" >Hi, '. $_SESSION['logged']['login'] .'! </span>';
				}
				else {
					echo '<a href="#" >ENG</a><span class="or">/</span><a href="ru/">RUS</a>';
				}
			?>
		</div>
		<div class="user">
			<?php
			if (isset($_SESSION['logged'])) {
				echo '
					<a href="vendor/logout.php">Log out</a>
				';
			}
			else {
				echo '
					<a href="signin.php">Sign in</a><span class="or">/</span><a href="signup.php">Sign up</a>
				';
			}
			?>
		</div>
	</div>
	<form class="addtask-form" method="POST" action="vendor/addtask.php">
		<h1 class="form-title">ToDo:</h1>
		<div class="form-content">
			<input name="task" class="form-input" type="text" placeholder="Write what you have to do...">
			<div class="form-important">
				<input name="checkbox" class="form-checkbox" type="checkbox">
				<span class="form-span">Is this task important?</span>
			</div>
			<?php
				if (isset($_SESSION['logged'])) {
					echo '<button class="form-btn" type="submit">Add task</button>';
				} else {
					echo '<button class="form-btn" type="submit" disabled>Add task</button>';
					echo '<span class="notlogged">You have to be logged to add new tasks. <a href="signin.php">Login here.</a></span>';
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

	<h3 class="mytasks-h3">My Tasks:</h3>
	<div class="tasks">
		<?php
		if (isset($_SESSION['logged'])) {
			$userID = $_SESSION['logged']['id'];
			$sql = "SELECT * FROM `tasks` WHERE `userID` = '$userID' ORDER BY `tasks`.`id` DESC";
			$query = $pdo->prepare($sql);
			$query->execute();
			$tasks = $query->fetchAll(PDO::FETCH_ASSOC);
			if (count($tasks) == 0) {
				echo "<h3 class='notauth'>You don't have any tasks yet</h3>";
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
			echo "<h3 class='notauth'>Please <a href='signin.php'>login</a> first</h3>";
		}
		?>
	</div>
</div>

<footer>
	<h2>ToDo</h2>
	<span>Contact: </span><a href="mail@email.ua">email@sample.com</a>
</footer>

<script src="scripts/main.js"></script>
</body>
</html>