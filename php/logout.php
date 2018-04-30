<?php
    include("db.php");
    session_start();

    $player_id = $_SESSION['player_id'];

    session_unset();

    if(session_destroy())
    {
        // Set status 0 - offline
        $update_status = "UPDATE player SET status = 0 WHERE player_id= $player_id";

        mysqli_query($db, $update_status);

        header("location: login/login-player.php");
    }

    exit();
?>
