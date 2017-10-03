<?php
    $user = $_GET['username'];
    include '../database/dbconnect.php';
    $query=mysql_query("SELECT pict FROM user WHERE username='".$user."'") or die(mysql_error());
    $row=mysql_fetch_assoc($query);
    mysql_close();
    if (isset($row['pict'])) {
        header("Content-type: image/jpeg");
        echo $row['pict'];        
    }
?>
