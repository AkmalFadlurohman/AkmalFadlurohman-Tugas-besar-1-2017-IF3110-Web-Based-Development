<!DOCTYPE html>
<html>
<head>
	<title>Select Location</title>
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
		<script>
        	document.getElementById("order_link").setAttribute("class", "menu menu_active");
        </script>

		<div class="order_container">
			<div class="subheader">
        		<div class="title"><h1>Make an Order</h1></div>
        	</div>
			<div class="submenu_container">
				<div class="submenu left submenu_active">
					<div class="step_num">
						<p>1</p>
					</div>
					<div class="step_name">
						<p>Select Destination</p>
					</div>
				</div>
			
				<div class="submenu mid">
					<div class="step_num">
						<p>2</p>
					</div>
					<div class="step_name">
						<p>Select a Driver</p>
					</div>
				</div>

				<div class="submenu right">
					<div class="step_num">
						<p>3</p>
					</div>
					<div class="step_name">
						<p>Complete Order</p>
					</div>
				</div>
			</div>


			<form method="post" id="submit_select_loc" name="submit_select_loc" action=<?php echo "select_driver.php?id=" . $user_id;?> onsubmit="return validateForm();">
				<div class="content" id="select_destination">
					<div>
						<span class="loc_form_label">Picking point</span>
						<input type="text" name="picking_point" id="picking_point">
					</div>
					<div>
						<span class="loc_form_label">Destination</span>
						<input type="text" name="destination" id="destination">
					</div>
					<div>
						<span class="loc_form_label">Preferred driver</span>
						<input type="text" name="preferred_driver" placeholder="(optional)">
					</div>
					<div>
						<input type="submit" value="Next" class="button green" id="loc_button">
					</div>
				</div>
			</form>
		</div>
		
	</div>
</body>
    <script type="text/javascript">
        function validateForm() {
            if(document.submit_select_loc.picking_point.value == null || document.submit_select_loc.picking_point.value == "") {
                window.alert("Please fill the picking location");
                return false;
            } else if (document.submit_select_loc.destination.value == null || document.submit_select_loc.destination.value == "") {
                winddow.alert("Please fill the destination location");
                return false;
            }
        }
	</script>
</html>
