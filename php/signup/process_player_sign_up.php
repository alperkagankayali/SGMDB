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
    $profile_picture = mysqli_escape_string($db, $_POST['player_picture']);

    // Calculating age of the player
    $age = 2018 - explode('-', $birthdate)[0];

    // Inserting query for player table
    $insert_query = "INSERT INTO player (email, username, password, firstname, middlename, lastname, birth_date, profile_picture, status, age)
                               VALUES ('$player_email', '$player_username', '$player_password','$player_first_name', '$player_mid_name', '$player_last_name', '$birthdate', '$profile_picture', 0, $age);";

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
            // Creating view for getting player id
            $create_view = "CREATE VIEW players_id AS
                            (SELECT player_id FROM player
                             WHERE username = '$player_username')";

            mysqli_query($db, $create_view);

            $access_player_query = "SELECT * FROM players_id";

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
