<?php
    $user_id = $_GET['id'];
    include '../database/dbconnect.php';
    $query=mysqli_query($con,"SELECT pict FROM user WHERE user_id='".$user_id."'") or die(mysqli_error());
    $row=mysqli_fetch_assoc($query);
    mysqli_close($con);
    if (isset($row['pict'])) {
        header("Content-type: image/jpeg");
        echo $row['pict'];        
    }
?>
