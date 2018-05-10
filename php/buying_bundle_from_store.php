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
      var_dump($buying_result);
      //header("location: buying_result.php");

?>