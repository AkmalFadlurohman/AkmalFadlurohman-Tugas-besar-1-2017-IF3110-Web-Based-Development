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
            
            $query = mysql_query("INSERT INTO user (name,email,phone,username,password,status,pict) VALUES ('$fullname', '$email', '$phone', '$username', '$password', '$status',DEFAULT)") or die(mysql_error());
            if($query)
            {
                session_start();
                $_SESSION['user'] = $username;
                if ($status == "customer") {
                    header("Location: ../order/order.php");
                } else {
                    header("Location: ../profile_page/profile.php");
                }
            }
            mysql_close();
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
                $query = mysql_query("SELECT * FROM user WHERE username='".$value."'") or die(mysql_error());
                $numrows=mysql_num_rows($query);
            } else if ($key == "user_email") {
                $query = mysql_query("SELECT * FROM user WHERE email='".$value."'") or die(mysql_error());
                $numrows=mysql_num_rows($query);
            }
            if ($numrows != 0) {
                echo " X";
            } else {
                echo " Ok";
            }
            mysql_close();
        }
    }
?>
