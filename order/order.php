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
			<script>
                document.getElementById("order_link").setAttribute("class", "menu menu_active");
            </script>
		</div>

		<h1>Make an Order</h1>
		<div class="submenu_container">
			<div class="submenu left" onclick="showSelectDest()">
				Select Destination
			</div>
		
			<div class="submenu mid" onclick="showSelectDriver()">
				Select a Driver
			</div>

			<div class="submenu right" onclick="showCompleteOrder()">
				Complete Order
			</div>
		</div>
		<form method="post">
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
				<div class="button green" id="next" onclick="showSelectDriver()">
					Next
				</div>
			</div>
			<div class="content" id="select_driver" style="display: none;">
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
			<div class="content" id="complete_order" style="display: none;">
				<h2>
					How was it?
				</h2>
				<input class="button green" type="submit" name="submit" value="Complete Order">
			</div>
		</form>
	</div>

	<script type="text/javascript">
		function showSelectDest() {
			document.getElementById('select_destination').style.display= 'inline';
			document.getElementById('select_driver').style.display= 'none';
			document.getElementById('complete_order').style.display= 'none';
		};

		function showSelectDriver() {
			document.getElementById('select_driver').style.display= 'inline';
			document.getElementById('select_destination').style.display= 'none';
			document.getElementById('complete_order').style.display= 'none';
		};

		function showCompleteOrder() {
			document.getElementById('complete_order').style.display='inline';
			document.getElementById('select_destination').style.display= 'none';
			document.getElementById('select_driver').style.display= 'none';
		};
	</script>
</body>
</html>
