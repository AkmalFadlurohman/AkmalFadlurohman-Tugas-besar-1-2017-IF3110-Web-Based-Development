<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['full_name']) &&
            !empty($_POST['username']) &&
            !empty($_POST['user_email']) &&
            !empty($_POST['user_password']) &&
            !empty($_POST['confirm_password']) &&
            !empty($_POST['user_phone']))
        {
            include '../database/dbconnect.php';
            $fullname = $_POST['full_name'];
            $username = $_POST['username'];
            $email    = $_POST['user_email'];
            $password = $_POST['user_password'];
            $phone    = $_POST['user_phone'];
            
            if(isset($_POST['is_driver']))
            {
                $status = 'driver';
            }
            else
            {
                $status = 'customer';
            }
            
            $query = mysqli_query($con,"INSERT INTO user (name,email,phone,username,password,status,pict) VALUES ('$fullname', '$email', '$phone', '$username', '$password', '$status',DEFAULT)") or die(mysqli_error());
            if($query)
            {
                $getUserID = mysqli_query($con,"SELECT user_id FROM user WHERE username='".$username."'") or die(mysql_error());
                $row=mysqli_fetch_assoc($getUserID);
                $user_id=$row['user_id'];
                header("Location: ../profile_page/profile.php?id=?$user_id");
                if ($status == "customer") {
                    header("Location: ../order/order.php?id=?$user_id");
                } else {
                    header("Location: ../order/order.php?id=?$user_id");
                }
            }
            mysqli_close($con);
        }
        else {
            include("sign_up.html");
            echo "<script>
            document.getElementById('error_signup').innerHTML = 'Please fill all the required field';
            </script>";
            header("Location: sign_up.html");
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!empty($_GET['key'])) {
            $key = stristr($_GET['key'],'=',true);
            $value = substr(strstr($_GET['key'],'='),1);
            
            include '../database/dbconnect.php';
            
            if ($key == "username") {
                $query = mysqli_query($con,"SELECT * FROM user WHERE username='".$value."'") or die(mysqli_error());
                $numrows=mysqli_num_rows($query);
            } else if ($key == "user_email") {
                $query = mysqli_query($con,"SELECT * FROM user WHERE email='".$value."'") or die(mysqli_error());
                $numrows=mysqli_num_rows($query);
            }
            if ($numrows != 0) {
                echo " X";
            } else {
                echo " Ok";
            }
            mysqli_close($con);
        }
    }
?>
