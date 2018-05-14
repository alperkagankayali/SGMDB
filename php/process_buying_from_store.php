<?php
      include("process_buying_game.php");

      // Accessing the player id
      $player_id = $_SESSION['player_id'];

      // Accessing game name and game price
      $game_name = $_GET['game_name'];
      $game_price = $_GET['game_price'];

      $_SESSION['buygame'] = buyGame($game_name, $game_price, $player_id, $player_id);

      header("location: buying_result.php");

?>
