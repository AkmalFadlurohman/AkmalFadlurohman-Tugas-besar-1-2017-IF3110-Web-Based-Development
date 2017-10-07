<?php
	include '../database/dbconnect.php';

	$cust_id = $_POST['customer'];
	$driver_id = $_POST['selected_driver'];
	$pick_city = $_POST['picking_point'];
	$dest_city = $_POST['destination'];
	$score = $_POST['rating'];
	$comment = $_POST['comment'];
	$date =  date_create() -> format("Y-m-d");

	$insert_order_query = mysqli_query($con, "
		INSERT INTO `order`(dest_city, pick_city, score, comment, driver_id, cust_id, date)
		VALUES ('".$dest_city."', '".$pick_city."', '".$score."', '".$comment."', '".$driver_id."', '".$cust_id."', '".$date."')
		") or die(mysqli_error($con));

	mysqli_close($con);
	
	header("Location: order.php?id=$cust_id");	
?>