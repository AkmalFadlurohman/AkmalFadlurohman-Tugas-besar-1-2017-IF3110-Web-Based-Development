<!DOCTYPE html>
<html>
<head>
	<title>driver history</title>
	<link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/history.css">
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
        <div class="history_container">
        	<div class="subheader">
        		<div class="title"><h1>Transaction History</h1></div>
        	</div>

    		<ul class="page_menu">
    			<li>
    				<a class="history_menu" href=<?php echo 'transaction_history.php?id='.$user_id; ?>>
						<h3>MY PREVIOUS ORDER</h3>
					</a>
    			</li>
    			<li>
    				<a class="history_menu menu_active" href=<?php echo 'driver_history.php?id='.$user_id; ?>>
						<h3>DRIVER HISTORY</h3>
					</a>
    			</li>
    		</ul>
        </div>
	</div>
</body>
</html>