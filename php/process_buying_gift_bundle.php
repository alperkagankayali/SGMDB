<?php
      include("process_buying_game.php");

      // System date
      $notif_date = date("Y-m-d");

      // Accessing the player id
      $player_id = $_SESSION['player_id'];

      $receiver_id = $_GET['receiver_id'];


      // Accessing game names and game prices
      $Text = urldecode($_REQUEST['game_info']);
      //echo $Text;
      $game_names = json_decode($Text);
      //print_r($game_names);
      $array = json_decode(json_encode($game_names), True);
      //echo (array_values($array)[0]);
      $buying_result = array();

      //var_dump($array);


      // Accessing receiver's username
      $buyes_username = mysqli_query($db, "SELECT username FROM player WHERE player_id = $player_id")->fetch_assoc()['username'];

      foreach($array as $game_name => $price){
            //echo $price;
            $buying_result[$game_name] = buyGame($game_name, $price, $receiver_id);

            if($buying_result[$game_name] == "<h3> Successful purchase! </h3> <a href = 'library.php'> Go back to your library </a>"){
                  // ADDING NOTIFICATION
                  $notification_text = "$buyes_username"." bought you $game_name as a gift!";

                  // Inserting into notification
                  mysqli_query($db, "INSERT INTO notification (notification_date, notification_status, notification_text) VALUES ('$notif_date', 0, '$notification_text');");

                  // Last inserted notif id
                  $notification_id = mysqli_query($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];

                  //echo $notification_text;

                  // Inserting into notify
                  mysqli_query($db, "INSERT INTO notify (player_id, notification_id) VALUES ($receiver_id, $notification_id)");
            }
      }
      



      foreach($buying_result as $game_name => $buying_result)
      {
            if($buying_result == "<h3> Successful purchase! </h3> <a href = 'library.php'> Go back to your library </a>")
                  echo "Succesfully gifted " . $game_name . " with %20 discount<br>";
            else if( $buying_result == "<h3> You do not have any wallet! </h3> <a href = 'profile.php'> Go to your profile </a>"){

                  echo $buying_result;
                  break;
            }
            else echo $buying_result;
      }

      echo "<br><a href = 'library.php'> Go back to your library </a>";


?>
