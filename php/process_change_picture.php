<?php
    include("db.php");
    session_start();
    //var_dump($_FILES);
    $player_id = $_SESSION['player_id'];


    //This is for uploading the image into the hizliresim.com and getting the web address into the db.

    $fileName = mysqli_escape_string($db, $_FILES['player_picture']['name']);
    $fileTmpName = mysqli_escape_string($db, file_get_contents($_FILES['player_picture']['tmp_name']));
    $fileSize = $_FILES['player_picture']['size'];
    $fileError = $_FILES['player_picture']['error'];
    $fileType = mysqli_escape_string($db, $_FILES['player_picture']['type']);

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 900000){
                $FileNameNew = uniqid('', true).".".$fileActualExt;  
                echo"upload successful!";

                // Inserting query for player table
                $insert_query = "UPDATE player SET profile_picture = '$FileNameNew' , profile_image = '$fileTmpName' WHERE player_id = $player_id;";

                mysqli_query($db, $insert_query);
                echo "<br><a href = 'profile.php'> Go back to your profile </a>";

            }
            else{
                echo 'Your file is too big';
            }
        }
        else{
            echo 'Something went wrong';
        }
    }
    else{
        echo 'You can\'t upload that!';
    }


?>
