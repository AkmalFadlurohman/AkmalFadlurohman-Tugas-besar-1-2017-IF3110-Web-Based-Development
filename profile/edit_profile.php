<html>
<head>
    <title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/switch.css">
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
                    $current_stat = $row['status'];
                    $username = $row['username'];
                    include("../template/header.php");
                }
                mysqli_close($con);
            ?>
        </div>
        <div class="menu_container">
            <?php include'../template/menu.php';?>
            <script>
                document.getElementById("profile_link").setAttribute("class", "menu menu_active");
            </script>
        </div>
        <div class="edit_profile_container">
            <div class="subheader">
                <div class="title"><h1>My Profile</h1></div>
            </div>
            <form name="edit_identity" method="POST" action="updateProfile.php" enctype="multipart/form-data">
                <div class="change_profilepict">
                    <div class="current_pict_frame">
                        <img id="current_profile_pict" src="../img/default_profile.jpeg">
                    </div>
                    <div class="pict_name_field">
                        <input id="file_name" type="text" readonly="readonly">
                    </div>
                    <div class="pict_picker_frame">
                        <input type="file" name="profile_pictfile" class="upload_file" onchange="showFileName(this);">
                    </div>
                </div>
                <div class="current_profile">
                    <div class="form_name">
                        <div style="height: 30px;">
                            Your Name
                        </div>
                        <div style="height: 30px;">
                            Phone
                        </div>
                        <div style="height: 30px;">
                            Status Driver
                        </div>
                    </div>
                    <div class="form_field">
                        <div style="height: 30px;">
                            <input id="current_name" name="edit_name" type="text">
                        </div>
                        <div style="height: 30px;">
                            <input id="current_phone" name="edit_phone" type="text">
                        </div>
                        <div style="height: 30px;">
                            <label class="switch" style="float: right;">
                                <input type="checkbox" name="is_driver" id="current_stat" value="true">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="edit_profile_nav">
                    <a href=<?php echo 'profile.php?id='.$user_id; ?>><div class="button red back" style="float: left; margin-left: 20px;">BACK</div></a>
                    <input type="submit" value="SAVE" style="float: right;" class="button green save">
                    <input name="hidden_userid" type="hidden" value= <?php echo $user_id ?>>
                </div>
            </form>
        </div>
    </div>
    <?php
        if ($current_stat == "driver") {
            echo "<script>document.getElementById('current_stat').checked = true;</script>";
        }
        echo "<script>document.getElementById('current_name').value = '".$row['name']."';</script>";
        echo "<script>document.getElementById('current_phone').value = '".$row['phone']."';</script>";
        if (isset($row['pict'])) {
            echo "<script>document.getElementById('current_profile_pict').src ='getProfilePict.php?id=".$user_id."'</script>";
        }
    ?>
    <script>
        function showFileName(inputFile) {
            var arrTemp = inputFile.value.split('\\');
            document.getElementById("file_name").value = arrTemp[arrTemp.length - 1];
        }
    </script>
</body>
</html>
