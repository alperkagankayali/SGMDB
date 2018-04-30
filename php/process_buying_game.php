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

    if(mysqli_num_rows($result_query) == 0)
    {
       echo "<h3> You do not have any wallet! </h3> <a href = 'profile.php'> Go to your profile </a>";
    }

    // Buying method
    function buyGame($game_name, $game_price, $player_id)
    {
        global $date;
        global $wallet_id;
        global $wallet;
        global $db;

        // Controls

        if($game_price <= $wallet['balance'])
        {
            // STEP 1: Inserting payment to the selected game
            $insert_payment = "INSERT INTO payment (payment_date, cost, wallet_id)
                               VALUES ('$date', $game_price, $wallet_id)";

            // Executing the query
            mysqli_query($db, $insert_payment);

            // STEP 2: Accessing the payment id that is inserted
            $access_payment_id_query = "SELECT payment_id FROM payment WHERE wallet_id = $wallet_id ORDER BY payment_id DESC";

            // Executing the query
            $access_payment_exec = mysqli_query($db, $access_payment_id_query);

            // Result of the query
            $payment = $access_payment_exec->fetch_assoc();

            $payment_id = $payment['payment_id'];

            // STEP 3: Inserting the information to the buyGame table
            $insert_game = "INSERT INTO buyGame (player_id, payment_id, game_name)
                            VALUES ($player_id, $payment_id, '$game_name');";

            // Executing the query
            mysqli_query($db, $insert_game);

            // STEP 4: Decrement the balance of the wallet
            $update_balance = "UPDATE wallet SET balance = balance - $game_price WHERE wallet_id = $wallet_id;";

            // Execute update query
            mysqli_query($db, $update_balance);

            // STEP 5: Adding the game to the library
            $insert_to_library = "INSERT INTO library (game_name, player_id)
                                  VALUES('$game_name', $player_id);";

            // Executing the query
            mysqli_query($db, $insert_to_library);

            // STEP 6: Adding the game experience
            $insert_game_exp = "INSERT INTO game_experience (experience, play_hour, game_name, player_id)
                                VALUES (0, 0, '$game_name', $player_id)";

            // Executing the query
            mysqli_query($db, $insert_game_exp);

            // SET 7: deleting from wishlist and cart
            $remove_cart = "DELETE FROM cart WHERE player_id = $player_id AND game_name = '$game_name'";

            mysqli_query($db, $remove_cart);

            $remove_wishlist = "DELETE FROM wishlist WHERE player_id = $player_id AND game_name = '$game_name'";

            mysqli_query($db, $remove_wishlist);

            // SET 8: increasing the level of player
            $update_level = "UPDATE stats SET level = level + 1 WHERE player_id = $player_id";

            mysqli_query($db, $update_level);

            // SUCCESSFUL PURCHASE
            return "<h3> Successful purchase! </h3> <a href = 'library.php'> Go back to your library </a>";
        }
        else
        {
            return "<h3> You do not have enough balance! </h3> <a href = 'profile.php'> Go back to your profile </a>";
        }

    }
?>
