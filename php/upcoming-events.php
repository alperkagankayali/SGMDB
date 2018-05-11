<?php
//include("db.php");
//session_start();
echo"<style>";
echo"div.relative {";
echo    "position: w3-col m2;";
echo"    left: 500px;";
echo"    border: 3px solid #73AD21;";
echo"}";
echo"</style>";
echo" <div class=\"w3-col m2\"> ";
$events = "SELECT * FROM event";
$event_years = "SELECT event_id, YEAR(start_date) as years FROM event GROUP BY event_id";
$access_event = mysqli_query($db, $events);
$access_year = mysqli_query($db, $event_years);
$counter = mysqli_num_rows($access_event);
//echo($counter);
$_SESSION["events"] = $access_event;
$_SESSION["years"] = $access_year;
$index = 1;
if($counter > 0){
	while(($row = mysqli_fetch_assoc($access_event)) && ($row1 = mysqli_fetch_assoc($access_year))){
		echo" <div class=\"w3-card w3-round w3-center\"> ";
		echo" <div class=\"w3-container w3-border white-font\"> ";
		echo"            <p>Upcoming Events:</p> ";
		echo"			 <img src=\"images/" . $row['event_image'] . "\"  alt=\" " . $row['event_type'] . "\" style=\"width:100%;\" id = $index> ";
		echo"            <p><strong>" . $row['event_type'] . " " . $row1['years']. "</strong></p>";
		echo"            <p><a class=\"w3-button w3-border w3-block w3-theme-l4\" href=\"event.php\" id = $index >Info</a></p>";
		echo"          </div>";
		echo"          </div>";
		echo"        <br>";
		$index++;
	}
}

echo"      <!-- End Right Column -->";
echo"      </div>";

?>
