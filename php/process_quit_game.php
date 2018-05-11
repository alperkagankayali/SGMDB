<?php
    include("db.php");
    session_start();

    // Player ID and Game name
    $player_id = $_SESSION['player_id'];
    $game_name = $_GET['game_name'];

    $player_ids = null;

    if(isset($_SESSION['player_ids'])) $player_ids = $_SESSION['player_ids'];

    // Start time
    $start_time_str = $_GET['start_time'];
    $start_time = strtotime($start_time_str);

    // Quit time
    $quit_time_str = date("Y-m-d H:i:s");
    $quit_time = strtotime($quit_time_str);

    // Duration
    $duration = round(abs($quit_time - $start_time));

    // Converting into hour and minute
    $duration = round($duration / 3600, 3);


    // Setting sender player's status to 2 - In Game
    mysqli_query($db, "UPDATE player SET status = 1 WHERE player_id = $player_id");

    // Updating game experience
    $update_play_hour = "UPDATE game_experience SET play_hour = play_hour + $duration WHERE player_id = $player_id AND game_name = '$game_name'";

    mysqli_query($db, $update_play_hour);

    $total_play_hour =  mysqli_query($db, "SELECT play_hour FROM game_experience WHERE player_id = $player_id AND game_name = '$game_name'")->fetch_assoc()['play_hour'];

    if($duration >= 1)
    {
        $update_game_experience = "UPDATE game_experience SET experience += 50 WHERE player_id = $player_id";

        mysqli_query($db, $update_game_experience);
    }

    if($player_ids != null)
    {
        for($i = 0; $i < sizeOf($player_ids); $i++)
        {
            // Updating game experience
            $update_play_hour = "UPDATE game_experience SET play_hour = play_hour + $duration WHERE player_id = $player_ids[$i] AND game_name = '$game_name'";

            mysqli_query($db, $update_play_hour);

            $total_play_hour =  mysqli_query($db, "SELECT play_hour FROM game_experience WHERE player_id = $player_ids[$i] AND game_name = '$game_name'")->fetch_assoc()['play_hour'];

            if($duration >= 1)
            {
                $update_game_experience = "UPDATE game_experience SET experience += 50 WHERE player_id = $player_ids[$i]";

                mysqli_query($db, $update_game_experience);
            }
        }
    }


    // Setting players' status from 2 - In Game to 1 - Online
    if($player_ids != null)
    {
        for($k = 0; $k < sizeOf($player_ids); $k++)
        {
            $player_id_i = $player_ids[$k];

            mysqli_query($db, "UPDATE player SET status = 1 WHERE player_id = $player_id_i;");
        }
    }

    header("location: profile.php");
?>
