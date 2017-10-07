<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['new_location'])) {
            include '../database/dbconnect.php';
            $user_id = $_POST['hidden_userid'];
            $new_loc = $_POST['new_location'];
            $query = mysqli_query($con,"INSERT INTO driver_prefloc (driver_id,pref_loc) VALUES ('$user_id', '$new_loc')") or die(mysqli_error($con));
            mysqli_close($con);
            if ($query) {
                header("Location: edit_location.php?id=$user_id");
            }
        } else if (!empty($_POST['new_prefloc'])) {
            $user_id = $_POST['user_id'];
            $current_prefloc = $_POST['current_prefloc'];
            $new_prefloc = $_POST['new_prefloc'];
            include '../database/dbconnect.php';
            $query = mysqli_query($con,"UPDATE driver_prefloc SET pref_loc = '$new_prefloc' WHERE driver_id = '$user_id' AND pref_loc = '$current_prefloc'") or die(mysqli_error($con));
            mysqli_close($con);
            if ($query) {
                header("Location: edit_location.php?id=$user_id");
            }
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        include '../database/dbconnect.php';
        $user_id = urldecode($_GET['id']);
        $deletedLoc = urldecode($_GET['loc']);
        $query = mysqli_query($con,"DELETE FROM driver_prefloc WHERE driver_id='".$user_id."' AND pref_loc='".$deletedLoc."'") or die(mysqli_error($con));
        mysqli_close($con);
        if ($query) {
            header("Location: edit_location.php?id=$user_id");
        }
    }
?>
