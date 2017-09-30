<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            $user = $_POST['user_name'];
            $pass = $_POST['user_password'];
            
            $dbhost = '127.0.0.1:3306';
            $dbuser = 'root';
            $dbpass = '';
            $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
            mysql_select_db('PR_Ojek') or die('Could not select database '.mysql_error());
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
                    header("Location: ../profile_page/profile.html");
                }
            } else {
                include("login.html");
                echo "<script>
                document.getElementById('error_credential').innerHTML = 'Invalid username or password!';
                </script>";
                header("Location: login.html");
            }
            mysql_close($conn);
        }
    }
    
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
