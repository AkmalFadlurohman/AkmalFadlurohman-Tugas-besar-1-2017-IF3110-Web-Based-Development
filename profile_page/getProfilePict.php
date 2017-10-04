<?php
    $user = $_GET['username'];
    include '../database/dbconnect.php';
    $query=mysqli_query($con,"SELECT pict FROM user WHERE username='".$user."'") or die(mysql_error());
    $row=mysqli_fetch_assoc($query);
    mysqli_close($con);
    if (isset($row['pict'])) {
        header("Content-type: image/jpeg");
        echo $row['pict'];        
    }
?>
