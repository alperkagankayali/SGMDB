<?php
      include("db.php");
      session_start();

      // Access player id who adds friend
      $player_id1 = $_SESSION['player_id'];
      $username1 = mysqli_query($db, "SELECT username FROM player WHERE player_id = $player_id1")->fetch_assoc()['username'];

      // Accesing the username of player that is wanted to be added friend
      $username2 = $_GET['username'];

      // Acessing player_id who is added as friend
      $player_id2 = mysqli_query($db, "SELECT player_id FROM player WHERE username = '$username2'")->fetch_assoc()['player_id'];

      // Accessing date from the system
      $since_date = date("Y-m-d");

      // INSERTING INTO TABLE
      $insert_friend = "INSERT INTO friendship (player_id1, player_id2, since_date) VALUES ($player_id1, $player_id2, '$since_date')";

      // Execute the query
      mysqli_query($db, $insert_friend);

      $insert_friend = "INSERT INTO friendship (player_id1, player_id2, since_date) VALUES ($player_id2, $player_id1, '$since_date')";

      // Execute the query
      mysqli_query($db, $insert_friend);


      // ADDING NOTIFICATION

      // System date
      $notif_date = date("Y-m-d");

      $notification_text = "You and $username1 are friends!";

      // Inserting into notification
      mysqli_query($db, "INSERT INTO notification (notification_date, notification_status, notification_text) VALUES ('$notif_date', 0, '$notification_text');");

      // Last inserted notif id
      $notification_id = mysqli_query($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];

      echo $notification_text;

      // Inserting into notify
      mysqli_query($db, "INSERT INTO notify (player_id, notification_id) VALUES ($player_id2, $notification_id)");



      header("location: chat.php");
?>
