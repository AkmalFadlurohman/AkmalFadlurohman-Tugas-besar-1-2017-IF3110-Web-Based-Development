<?php
    define('dbserver', '127.0.0.1:3306');
    define('dbuser', 'root');
    define('dbpass', '');
    define('dbname', 'PR_Ojek');
    $con=mysqli_connect(dbserver, dbuser, dbpass) or die(mysql_error());
    mysqli_select_db($con,dbname) or die('Could not select database '.mysql_error());
?>
