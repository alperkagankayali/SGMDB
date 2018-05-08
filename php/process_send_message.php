<?php
    include("db.php");
    session_start();

    // Acess date
    $date = date("Y-m-d");

    // Sender and receiver ids
    $sender_id = $_GET['sender_id'];
    $receiver_id = $_GET['receiver_id'];
    $receiver_pp = $_GET['receiver_pp'];

    // Sender and Receiver usernames
    $sender_username = mysqli_query($db, "SELECT username FROM player WHERE player_id = $sender_id")->fetch_assoc()['username'];
    $receiver_username = mysqli_query($db, "SELECT username FROM player WHERE player_id = $receiver_id")->fetch_assoc()['username'];

    if($receiver_pp == null) $receiver_pp = "images/icons/avatar.png";

    // message text
    $message_text = mysqli_escape_string($db, $_POST['chat_field']);

    // Inserting into message table
    mysqli_query($db, "INSERT INTO message (player_id1, player_id2, message_text, message_date) VALUES ($sender_id, $receiver_id, '$message_text', '$date')");

    // ADDING NOTIFICATION
    $notification_text = "$sender_username messaged you!";

    // Inserting into notification
    mysqli_query($db, "INSERT INTO notification (notification_date, notification_status, notification_text) VALUES ('$date', 0, '$notification_text');");

    // Last inserted notif id
    $notification_id = mysqli_query($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];

    echo $notification_text;

    // Inserting into notify
    mysqli_query($db, "INSERT INTO notify (player_id, notification_id) VALUES ($receiver_id, $notification_id)");

    header("location: chat_screen.php?receiver_id=$receiver_id&receiver_pp=$receiver_pp");

?>
