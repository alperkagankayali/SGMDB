<?php
    include("../db.php");
    session_start();
    // Accessing data from input fields from login page of player
    $player_first_name = mysqli_escape_string($db, $_POST['player_first_name']);
    $player_mid_name = mysqli_escape_string($db, $_POST['player_mid_name']);
    $player_last_name = mysqli_escape_string($db, $_POST['player_last_name']);
    $player_username = mysqli_escape_string($db, $_POST['player_username']);
    $player_email = mysqli_escape_string($db, $_POST['player_email']);
    $player_password = mysqli_escape_string($db, $_POST['player_password']);
    $birthdate = mysqli_escape_string($db, $_POST['player_b_date']);
    $repeated_password = mysqli_escape_string($db, $_POST['psw-repeat']);

    $fileTmpName = "";
    $FileNameNew = "";
    $fileActualExt = "";
    $fileError = -1;
    $fileSize = -1;
    //This is for uploading the image into the hizliresim.com and getting the web address into the db.
    if(($_FILES['player_picture']['name'] != "")){
        $fileName = mysqli_escape_string($db, $_FILES['player_picture']['name']);
        $fileTmpName = mysqli_escape_string($db, file_get_contents($_FILES['player_picture']['tmp_name']));
        $fileSize = $_FILES['player_picture']['size'];
        $fileError = $_FILES['player_picture']['error'];
        $fileType = mysqli_escape_string($db, $_FILES['player_picture']['type']);

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
    
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 900000){
                    $FileNameNew = uniqid('', true).".".$fileActualExt;  
                    echo"upload successful!";
                }
                else{
                    echo 'Your file is too big';
                }
            }
            else{
                echo 'Something went wrong';
            }
        }
        else{
            echo 'You can\'t upload that!';
        }
    }

    // Calculating age of the player
    $age = 2018 - (int)(substr($birthdate,0, 4));

    // Inserting query for player table
    $insert_query = "INSERT INTO player (email, username, password, firstname, middlename, lastname, birth_date, profile_picture, profile_image, status, age)
                               VALUES ('$player_email', '$player_username', '$player_password','$player_first_name', '$player_mid_name', '$player_last_name', '$birthdate', '$FileNameNew', '$fileTmpName', 0, $age);";

    $result1 = ($player_password == $repeated_password);

    // Check the password match
    if(!$result1)
    {
        echo "<h3> Passwords do not match! </h3>";

        echo "<a href = 'signup-player.php'> Go back to login page </a>";
    }

    else
    {
        // Executes the query
        $result0 = mysqli_query($db, $insert_query);

        // Check if query is successful
        if(!$result0)
        {
            echo "<h3> This username or email is already used! </h3>";

            echo "<a href = 'signup-player.php'> Go back to login page </a>";
        }
        else
        {
            $access_player_query = "SELECT player_id FROM player WHERE username = '$player_username'";

            // Executing the query
            $access_exec = mysqli_query($db, $access_player_query);

            // Result
            $player = $access_exec->fetch_assoc();

            $player_id = $player['player_id'];

            // Inserting player info to stats
            $insert_stats = "INSERT INTO stats (last_active_date, level, player_id)
                             VALUES (null, 1, $player_id)";

            mysqli_query($db, $insert_stats);

            echo "<h3> Account is created successfully! </h3>";

            echo "<a href = '../login/login-player.php'> Go back to login page </a>";
        }
    }
?>
