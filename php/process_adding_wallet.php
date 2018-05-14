<?php
    include("db.php");
    session_start();

    // Accessing the player id logged in
    $player_id = $_SESSION['player_id'];

    // Acessing the wallet input
    $payment_method = mysqli_escape_string($db, $_POST['payment_method']);
    $card_number =  mysqli_escape_string($db, $_POST['card_number']);
    $expiration_date = mysqli_escape_string($db, $_POST['wallet_exp_date']);
    $security_code = mysqli_escape_string($db, $_POST['security_code']);


    // Insert query for wallet
    $insert_wallet = "INSERT INTO wallet (balance, payment_method, card_number, expiration_date, security_code, player_id)
                      VALUES (0, '$payment_method', '$card_number', '$expiration_date', $security_code, $player_id)";


    // Executing the query
    mysqli_query($db, $insert_wallet);

    header("location: profile.php");
?>
