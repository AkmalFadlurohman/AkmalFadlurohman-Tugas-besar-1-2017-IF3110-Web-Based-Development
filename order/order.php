<!DOCTYPE html>
<html>
<head>
	<title>U Wanna Call Me Beibh?</title>
	<link rel="stylesheet" type="text/css" href="../css/default_style.css">
	<link rel="stylesheet" type="text/css" href="../css/order.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
</head>
<body>
	<div class="frame">
		<div class="header">
			<?php
                $user_id = $_GET['id'];
                include '../database/dbconnect.php';
                
                $query=mysqli_query($con,"SELECT * FROM user WHERE user_id='".$user_id."'") or die(mysqli_error());
                
                if(mysqli_num_rows($query)!=0)
                {
                    $row=mysqli_fetch_assoc($query);
                    $username = $row['username'];
                    include("../template/header.php");
                }
                mysqli_close($con);
            ?>
		</div>
		<div class="menu_container">
			<?php include'../template/menu.php';?>
		</div>

		<h1>Make an Order</h1>
		<div class="submenu_container">
			<a href="order/select_location.html">
				<div class="submenu">
					Select Destination
				</div>
			</a>
			
			<a href="order/select_driver.html">
				<div class="submenu">
					Select Driver
				</div>
			</a>

			<a href="order/complete_order.html">
				<div class="submenu">
					Complete Order
				</div>
			</a>
		</div>
	</div>
</body>
</html>
