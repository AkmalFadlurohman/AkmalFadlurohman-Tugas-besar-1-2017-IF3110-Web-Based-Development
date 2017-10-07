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
		<form method="post" action=<?php echo "select_driver.php?id=" . $user_id;?>>
			<div class="content" id="select_destination">
				<div>
					<div>
						<span>Picking point</span>
						<input type="text" name="picking_point">
					</div>
					<div>
						<span>Destination</span>
						<input type="text" name="destination">
					</div>
					<div>
						<span>Preferred driver</span>
						<input type="text" name="preferred_driver">
					</div>
				</div>
				<input type="submit" name="submit_select_loc" class="button green">
			</div>
		</form>
	</div>
</body>
</html>
