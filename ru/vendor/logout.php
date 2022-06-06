<?php
	require 'connect.php';

	unset($_SESSION['logged']);
	header('Location: ../index.php');
?>