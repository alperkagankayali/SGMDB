<?php
      include("process_buying_game.php");

      // Query for accessing all the games in the cart
      $access_cart = "SELECT game_name FROM cart
                      WHERE player_id = $player_id;";

      // Accessing the player id
      $player_id = $_SESSION['player_id'];

      // Executing the query
      $access_exe = mysqli_query($db, $access_cart);

      // number of games in cart
      $counter = mysqli_num_rows($access_exe);

      // Total price of the games
      $total_price = 0;

      // Array of prices
      $prices = array();

      // getting total price of the games in cart
      for($i = 0; $i < $counter; $i++)
      {
          $game = $access_exe->fetch_assoc();

          $game_name = $game['game_name'];

          $game_price = mysqli_query($db, "SELECT game_price FROM game WHERE game_name = '$game_name'")->fetch_assoc()['game_price'];

          $total_price += $game_price;

          array_push($prices, $game_price);
      }

      // Reexecute the query
      $access_exe = mysqli_query($db, $access_cart);

      // checking total price
      if($total_price <= $wallet['balance'])
      {

          for($j = 0; $j < $counter; $j++)
          {
              $game = $access_exe->fetch_assoc();

              $game_name = $game['game_name'];
              $game_price = $prices[$j];

              $result = buyGame($game_name, $game_price, $player_id);

              if($j == ($counter - 1))
              {
                  $_SESSION['buygame'] = $result;

                  header("location: buying_result.php");
              }
          }
      }
      else
      {
          echo "<h3> You do not have enough balance </h3>";

          echo "<a href = 'profile.php'> Go back to your profile </a>";
      }

?>
