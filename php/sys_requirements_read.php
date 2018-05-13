<?php

 if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
       session_start();
}
$id = $_SESSION['game_name'];
$imagequery = "SELECT game_about, system_file FROM game WHERE game_name = '$id'";
$access_query = mysqli_query($db, $imagequery);
while($row = mysqli_fetch_assoc($access_query)){
	$reqData = $row["system_file"];
	$array = explode("\n", $reqData);
	$_SESSION['game_requirements'] = $array;
	$reqData1 = $row["game_about"];
	$array1 = explode("\n", $reqData1);
	$_SESSION['game_about'] = $array1;
}
$_SESSION['game_name'] = NULL;
?>