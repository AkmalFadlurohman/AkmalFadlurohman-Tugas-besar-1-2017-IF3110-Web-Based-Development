<?php
    
?>
<html>
<head>
    <title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
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
        <div style="background-color: white; max-width: 600px; margin-left: auto; margin-right: auto">
            <?php include'../template/menu.php';?>
        </div>
        <div class="profile_container">
            <div class="profile_header">
                <div class="profile_title"><h1>My Profile</h1></div>
                <div class="edit_profile_button"><a href=<?php echo 'edit_profile.php?id='.$user_id; ?>>✎</a></div>
            </div>
            <div class="myprofile">
                <div class="profilepict_frame">
                    <img id="profile_pict" src="../img/default_profile.jpeg">
                </div>
                <div class="profile_info">
                    <?php
                        echo "</br><strong>".$row['username']."</strong></br>";
                        echo $row['name']."</br>";
                        if ($row['status'] == "driver") {
                            echo "driver | Rating (xxx Votes)</br>";
                        }
                        echo $row['email']."</br>";
                        echo $row['phone']."</br>";
                        if (isset($row['pict'])) {
                            echo "<script>document.getElementById('profile_pict').src ='getProfilePict.php?id=".$user_id."'</script>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
