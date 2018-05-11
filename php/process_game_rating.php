<?php
    include("db.php");
    session_start();

    $date = date("Y-m-d");

    // Acessing the game name and input rating and player id
    $player_id = $_SESSION['player_id'];
    $game_name = $_GET['game_name'];
    $rating = mysqli_escape_string($db, $_POST['rating']);

    // CHecking if the player has already rated the game
    $row_num = mysqli_num_rows(mysqli_query($db, "SELECT * FROM rate WHERE player_id = $player_id"));

    if($row_num == 0)
    {
        mysqli_query($db, "INSERT INTO rating (rating, rating_date) VALUES ($rating, '$date')");

        $rating_id = mysqli_query($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];

        mysqli_query($db, "INSERT INTO rate (rating_id, player_id, game_name) VALUES ($rating_id, $player_id, '$game_name')");
    }
    else
    {
        $rating_id = mysqli_query($db, "SELECT * FROM rate WHERE player_id = $player_id")->fetch_assoc()['rating_id'];

        mysqli_query($db, "UPDATE rating SET rating = $rating, rating_date = '$date' WHERE rating_id = $rating_id");
    }

    // returning back to the game information screen
    header("location: game_information.php?game_name=".$game_name);
?>
