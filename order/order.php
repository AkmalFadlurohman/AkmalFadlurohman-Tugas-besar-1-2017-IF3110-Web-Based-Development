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
				<div class="submenu left">
					Select Destination
				</div>
			</a>
			
			<a id="xxx">
				<div class="submenu mid" id="xxx">
					Select a Driver
				</div>
			</a>

			<a href="order/complete_order.html">
				<div class="submenu right">
					Complete Order
				</div>
			</a>
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
				<div class="button green" id="next">
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
		var element = document.getElementById('next');
		// element.onclick = function () {
		// 	alert('hi');
		// };
		element.onclick = function () {
				document.getElementById('select_destination').style.display='none';
				document.getElementById('select_driver').style.display='inline';
			}
	</script>
</body>
</html>
