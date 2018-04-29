<?php
    include("db.php");
    session_start();

    // Accessing the player id logged in
    $player_id = $_SESSION['player_id'];

    // Delete query for wallet
    $remove_wallet = "DELETE FROM wallet WHERE player_id = $player_id;";

    echo $player_id;

    // Executing the query
    $remove_result = mysqli_query($db, $remove_wallet);

    if($remove_result)
    {
        echo "<h3> Wallet is successfully removed! </h3>";
    }
    else
    {
        echo "<h3> ERROR occured! </h3>";
    }
    echo "<a href = 'profile.php'> Go back to profile </a>";
?>
