<html>
<head>
<title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/location.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>
<body>
    <div class="frame">
        <div class="header">
        <?php
            $user_id = $_GET['id'];
            include '../database/dbconnect.php';
    
            $query=mysqli_query($con,"SELECT * FROM user WHERE user_id='".$user_id."'") or die(mysqli_error());
    
            if(mysqli_num_rows($query)!=0)
            {
                $row=mysqli_fetch_assoc($query);
                $username = $row['username'];
                include("../template/header.php");
            }
            
            ?>
        </div>
    <div class="menu_container">
        <?php include'../template/menu.php';?>
        <script>
            document.getElementById("profile_link").setAttribute("class", "menu menu_active");
        </script>
    </div>
    <div class="editloc_container">
        <div class="subheader">
            <div class="title"><h1>Edit Preferred Location</h1></div>
        </div>
        <div class="display_loc_frame">
            <table>
                <tr>
                    <th>No</th>
                    <th>Locations</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $query=mysqli_query($con,"SELECT pref_loc FROM driver_prefloc WHERE driver_id='".$user_id."'") or die(mysqli_error());
                    if(mysqli_num_rows($query)!=0)
                    {
                        $i = 1;
                        while($row=mysqli_fetch_assoc($query)) {
                            echo    '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$row['pref_loc'].'</td>
                                        <td><div class="edit_button">✎</div><div class="delete_button"><a href=deletePrefLoc.php?id='.urlencode($user_id).'&loc='.urlencode($row['pref_loc']).'>✖</a></div></td>
                                    </tr>';
                            $i++;
                        }
                    }
                ?>
            </table>

        </div>
        <div class="add_loc_frame">
            <h2>Add New Location</h2>
            <form name="add_location" action="updateLocation.php" method="POST">
                <input type="text" name="new_location">
                <input type="text" id="hidden_userid" name="hidden_userid" style="display: none;">
                <input type="submit" value="ADD" class="button green add">
            </form>
        </div>
        <a href=<?php echo 'profile.php?id='.$user_id; ?>><div class="button red back">BACK</div></a>
    </div>
    <?php
        echo "<script>document.getElementById('hidden_userid').value =".$user_id."</script>";
    ?>
</body>
</html>
