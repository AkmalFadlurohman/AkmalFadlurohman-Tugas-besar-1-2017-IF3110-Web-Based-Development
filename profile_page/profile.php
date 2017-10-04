<?php
    $username = $_GET['username'];
    $user_id = $_GET['id'];
?>
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
            <?php include'../template/header.php';?>
        </div>
        <div class="menu">
            <?php include'../template/menu.php';?>
        </div>
        <div class="profile_subtitle">
            <div class="profile_title"><h1>My Profile</h1></div>
            <div class="edit_profile_button"><a href=<?php echo 'edit_profile.php?id='.$user_id.'%26&username='.$username; ?>>✎</a></div>
        </div>
        <div class="myprofile">
            <div class="image_frame">
                <img id="profile_pict" src="../img/default_profile.jpeg">
            </div>
            <?php
                include '../database/dbconnect.php';
                
                $query=mysqli_query($con,"SELECT * FROM user WHERE username='".$username."'") or die(mysqli_error());
    
                $numrows=mysqli_num_rows($query);
                if($numrows!=0)
                {
                    while($row=mysqli_fetch_assoc($query))
                    {
                        echo "</br><strong>".$row['username']."</strong></br>";
                        echo $row['name']."</br>";
                        if ($row['status'] == "driver") {
                            echo "driver | Rating (xxx Votes)</br>";
                        }
                        echo $row['email']."</br>";
                        echo $row['phone']."</br>";
                        if (isset($row['pict'])) {
                            echo "<script>document.getElementById('profile_pict').src ='getProfilePict.php?username=".$username."'</script>";
                        }
                    }
                }
                mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>
