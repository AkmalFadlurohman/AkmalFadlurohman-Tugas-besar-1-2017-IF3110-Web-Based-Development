<?php //if (!isset($_SESSION['user'])) die("<br /><br />You must be logged in to view this page");?>
<html>
<head>
    <title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/switch.css">
</head>
<body>
    <div class="frame" id="edit_profile_page">
        <div class="header">
            <?php include '../template/header.php';?>
        </div>
        <div class="menu">
            <?php include '../template/menu.php';?>
        </div>
        <h1>Edit Profile</h1>
        <div class="edit_profile_frame">
            <form name="edit_identity" method="POST" action="" >
                <div>
                    <div style="display: inline-block; position: relative; margin-left: 20px; height: 100px; width: 300px;">
                        <div class="edit_image_frame">
                            <img id="edit_profile_pict" src="default_profile.jpeg">
                        </div>
                        <div class="select_pict">
                            <input id="file_name" type="text" readonly="readonly">
                        </div>
                        <div class="browse_file">
                            <input type="file" class="upload_file" onchange="showFileName(this);">
                        </div>
                    </div>
                    <div style="display: inline; position: relative; margin-left: 20px; top: 20px;">
                        <div style="display: inline-block; position: relative; height: 100px; width: 100px;">
                            <div style="height: 30px;">
                                Your Name
                            </div>
                            <div style="height: 30px;">
                                Phone
                            </div>
                            <div style="height: 30px;">
                                Status Driver
                            </div>
                        </div>
                        <div style="display: inline-block; position: absolute; height: 100px; width: 250px;">
                            <div style="height: 30px; margin-left: 10px;">
                                <input name="edit_name" type="text" placeholder="New name" style="height: 20px; width: 260px;">
                            </div>
                            <div style="height: 30px; margin-left: 10px;">
                                <input name="edit_phone" type="text" placeholder="New email" style="height: 20px; width: 260px;">
                            </div>
                            <div style="height: 30px; margin-left: 10px;">
                                <label class="switch" style="float: right;">
                                    <input type="checkbox" value="Yes">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="button" style="float: left;"><a href="profile.php">BACK</a></button>
                    <input type="submit" value="SAVE" style="float: right;" class="button">
                </div>
            </form>
        </div>
    </div>
    <script>
        function showFileName(inputFile) {
            var arrTemp = inputFile.value.split('\\');
            document.getElementById("file_name").value = arrTemp[arrTemp.length - 1];
        }
    </script>
</body>
</html>
