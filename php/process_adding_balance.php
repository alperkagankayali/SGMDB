<?php
    include("db.php");
    session_start();

    // Accessing the player id logged in
    $player_id = $_SESSION['player_id'];

    // Acessing the wallet input
    $payment_method = mysqli_escape_string($db, $_POST['payment_method']);
    $card_number = mysqli_escape_string($db, $_POST['card_number']);
    $expiration_date = mysqli_escape_string($db, $_POST['wallet_exp_date']);
    $security_code = mysqli_escape_string($db, $_POST['security_code']);
    $balance = mysqli_escape_string($db, $_POST['balance']);

    // Acessing wallet id
    $wallet_id = $_SESSION['wallet_id'];

    // Access wallet information
    $access_wallet = "SELECT * FROM wallet WHERE wallet_id = $wallet_id";

    // Execute the query
    $wallet_result = mysqli_query($db, $access_wallet);

    // Result of the query
    $wallet = $wallet_result->fetch_assoc();

    if($payment_method == $wallet['payment_method'] && $card_number == $wallet['card_number'] && $expiration_date == $wallet['expiration_date'] && $security_code == $wallet['security_code'])
    {
        // Update query for wallet
        $update_wallet = "UPDATE wallet SET balance = balance + $balance WHERE wallet_id = $wallet_id";

        // Executing the query
        mysqli_query($db, $update_wallet);

        echo "<h3> Balance is added successfully to your wallet! </h3>";

        echo "<a href = 'profile.php'> Go back to profile </a>";
    }
    else
    {
        echo "<h3> Entered card information is wrong! </h3>";

        echo "<a href = 'profile.php'> Go back to profile </a>";
    }
?>
