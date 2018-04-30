<?php
      include("db.php");
      session_start();

      // Access player id who adds friend
      $player_id1 = $_SESSION['player_id'];

      // Accesing the username of player that is wanted to be added friend
      $username = $_GET['username'];

      // Acessing player_id who is added as friend
      $player_id2 = mysqli_query($db, "SELECT player_id FROM player WHERE username = '$username'")->fetch_assoc()['player_id'];

      // Accessing date from the system
      $since_date = date("Y-m-d");

      // INSERTING INTO TABLE
      $insert_friend = "INSERT INTO friendship (player_id1, player_id2, since_date) VALUES ($player_id1, $player_id2, '$since_date')";

      // Execute the query
      mysqli_query($db, $insert_friend);

      $insert_friend = "INSERT INTO friendship (player_id1, player_id2, since_date) VALUES ($player_id2, $player_id1, '$since_date')";

      // Execute the query
      mysqli_query($db, $insert_friend);

      header("location: chat.php");
?>
