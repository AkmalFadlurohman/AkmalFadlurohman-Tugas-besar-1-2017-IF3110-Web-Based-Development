<?php //if (!isset($_SESSION['user'])) die("<br /><br />You must be logged in to view this page");?>
<html>
<head>
    <title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>
<body>
    <div class="frame" id="profile_frame">
        <div class="header">
            <?php include '../template/header.php';?>
        </div>
        <div class="menu">
            <?php include '../template/menu.php';?>
        </div>
        <div class="profile_subtitle">
            <div class="profile_title"><h1>My Profile</h1></div>
            <div class="edit_profile_button"><a href="edit_profile.php">✎</a></div>
        </div>
        <div class="myprofile">
            <div class="image_frame">
                <img id="profile_pict" src="../img/default_profile.jpeg">
            </div>
            <?php
                include '../database/dbconnect.php';
                $user = "eHower";
                $query=mysql_query("SELECT * FROM user WHERE username='".$user."'") or die(mysql_error());
    
                $numrows=mysql_num_rows($query);
                if($numrows!=0)
                {
                    while($row=mysql_fetch_assoc($query))
                    {
                        echo "</br><strong>".$row['username']."</strong></br>";
                        echo $row['name']."</br>";
                        if ($row['status'] == "driver") {
                            echo "driver | Rating (xxx Votes)</br>";
                        }
                        echo $row['email']."</br>";
                        echo $row['phone']."</br>";
                        /*if (isset($row['pict'])) {
                            echo "<script>document.getElementById('profile_pict').src = '../img/default_profile.jpeg'</script>";
                        }*/
                    }
                }
                mysql_close();
            ?>
        </div>
    </div>
</body>
</html>
