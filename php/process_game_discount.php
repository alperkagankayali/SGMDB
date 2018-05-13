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
			if((int)$_POST['game_price'. $array['game_name']] < (int)$money['game_price']){
				$oldmoney = (int)$_POST['game_price'. $array['game_name']];
				$discount = (int)$money['game_price'];
				$new_money = $oldmoney - $discount;
				$discount_query = "INSERT INTO discount(discount_id, amount, name) VALUES (NULL, '$oldmoney', '$gn');";
				
				//The company will be able to make discounts more than one.
				$resultdiscount = mysqli_query($db, $discount_query);
				if($resultdiscount){
					echo "upload successful! <br>";
					$event_name = $_POST['event_name'. $array['game_name']];
					$event_query = "SELECT event_id, event_type, MAX(start_date) as recent FROM event WHERE event_type = '$event_name' GROUP BY event_type";
					$eventquery = mysqli_query($db, $event_query);
					$counter = mysqli_num_rows($eventquery);
					$event = $eventquery->fetch_assoc();
					if($counter > 0){
						$event_id = $event['event_id'];
						$select_discount = "SELECT MAX(discount_id) as discount_id FROM discount";
						$discountquery = mysqli_query($db, $select_discount);
						$extracting_id = $discountquery->fetch_assoc();
						$discount_id = $extracting_id['discount_id'];
						$contains_query = "INSERT INTO contains(event_id, discount_id) VALUES ('$event_id', '$discount_id');";
						$resultcontains = mysqli_query($db, $contains_query);
						if($resultcontains){
							echo "<h2>Upload Completed!</h2>";
						}
						else{
							echo "<h2>Something Went Wrong!</h2>";
						}
					}
					else{
						echo "<h2>No Event is Found! Discount will be meaningless!</h2>";
					}
				}
				else{
					echo "something went wrong :(";
				}
				
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
?>
