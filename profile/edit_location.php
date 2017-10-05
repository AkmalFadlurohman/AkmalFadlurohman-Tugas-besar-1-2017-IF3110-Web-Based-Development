<html>
<head>
<title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/location.css">
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
    <div class="editloc_container">
        <div class="subheader">
            <div class="title"><h1>Edit Preferred Loaction</h1></div>
        </div>
    </div>
</body>
</html>
