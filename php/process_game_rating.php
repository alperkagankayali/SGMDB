<?php
    include("db.php");
    session_start();

    // Acessing the game name and input rating
    $game_name = $_GET['game_name'];
    $rating = mysqli_escape_string($db, $_POST['rating']);


    // Calculating average rating - sum_of_all_ratings
    //                              -----------------
    //                              number_of_ratings

    // Updating the game rating
    mysqli_query($db, "UPDATE game SET num_of_ratings = num_of_ratings + 1 WHERE game_name = '$game_name'");

    mysqli_query($db, "UPDATE game SET rating = (rating * (num_of_ratings - 1) + $rating) / num_of_ratings WHERE game_name = '$game_name'");

    // returning back to the game information screen
    header("location: game_information.php?game_name=".$game_name);


?>
