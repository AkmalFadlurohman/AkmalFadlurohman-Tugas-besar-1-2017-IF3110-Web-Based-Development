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

                //===========================================

                $ppoint = $_POST['picking_point'];
				$dest = $_POST['destination'];
				$prefdrv = $_POST['preferred_driver'];
				
				function ShowPrefDrv($prefdrv, $con)
				{
					if (!(is_null($prefdrv))) {
						$pdQuery = mysqli_query($con, "SELECT * FROM driver RIGHT OUTER JOIN (SELECT user_id FROM user WHERE name='" . $prefdrv . "') AS usert ON user_id = driver_id;") or die(mysqli_error($con));

						$row = mysqli_fetch_assoc($pdQuery);


					}
					else
					{
						echo "<h2>Nothing to display :(</h2>";
					}
				}
				ShowPrefDrv($prefdrv, $con);
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
		<form method="post" action="complete_order.php">
			<div class="content" id="select_driver">
				<div id="preferred_driver">
					<h2>Preferred driver</h2>
				</div>
				<div id="other_driver">
					<h2>Other drivers</h2>
				</div>
				<div id="selected_driver" style="display: none">
					<input type="text" name="selected_driver">
				</div>
			</div>
		</form>
	</div>
</body>
</html>