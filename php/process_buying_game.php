<?php
    include("db.php");
    session_start();

    // Accessing date
    $date = date("Y-m-d");

    // Accessing player id
    $player_id = $_SESSION['player_id'];

    // Query for accessing the balance of the wallet
    $access_balance_query = "SELECT wallet_id, balance FROM wallet WHERE player_id = $player_id;";

    // Executing the query
    $result_query = mysqli_query($db, $access_balance_query);

    // Result of query
    $wallet = $result_query->fetch_assoc();

    $wallet_id = $wallet['wallet_id'];

    // Buying method
    function buyGame($game_name, $game_price, $player_id, $recevier_id)
    {
        global $date;
        global $wallet_id;
        global $wallet;
        global $db;

        // Controls
        if($wallet_id == null)
        {
            return "<h3> You do not have any wallet! </h3> <a href = 'profile.php'> Go to your profile </a>";
        }
        else if($game_price <= $wallet['balance'])
        {
            // Adding the game to the library
            $insert_to_library = "INSERT INTO library (game_name, player_id, player_id_by)
                                VALUES('$game_name', $recevier_id, $player_id);";

            // Executing the query
            $result = mysqli_query($db, $insert_to_library);

            // SUCCESSFUL PURCHASE
            return "<h3> Successful purchase! </h3> <a href = 'library.php'> Go back to your library </a>";
        }
        else
        {

            return "<h3> You do not have enough balance! </h3> <a href = 'profile.php'> Go back to your profile </a>";
        }

    }
?>
