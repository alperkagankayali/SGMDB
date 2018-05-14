<?php
if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
        session_start();
}
$event_name = mysqli_escape_string($db, $_POST['event_name']);
$start_date = mysqli_escape_string($db, $_POST['start_date']);
$end_date = mysqli_escape_string($db, $_POST['end_date']);



$fileTmpName = "";
$FileNameNew = "";
$fileActualExt = "";
$fileError = -1;
$fileSize = -1;
//This is for uploading the image into the hizliresim.com and getting the web address into the db.
if(($_FILES['event_picture']['name'] != "")){
    $fileName = mysqli_escape_string($db, $_FILES['event_picture']['name']);
    $fileTmpName = mysqli_escape_string($db, file_get_contents($_FILES['event_picture']['tmp_name']));
    $fileSize = $_FILES['event_picture']['size'];
    $fileError = $_FILES['event_picture']['error'];
    $fileType = mysqli_escape_string($db, $_FILES['event_picture']['type']);

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 900000){
                $FileNameNew = uniqid('', true).".".$fileActualExt;  
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
}

// Inserting query for player table
$insert_query = "INSERT INTO event (event_id, start_date, end_date, event_image, event_type, event_picture)
                           VALUES (NULL, '$start_date', '$end_date','$FileNameNew', '$event_name', '$fileTmpName');";


// Executes the query
$result0 = mysqli_query($db, $insert_query);

// Check if query is successful
if(!$result0)
{
    echo "<h3> Something went wrong! </h3>";

    echo "<a href = 'add-event.php'> Go back to adding page </a>";
}
else
{

    echo "<h3> Event is created successfully! </h3>";

    echo "<a href = 'published_games.php'> Go back to published games page </a>";
}

?>
