<?php
    include("db.php");
    session_start();

    // Requesting name of the game and player id
    $game_name = $_GET['game_name'];
    $player_id = $_SESSION['player_id'];

    // Query for adding  game to the cart
    $insert_cart = "INSERT INTO cart (game_name, player_id)
                    VALUES ('$game_name', $player_id)";

    // Executing the query
    $insert_exec = mysqli_query($db, $insert_cart);

    // the game is already in the cart
    if(!$insert_exec)
    {
        echo "<h3> This game is already in your cart! </h3>";

        echo "<a href = 'store.php'> Go back to store </a>";
    }
    else
    {
        echo "<h3> Game is added to the cart successfully! </h3>";

        header("location: cart.php");

        exit();
    }

?>
