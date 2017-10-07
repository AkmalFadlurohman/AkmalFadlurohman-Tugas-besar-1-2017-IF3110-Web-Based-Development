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

                $ppoint = $_POST['picking_point'];
				$dest = $_POST['destination'];
				$prefdrv = $_POST['preferred_driver'];
				
				function ShowPrefDrv($prefdrv, $con)
				{
					$pdQuery = mysqli_query($con, "SELECT * FROM driver INNER JOIN user ON driver_id = user_id WHERE name='$prefdrv'") or die(mysqli_error($con));
					if (mysqli_num_rows($pdQuery)!=0) {
						while ($row = mysqli_fetch_assoc($pdQuery)) {
							$driver_id = $row['driver_id'];
							$driver_name = $row['name'];
							$driver_votes = $row['votes'];
							$driver_rating = ($driver_votes == 0) ? 0 : $row['total_score']/$row['votes'];
							if ($driver_id != $GLOBALS['user_id']) {
								echo 
									"
									<table class='driver_table'>
										<colgroup>
											<col style='width: 20%;'>
											<col style='width: 80%;'>
										</colgroup>
										<tr>
			                        		<td>
			                        			<img class='driver_pict' src='../profile/getProfilePict.php?id=".$driver_id."'
			                        		</td>
			                        		<td class='driver_column'>
						    					<p class='driver_username'>".$driver_name."</p>
						    					<p class='driver_rating'><span style='color: orange'>&starf;".$driver_rating."</span> (".$driver_votes." votes)</p>
						    					<div class='choose_driver green' onclick='chooseDriver(".$driver_id.")'>
						    						I CHOOSE YOU
						    					</div>
			                        		</td>
			                        	</tr>
									</table>	
		                        	";
							}
						}
					}
					else
					{
						echo "<h3>Nothing to display :(</h3>";
					}
				}

				function ShowRegDrv($con, $user_id)
				{
					$point = $GLOBALS['ppoint'];
					$dst = $GLOBALS['dest'];

					$rdQuery = mysqli_query($con, "
						SELECT DISTINCT * FROM (driver_prefloc INNER JOIN user ON driver_prefloc.driver_id = user.user_id)
						INNER JOIN driver ON driver.driver_id = user.user_id
						WHERE pref_loc = '$point' OR pref_loc = '$dst' 
						") or die(mysqli_error($con));

					while ($row = mysqli_fetch_assoc($rdQuery)) {
						$driver_id = $row['driver_id'];
						$driver_name = $row['name'];
						$driver_votes = $row['votes'];
						$driver_rating = ($driver_votes == 0) ? 0 : $row['total_score']/$row['votes'];
						if ($driver_id != $user_id) {
							echo 
								"
								<table class='driver_table'>
									<colgroup>
										<col style='width: 20%;'>
										<col style='width: 80%;'>
									</colgroup>
									<tr>
		                        		<td>
		                        			<img class='driver_pict' src='../profile/getProfilePict.php?id=".$driver_id."'
		                        		</td>
		                        		<td class='driver_column'>
					    					<p class='driver_username'>".$driver_name."</p>
					    					<p class='driver_rating'><span>&starf;".$driver_rating."</span> (".$driver_votes." votes)</p>
					    					<div class='choose_driver green' onclick='chooseDriver(".$driver_id.")'>
					    						I CHOOSE YOU
					    					</div>
		                        		</td>
		                        	</tr>
								</table>	
	                        	";
						}
					}
				}
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
				<div class="submenu left">
					<div class="step_num">
						<p>1</p>
					</div>
					<div class="step_name">
						<p>Select Destination</p>
					</div>
				</div>
			
				<div class="submenu mid submenu_active">
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


			<div id="driver_table_container">
				<form method="post" id="submit_select_drv" action=<?php echo "complete_order.php?id=".$user_id ?>>
				
					<div class="content" id="select_driver">
						<div id="preferred_driver">
							<h2>Preferred driver</h2>
							<?php ShowPrefDrv($prefdrv, $con) ?>
						</div>
						<div id="other_driver">
							<h2>Other drivers</h2>
							<?php ShowRegDrv($con, $user_id) ?>
						</div>
						<input type="hidden" name="picking_point" value=<?php echo $ppoint ?>>
						<input type="hidden" name="destination" value=<?php echo $dest?>>
						<input type="hidden" name="selected_driver" id="selected_driver">
					</div>
				</form>
				<?php mysqli_close($con) ?>
			</div>
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
