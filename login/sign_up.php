<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['full_name']) &&
            !empty($_POST['user_name']) &&
            !empty($_POST['user_email']) &&
            !empty($_POST['user_password']) &&
            !empty($_POST['confirm_password']) &&
            !empty($_POST['user_phone']))
        {
            include '../database/dbconnect.php';
            $fullname = $_POST['full_name'];
            $username = $_POST['user_name'];
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
                header("Location: ../order/order.html");
            }
            mysql_close($conn);
        }
        else {
            include("sign_up.html");
            echo "<script>
            document.getElementById('error_signup').innerHTML = 'Please fill all the required field';
            </script>";
            header("Location: sign_up.html");
        }
    }
?>
