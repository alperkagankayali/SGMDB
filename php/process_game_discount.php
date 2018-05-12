<?php
if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
        session_start();
}
var_dump($_POST);
$query = "SELECT game_name FROM game";
$access_query = mysqli_query($db, $query);
$counter = mysqli_num_rows($access_query);
for($i = 0; $i < $counter; $i++){
	$array = $access_query->fetch_assoc();
	if($_POST['game_price'. $array['game_name']] != ""){
		if(isset($_POST['check' . $array['game_name']])){
			$gn = $array['game_name'];
			$moneyquery = "SELECT game_price FROM game where game_name = '$gn'";
			$money_query = mysqli_query($db, $moneyquery);
			$money = $money_query->fetch_assoc();
			if((int)$_POST['game_price'. $array['game_name']] < (int)$money){
				$oldmoney = (int)$_POST['game_price'. $array['game_name']];
				$discont = (int)$money;
				$new_money = $oldmoney - $discont;
				
			}
			else{
				echo "<h2>Discount money is more than the game price!</h2>";
			}
		}
		else{
			echo "<h2>Check the checkbox!</h2>";
		}
	}
}
/*
$query = "SELECT * FROM game"; 
$access_query = mysqli_query($db, $query);
$counter = mysqli_num_rows($access_query);
for($i = 0; $i < $counter; $i = $i + 1)
{
  // Result
  $array = $access_query->fetch_assoc();
  $game_name = $array['game_name'];
  $game_logo = $array['game_logo'];


  if($game_name == null)
      continue;
}
*/
?>