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
        }
    }
?>
