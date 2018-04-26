<?php
    include("../db.php");
    session_start();


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

    // Checking whether the result of query is empty or not
    if($count_rows > 0)
    {
        header("location: ../store.php");

        exit();
    }
    else
    {
        echo "<h3> Your username/email or password is incorrect! </h3>";

        echo "<a href = 'login-player.php'> Go back to login page </a>";
    }
?>
