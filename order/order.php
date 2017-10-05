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
			
		<div>
			<h1>MAKE AN ORDER</h1>
			<div style="background-color: white; max-width: 600px; margin-left: auto; margin-right: auto">
				<a href="order/select_location.html">
					<div style="width:150px; float: left; margin-left: 5%; border: 5px solid black">
						Select Destination
					</div>
				</a>
				
				<a href="order/select_driver.html">
					<div style="width:150px; float: left; margin-left: 5px; margin-right: 5px; border: 5px solid black">
						Select Driver
					</div>
				</a>

				<a href="order/complete_order.html">
					<div style="width:150px; float: left; margin-right: 5%; border: 5px solid black">
						Complete Order
					</div>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
