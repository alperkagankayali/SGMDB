<?php
    include("db.php");
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
    $profile_picture = mysqli_escape_string($db, $_POST['player_picture']);

    // Calculating age of the player
    $age = 2018 - explode('-', $birthdate)[0];

    // Inserting query for player table
    $insert_query = "INSERT INTO player (email, username, password, firstname, middlename, lastname, birth_date, profile_picture, status, age)
                               VALUES ('$player_email', '$player_username', '$player_password','$player_first_name', '$player_mid_name', '$player_last_name', '$birthdate', '$profile_picture', 0, $age);";

    // Executes the query
    $result0 = mysqli_query($db, $insert_query);

    $result1 = ($player_password == $repeated_password);

    // Check the password match
    if(!$result1)
    {
        echo "<h3> Passwords do not match! </h3>";

        echo "<a href = 'login-player.php'> Go back to login page </a>";
    }

    else
    {
        // Check if query is successful
        if(!$result0)
        {
            echo "<h3> This username or email is already used! </h3>";

            echo "<a href = 'login-player.php'> Go back to login page </a>";
        }
        else
        {
            header("location: login-player.php");

            exit();
        }
    }
?>
