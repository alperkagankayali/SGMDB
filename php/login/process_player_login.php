<?php
    include("../db.php");
    session_start();


    // Getting date from system
    $date = date("Y-m-d");

    // Accessing the login input fields
    $player_usr_email = mysqli_escape_string($db, $_POST['p_usr_email']);
    $player_password = mysqli_escape_string($db, $_POST['p_log_pass']);


    // SQL query for selecting rows
    $login_query = "SELECT * FROM player WHERE (username = '$player_usr_email' OR email = '$player_usr_email') AND password = '$player_password'";

    // Executing the query
    $result = mysqli_query($db, $login_query);

    // Number of rows
    $count_rows = mysqli_num_rows($result);

    // Result
    $player = $result->fetch_assoc();

    // Creating request for player_id
    $_SESSION['player_id'] = $player['player_id'];
    $_SESSION['player_pp'] = $player['profile_picture'];

    // Checking whether the result of query is empty or not
    if($count_rows > 0)
    {
        // inserting the last-active date
        $insert_date = "UPDATE stats SET last_active_date = '$date' WHERE player_id='".$player['player_id']."' ";

        // Executing the query
        mysqli_query($db, $insert_date);

        header("location: ../store.php");

        exit();
    }
    else
    {
        echo "<h3> Your username/email or password is incorrect! </h3>";

        echo "<a href = 'login-player.php'> Go back to login page </a>";
    }
?>
