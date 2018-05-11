<?php
      include("process_buying_game.php");

      // Accessing the player id
      $player_id = $_SESSION['player_id'];

      // Accessing game name and game price
      $Text = urldecode($_REQUEST['game_info']);
      //echo $Text;
      $game_names = json_decode($Text);
      //print_r($game_names);
      $array = json_decode(json_encode($game_names), True);
      //echo (array_values($array)[0]);
      $buying_result = array();
      foreach($array as $game_name => $price){
      	//echo $price;
      	$buying_result[$game_name] = buyGame($game_name, $price, $player_id);
      }

      foreach($buying_result as $game_name => $buying_result)
      {
            if($buying_result == "<h3> Successful purchase! </h3> <a href = 'library.php'> Go back to your library </a>")
                  echo "Succesfully purchased " . $game_name . " with %20 discount<br>";
            else if( $buying_result == "<h3> You do not have any wallet! </h3> <a href = 'profile.php'> Go to your profile </a>"){

                  echo $buying_result;
                  break;
            }
            else echo $buying_result;
      }

      echo "<br><a href = 'library.php'> Go back to your library </a>";


?>