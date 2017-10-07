<html>
<head>
<title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/location.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>
<body>
    <script>
        function showEdit(editID,saveID,locID,dummylocID,currentlocID,formID,deleteID,cancelID) {
            showSave(editID,saveID);
            showCancel(deleteID,cancelID);
            var temp = document.getElementById(locID).innerHTML;
            document.getElementById(locID).style.display = "none";
            document.getElementById(dummylocID).value = temp;
            document.getElementById(currentlocID).value = temp;
            document.getElementById(formID).style.display = "block";
        }
        function showSave(editID,saveID) {
            document.getElementById(editID).style.display = "none";
            document.getElementById(saveID).style.display = "block";
        }
        function showCancel(deleteID,cancelID) {
            document.getElementById(deleteID).style.display = "none";
            document.getElementById(cancelID).style.display = "block";
        }
        function copyDummytoNewLoc(dummylocID,newlocID) {
            var temp = document.getElementById(dummylocID).value;
            document.getElementById(newlocID).value = temp;
        }
        function hideEdit(editID,saveID,locID,formID,deleteID,cancelID) {
            document.getElementById(editID).style.display = "block";
            document.getElementById(saveID).style.display = "none";
            document.getElementById(locID).style.display = "block";
            document.getElementById(formID).style.display = "none";
            document.getElementById(deleteID).style.display = "block";
            document.getElementById(cancelID).style.display = "none";
        }
        function validateAddLoc(docID) {
            var loc = document.getElementById(docID).value;
            if (loc == null || loc == "") {
                window.alert("Location can't be blank");
                return false;
            }
        }
    </script>
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
                                        <td>
                                            <div id='.'prefloc'.$i.'>'.$row['pref_loc'].'</div>
                                            <div id='.'form_prefloc'.$i.' style="display: none">
                                                <input type="text" style=" height: 100%, width: 100%;" id='.'dummy_prefloc'.$i.' onkeyup="copyDummytoNewLoc(\'dummy_prefloc'.$i.'\',\'new_prefloc'.$i.'\');">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="edit_operation">
                                                <div class="edit_button" id='.'edit_prefloc'.$i.' onClick="showEdit(\'edit_prefloc'.$i.'\',\'save_prefloc'.$i.'\',\'prefloc'.$i.'\',\'dummy_prefloc'.$i.'\',\'current_prefloc'.$i.'\',\'form_prefloc'.$i.'\',\'delete_prefloc'.$i.'\',\'cancel_edit'.$i.'\');">✎</div>
                                                <div id='.'save_prefloc'.$i.' style="display: none">
                                                    <form name="edit_prefloc_form" method="POST" action="updateLocation.php" style="display: inline;" onsubmit="return validateAddLoc(\'dummy_prefloc'.$i.'\')">
                                                        <input class="save_button" type="submit" value="Save">
                                                        <input type="hidden" name="current_prefloc" id='.'current_prefloc'.$i.'>
                                                        <input type="hidden" name="new_prefloc" id='.'new_prefloc'.$i.'>
                                                        <input type="hidden" name="user_id" value="'.$user_id.'">
                                                    </form>
                                                </div>
                                                <div class="delete_button" id='.'delete_prefloc'.$i.'><a href=updateLocation.php?id='.urlencode($user_id).'&loc='.urlencode($row['pref_loc']).'>✖</a></div>
                                                <div class="cancel_button" id='.'cancel_edit'.$i.' style="display: none;" onClick="hideEdit(\'edit_prefloc'.$i.'\',\'save_prefloc'.$i.'\',\'prefloc'.$i.'\',\'form_prefloc'.$i.'\',\'delete_prefloc'.$i.'\',\'cancel_edit'.$i.'\');">Cancel</div>
                                            </div>
                                        </td>
                                    </tr>';
                            $i++;
                        }
                    }
                ?>

            </table>

        </div>
        <div class="add_loc_frame">
            <h2>Add New Location</h2>
            <form name="add_location" action="updateLocation.php" method="POST" onsubmit="return validateAddLoc('add_newloc')">
                <input type="text" id="add_newloc" name="new_location">
                <input type="hidden" name="hidden_userid" value= <?php echo $user_id ?>>
                <input type="submit" value="ADD" class="button green add">
            </form>
        </div>
        <a href=<?php echo 'profile.php?id='.$user_id; ?>><div class="button red back">BACK</div></a>
    </div>
</body>
</html>
