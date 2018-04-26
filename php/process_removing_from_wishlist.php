<?php
    include("db.php");
    session_start();

    // Requesting name of the game and player id
    $game_name = $_GET['game_name'];
    $player_id = $_SESSION['player_id'];

    echo $game_name;
    echo $player_id;

    // Query for removing  game from the wishlist
    $remove_cart = "DELETE FROM wishlist WHERE player_id = $player_id AND game_name = '$game_name'";

    // Executing the query
    $remove_exec = mysqli_query($db, $remove_cart);

    echo mysqli_num_rows($remove_exec);

    if(!$remove_exec)
    {
        echo "<h3> ERROR </h3>";

        echo "<a href = 'store.php'> Go back to store </a>";
    }
    else
    {
        echo "<h3> Game is succesfully removed from your wishlist! </h3>";

        header("location: wishlist.php");

        exit();
    }

?>
