<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../database/dbconnect.php';
        if (!empty($_POST['edit_name']) && !empty($_POST['edit_phone']) && !empty($_POST['hidden_userid'])) {
            $user_id = $_POST['hidden_userid'];
            $new_name = $_POST['edit_name'];
            $new_phone = $_POST['edit_phone'];
            $getCurrentStatus = mysqli_query($con,"SELECT status FROM user WHERE user_id='".$user_id."'") or die(mysql_error($con));
            $row=mysqli_fetch_assoc($getCurrentStatus);
            $curent_stat=$row['status'];
            if(isset($_POST['is_driver']))
            {
                $status = 'driver';
                if ($current_stat != "driver") {
                    $query = mysqli_query($con,"INSERT INTO driver (driver_id) VALUES ('$user_id')") or die(mysqli_error($con));
                }
            } else
            {
                if ($current_stat == "driver") {
                    $query = mysqli_query($con,"DELETE FROM driver WHERE driver_id='".$user_id."'") or die(mysqli_error($con));
                }
                $status = 'customer';
            }
            if (isset($_FILES) && ($_FILES['profile_pictfile']['size'] > 0))
            {
                $checkImg = true;
                $filePath = $_FILES['profile_pictfile']['tmp_name'];
                $fileName = $_FILES['profile_pictfile']['name'];
                $fileSize = $_FILES['profile_pictfile']['size'];
                $fileType = $_FILES['profile_pictfile']['type'];
                if ($_FILES['profile_pictgile']['error'] || !is_uploaded_file($filePath)) {
                    $checkImg = false;
                    echo "Error: Error in uploading file. Please try again.";
                }
                if ($checkImg && !in_array($fileType, array('image/png', 'image/x-png', 'image/jpeg', 'image/pjpeg', 'image/gif'))) {
                    $checkImg = false;
                    echo "Error: Unsupported file extension. Supported extensions are JPG / PNG.";
                }
                if ($checkImg && $fileSize > 16000000) {
                    $checkImg = false;
                    echo "Error: File size must be less than 16 MB.";
                }
                if ($checkImg) {
                    $fp      = fopen($filePath, 'r');
                    $content = fread($fp, filesize($filePath));
                    $content = addslashes($content);
                    fclose($fp);
                    
                    if(!get_magic_quotes_gpc())
                    {
                        $fileName = addslashes($fileName);
                    }
                }
                $query="UPDATE user set name='".$new_name."',phone='".$new_phone."',status='".$status."',pict='".$content."'WHERE user_id='".$user_id."'";
            } else {
                $query="UPDATE user set name='".$new_name."',phone='".$new_phone."',status='".$status."'WHERE user_id='".$user_id."'";
            }
            $exe=mysqli_query($con,$query) or die(mysqli_error());
            if($exe)
            {
                header("Location: profile.php?id=$user_id");
            }
            mysqli_close($con);
        }
    }
?>
