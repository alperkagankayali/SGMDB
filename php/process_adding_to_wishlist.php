<?php
    include("db.php");
    session_start();

    // Requesting name of the game and player id
    $game_name = $_GET['game_name'];
    $player_id = $_SESSION['player_id'];

    // Query for adding wished game to the list
    $insert_wish = "INSERT INTO wishlist (game_name, player_id)
                    VALUES ('$game_name', $player_id)";

    // Executing the query
    $insert_exec = mysqli_query($db, $insert_wish);

    // the game is already in the wishlist
    if(!$insert_exec)
    {
        echo "<h3> This game is already in your wishlist! </h3>";

        echo "<a href = 'store.php'> Go back to store </a>";
    }
    else
    {
        echo "<h3> Game is added to the wishlist successfully! </h3>";

        header("location: wish_list.php");

        exit();
    }

?>
