<?php
    define('dbserver', '127.0.0.1:3306');
    define('dbuser', 'root');
    define('dbpass', '');
    define('dbname', 'PR_Ojek');
    mysql_connect(dbserver, dbuser, dbpass) or die(mysql_error());
    mysql_select_db(dbname) or die('Could not select database '.mysql_error());
?>
