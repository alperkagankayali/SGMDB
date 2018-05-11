<?php

    if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
        session_start();
    }

    // ID of the player logged on
    $player_id = $_SESSION['player_id'];

    // Status of the player
    $isOnGame = mysqli_query($db, "SELECT status FROM player WHERE player_id = $player_id")->fetch_assoc()['status'];

    if($isOnGame == 2)
    {
        $game_name = mysqli_query($db, "SELECT game_name FROM play WHERE player_id2 = $player_id ORDER BY session_id DESC")->fetch_assoc()['game_name'];

        header("location: gameplay.php?game_name=".$game_name);
    }
?>
