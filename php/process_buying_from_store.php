<?php
      include("process_buying_game.php");

      // Accessing game name and game price
      $game_name = $_GET['game_name'];
      $game_price = $_GET['game_price'];

      $_SESSION['buygame'] = buyGame($game_name, $game_price);

      header("location: buying_result.php");

?>
