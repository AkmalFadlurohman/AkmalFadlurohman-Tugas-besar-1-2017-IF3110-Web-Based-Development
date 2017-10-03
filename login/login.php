<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            include '../database/dbconnect.php';
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];
            $query = mysql_query("SELECT * FROM user WHERE username='".$username."' AND password='".$password."'") or die(mysql_error());
            
            $numrows=mysql_num_rows($query);
            if($numrows!=0)
            {
                while($row=mysql_fetch_assoc($query))
                {
                    $dbusername=$row['username'];
                    $dbpassword=$row['password'];
                    $user_id=$row['user_id'];
                }
                //echo $user_id;
                if($username == $dbusername && $password == $dbpassword)
                {
                    header("Location: ../profile_page/profile.php?id=$user_id%26&username=$username");
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
