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

                //==================================================

                $ppoint = $_POST['picking_point'];
				$dest = $_POST['destination'];
				$seldrv = $_POST['selected_driver'];

				$driverinfo_query = mysqli_query($con, "SELECT * FROM user JOIN (SELECT * FROM driver WHERE driver_id='" . $seldrv . "') AS drivert ON user_id = driver_id") or die(mysqli_error());
				$driverinfo = mysqli_fetch_assoc($driverinfo_query);

				$driver_username = $driverinfo['username'];
				$driver_name = $driverinfo['name'];
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
		<form id="submit_cmplt_ordr" method="post">
			<div class="content" id="complete_order">
				<h2>
					How was it?
				</h2>
				<div>
					<?php echo "
					<img class='driver_pict' src='../profile/getProfilePict.php?id=".$seldrv."'>"
					;?>
					<p> @<?php echo $driver_username;?></p>
					<p> <?php echo $driver_name;?></p>
				</div>
				<div class="rating_bar">
					<span class="star" id="1-star" onclick="rate1()" onmouseover="light1()">&starf;</span>
					<span class="star" id="2-star" onclick="rate2()" onmouseover="light2()">&starf;</span>
					<span class="star" id="3-star" onclick="rate3()" onmouseover="light3()">&starf;</span>
					<span class="star" id="4-star" onclick="rate4()" onmouseover="light4()">&starf;</span>
					<span class="star" id="5-star" onclick="rate5()" onmouseover="light5()">&starf;</span>
					<input type="hidden" name="rating" id="rating">
				</div>
				<div>
					<textarea id="comment" name="comment" form="submit_cmplt_ordr">
					
					</textarea>
				</div>
				<input class="button green" type="submit" name="submit" value="Complete Order">
			</div>
		</form>
		<?php mysqli_close($con); ?>
	</div>
</body>
<script type="text/javascript">
	var star1 = document.getElementById('1-star');
	var star2 = document.getElementById('2-star');
	var star3 = document.getElementById('3-star');
	var star4 = document.getElementById('4-star');
	var	star5 = document.getElementById('5-star');
	var rate = document.getElementById('rating');

	function rate1() {
		rate.value = 1;
		light1();
	}	
	function rate2() {
		rate.value = 2;
		light2();
	}
	function rate3() {
		rate.value = 3;
		light3();
	}
	function rate4() {
		rate.value = 4;
		light4();
	}
	function rate5() {
		rate.value = 5;
		light5();
	}	

	function light1() {
		rate.value = 1;
		star1.style.color = "yellow";
		star2.style.color = "gray";
		star3.style.color = "gray";
		star4.style.color = "gray";
		star5.style.color = "gray";
	}
	function light2() {
		rate.value = 2;
		star1.style.color = "yellow";
		star2.style.color = "yellow";
		star3.style.color = "gray";
		star4.style.color = "gray";
		star5.style.color = "gray";
	}
	function light3() {
		rate.value = 3;
		star1.style.color = "yellow";
		star2.style.color = "yellow";
		star3.style.color = "yellow";
		star4.style.color = "gray";
		star5.style.color = "gray";
	}
	function light4() {
		rate.value = 4;
		star1.style.color = "yellow";
		star2.style.color = "yellow";
		star3.style.color = "yellow";
		star4.style.color = "yellow";
		star5.style.color = "gray";
	}
	function light5() {
		rate.value = 5;
		star1.style.color = "yellow";
		star2.style.color = "yellow";
		star3.style.color = "yellow";
		star4.style.color = "yellow";
		star5.style.color = "yellow";
	}

</script>
</html>