<?php
     include("db.php");
     session_start();

     // Accessing sender and receiver id
     $sender_id = $_GET['sender_id'];
     $receiver_id = $_GET['receiver_id'];

     mysqli_query($db, "DELETE FROM message WHERE (player_id1 = $sender_id AND player_id2 = $receiver_id) OR
                                               (player_id1 = $receiver_id AND player_id2 = $sender_id);");

     header("location: chat.php");
?>
