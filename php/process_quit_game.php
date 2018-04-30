<?php
    include("db.php");
    session_start();

    // Player ID and Game name
    $player_id = $_SESSION['player_id'];
    $game_name = $_GET['game_name'];

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

    echo $duration;

    // Updating game experience
    $update_play_hour = "UPDATE game_experience SET play_hour = play_hour + $duration WHERE player_id = $player_id AND game_name = '$game_name'";

    mysqli_query($db, $update_play_hour);

    $total_play_hour =  mysqli_query($db, "SELECT play_hour FROM game_experience WHERE player_id = $player_id AND game_name = '$game_name'")->fetch_assoc()['play_hour'];

    if($duration >= 1)
    {
        $update_game_experience = "UPDATE game_experience SET  WHERE experience += 50";

        mysqli_query($db, $update_game_experience);
    }

    header("location: profile.php");


?>
