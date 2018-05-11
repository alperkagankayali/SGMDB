<?php

if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
        session_start();
}
//var_dump($_GET);
//if(isset($_GET['id'])){
	//echo("entered here!");
	$id = $_SESSION['player_id'];
	$imagequery = "SELECT profile_picture, profile_image FROM player WHERE player_id = '$id'";
	$access_query = mysqli_query($db, $imagequery);
	while($row = mysqli_fetch_assoc($access_query)){
		$imageData = $row["profile_image"];
		$imageName = $row["profile_picture"];
		//echo $imageName;
		$fileExt = explode('.', $imageName);
    	$fileActualExt = strtolower(end($fileExt));
    	echo '"data:image/$fileActualExt;base64,'.base64_encode( $row['profile_image'] ).'"'; 
	}
	//echo "image/$fileActualExt";

	//header("Content-type: image/$fileActualExt");
	//echo $imageData;
//}

?>