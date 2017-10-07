<?php

	$user_id = $_GET['id'];
	header("Location: ../order/select_location.php?id=$user_id");
	die();
?>
