<?php
      include("process_buying_game.php");

      // System date
      $notif_date = date("Y-m-d");

      // Accessing the player id
      $player_id = $_SESSION['player_id'];

      // Accessing game name and game price
      $game_name = $_GET['game_name'];
      $game_price = $_GET['game_price'];
      $receiver_id = $_GET['receiver_id'];


      $_SESSION['buygame'] = buyGame($game_name, $game_price, $receiver_id);


      // Accessing receiver's username
      $buyes_username = mysqli_query($db, "SELECT username FROM player WHERE player_id = $player_id")->fetch_assoc()['username'];

      // ADDING NOTIFICATION
      $notification_text = "$buyes_username"." bought you $game_name as a gift!";

      // Inserting into notification
      mysqli_query($db, "INSERT INTO notification (notification_date, notification_status, notification_text) VALUES ('$notif_date', 0, '$notification_text');");

      // Last inserted notif id
      $notification_id = mysqli_query($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];

      echo $notification_text;

      // Inserting into notify
      mysqli_query($db, "INSERT INTO notify (player_id, notification_id) VALUES ($receiver_id, $notification_id)");

      header("location: buying_result.php");

?>