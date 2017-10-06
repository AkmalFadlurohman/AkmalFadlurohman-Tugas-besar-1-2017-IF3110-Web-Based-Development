<?php
    include '../database/dbconnect.php';
    $user_id = urldecode($_GET['id']);
    $deletedLoc = urldecode($_GET['loc']);
    $query = mysqli_query($con,"DELETE FROM driver_prefloc WHERE driver_id='".$user_id."' AND pref_loc='".$deletedLoc."'") or die(mysqli_error($con));
    mysqli_close($con);
    if ($query) {
        header("Location: edit_location.php?id=$user_id");
    }
?>
