<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            include '../database/dbconnect.php';
            $user = $_POST['user_name'];
            $pass = $_POST['user_password'];
            $query=mysql_query("SELECT * FROM user WHERE username='".$user."' AND password='".$pass."'") or die(mysql_error());
            
            $numrows=mysql_num_rows($query);
            if($numrows!=0)
            {
                while($row=mysql_fetch_assoc($query))
                {
                    $dbusername=$row['username'];
                    $dbpassword=$row['password'];
                }
                
                if($user == $dbusername && $pass == $dbpassword)
                {
                    header("Location: ../order/order.html");
                }
            } else {
                include("login.html");
                echo "<script>
                document.getElementById('error_credential').innerHTML = 'Invalid username or password!';
                </script>";
                header("Location: login.html");
            }
            mysql_close();
        }
    }
?>
