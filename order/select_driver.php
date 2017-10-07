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
				echo $prefdrv;
				
				function ShowPrefDrv($prefdrv, $con)
				{
					if (!(is_null($prefdrv))) {
						$pdQuery = mysqli_query($con, "SELECT * FROM driver RIGHT OUTER JOIN (SELECT * FROM user WHERE name='" . $prefdrv . "') AS usert ON user_id = driver_id") or die(mysqli_error($con));

						while ($row = mysqli_fetch_assoc($pdQuery)) {
							$driver_id = $row['driver_id'];
							$driver_name = $row['username'];
							$driver_votes = $row['votes'];
							$driver_rating = ($driver_votes == 0) ? 0 : $row['total_score']/$row['votes'];
							echo 
								"
								<table id='tbl_pref_driver'>
									<tr>
		                        		<td>
		                        			<img class='history_pict' src='../profile/getProfilePict.php?id=".$driver_id."'
		                        		</td>
		                        		<td>
					    					<p class='driver_username'>".$driver_name."</p>
					    					<p class='driver_rating'>&starf;".$driver_rating." (".$driver_votes." votes)</p>
					    					<div class='button green' onclick='chooseDriver()'>
					    						I CHOOSE YOU
					    					</div>
		                        		</td>
		                        	</tr>
								</table>	
	                        	";
						}
					}
					else
					{
						echo "<h2>Nothing to display :(</h2>";
					}
				}
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
		<form method="post" id="submit_select_drv" action=<?php echo "complete_order.php?id=".$user_id ?>>
			<div class="content" id="select_driver">
				<div id="preferred_driver">
					<h2>Preferred driver</h2>
					<?php ShowPrefDrv($prefdrv, $con) ?>
				</div>
				<div id="other_driver">
					<h2>Other drivers</h2>
				</div>
				<input type="hidden" name="selected_driver" id="selected_driver">
				<!-- <input type="submit" name="submit_select_drv" id="submit_select_drv" style="display: none;"> -->
			</div>
		</form>
		<?php mysqli_close($con) ?>
	</div>
</body>
<script type="text/javascript">
	function chooseDriver(driver_id) {
		document.getElementById('selected_driver').value = driver_id;
		var form = document.getElementById('submit_select_drv');
		form.submit();
	}
</script>
</html>