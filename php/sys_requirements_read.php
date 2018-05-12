<?php

 if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
       session_start();
}
$id = $_SESSION['company_name'];
$imagequery = "SELECT system_requirements, system_file FROM game WHERE company_name = '$id'";
$access_query = mysqli_query($db, $imagequery);
while($row = mysqli_fetch_assoc($access_query)){
	$reqData = $row["system_file"];
	$array = explode("\n", $reqData);
	$_SESSION['game_requirements'] = $array;
}

?>