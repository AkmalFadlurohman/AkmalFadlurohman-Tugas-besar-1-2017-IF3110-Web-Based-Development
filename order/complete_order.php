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
			<div class="submenu left">
				Select Destination
			</div>
		
			<div class="submenu mid">
				Select a Driver
			</div>

			<div class="submenu right">
				Complete Order
			</div>
		</div>
		<form method="post">
			<div class="content" id="complete_order" style="display: none;">
				<h2>
					How was it?
				</h2>
				<input class="button green" type="submit" name="submit" value="Complete Order">
			</div>
		</form>
	</div>
</body>
</html>