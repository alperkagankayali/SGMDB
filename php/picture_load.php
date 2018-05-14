<?php

if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
        session_start();
}

if(isset($_SESSION['company_name'])){
	if(is_array($_SESSION['company_name']))
		$id = $_SESSION['company_name']['company_name'];
	else
		$id = $_SESSION['company_name'];
	//var_dump($id);
	$imagequery = "SELECT company_logo as profile_picture, company_picture as profile_image FROM company WHERE company_name = '$id'";
}
if(isset($_SESSION['player_id'])){
	$id = $_SESSION['player_id'];
	$imagequery = "SELECT profile_picture, profile_image FROM player WHERE player_id = '$id'";
}
if(isset($_SESSION['player_id2'])){
	$id = $_SESSION['player_id2'];
	$imagequery = "SELECT profile_picture, profile_image FROM player WHERE player_id = '$id'";
}

if(isset($_SESSION['news_id'])){
	$id = $_SESSION['news_id'];
	$imagequery = "SELECT news_image as profile_picture, news_picture as profile_image FROM news WHERE news_id = '$id'";
}
if(isset(($_SESSION['event_id']))){
	$id = $_SESSION['event_id'];
	$imagequery = "SELECT event_image as profile_picture, event_picture as profile_image FROM event WHERE event_id = '$id'";
}
if(isset($_SESSION['game_name'])){
	$id = $_SESSION['game_name'];
	$imagequery = "SELECT game_logo as profile_picture, game_image as profile_image FROM game WHERE game_name = '$id'";
}

//var_dump($_GET);
//if(isset($_GET['id'])){
	//echo("entered here!");
	
	
$access_query = mysqli_query($db, $imagequery);
while($row = mysqli_fetch_assoc($access_query)){

	$imageData = $row["profile_image"];
	$imageName = $row["profile_picture"];
	//echo $imageData;
	//echo $imageName;
	$fileExt = explode('.', $imageName);
	$fileActualExt = strtolower(end($fileExt));
	//echo $fileActualExt;
	echo '"data:image/$fileActualExt;base64,'.base64_encode( $row['profile_image'] ).'"'; 
}
	//echo "image/$fileActualExt";
if(isset($_SESSION['game_name'])){
	$_SESSION['game_name'] = NULL;
}
if(isset($_SESSION['news_id'])){
	$_SESSION['news_id'] = NULL;
}
if(isset($_SESSION['player_id2'])){
	$_SESSION['player_id2'] = NULL;
}
if(isset($_SESSION['event_id'])){
	$_SESSION['event_id'] = NULL;
}
	//header("Content-type: image/$fileActualExt");
	//echo $imageData;
//}

?>