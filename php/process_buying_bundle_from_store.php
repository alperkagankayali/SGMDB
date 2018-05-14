<?php
	  include("db.php");
      session_start();

      // Accessing date
      $date = date("Y-m-d");

      // Accessing the player id
      $player_id = $_SESSION['player_id'];

      // Query for accessing the balance of the wallet
      $access_balance_query = "SELECT wallet_id, balance FROM wallet WHERE player_id = $player_id;";
       // Executing the query
      $result_query = mysqli_query($db, $access_balance_query);

       // Result of query
      $wallet = $result_query->fetch_assoc();

      $wallet_id = $wallet['wallet_id'];

      if(mysqli_num_rows($result_query) == 0)
      {
         echo "<h3> You do not have any wallet! </h3> <a href = 'profile.php'> Go to your profile </a>";
      }

      // Accessing game name and game price
      $bundle_id = $_GET['bundle_id'];
      $bundle_price = $_GET['bundle_price'];

      $get_all_games_in_bundle = "SELECT game_name from gameBundle WHERE bundle_id =". $bundle_id .";";

      $game_names = mysqli_query($db, $get_all_games_in_bundle);
      $game_count = mysqli_num_rows($game_names);


 	  if($bundle_price <= $wallet['balance'])
      {
      		for($i = 0; $i < $game_count; $i++){
      			$game_name = $game_names->fetch_assoc();
	            // Adding the game to the library
	            $insert_to_library = "INSERT INTO library ( game_name, player_id, player_id_by)
	                            VALUES('".$game_name['game_name']."', $player_id, player_id_by);";

	            // Executing the query
	            mysqli_query($db, $insert_to_library);
        	}

            // SUCCESSFUL PURCHASE
            echo "<h3> Successful purchase! </h3> <a href = 'library.php'> Go back to your library </a>";
      }
      else
      {
            echo "<h3> You do not have enough balance! </h3> <a href = 'profile.php'> Go back to your profile </a>";
      }


?>
