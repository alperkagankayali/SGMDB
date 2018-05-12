<?php
    include("db.php");
    session_start();

    // Accessing data from input fields from login page of player
    $game_name = mysqli_escape_string($db, $_POST['game_name']);
    $game_price = mysqli_escape_string($db, $_POST['game_price']);
    $game_platforms = $_POST['game_platform'];                     // when empty gives error
    $game_category = mysqli_escape_string($db, $_POST['game_category']);
    //$system_requirements = mysqli_escape_string($db, $_POST['game_sys_requirements']);
    $game_logo = mysqli_escape_string($db, $_POST['game_logo']);

    //This is for uploading the image into the hizliresim.com and getting the web address into the db.

    $fileName = mysqli_escape_string($db, $_FILES['game_sys_requirements']['name']);
    $fileTmpName = mysqli_escape_string($db, file_get_contents($_FILES['game_sys_requirements']['tmp_name']));
    $fileSize = $_FILES['game_sys_requirements']['size'];
    $fileError = $_FILES['game_sys_requirements']['error'];
    $fileType = mysqli_escape_string($db, $_FILES['game_sys_requirements']['type']);

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('txt');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 900000){
                $FileNameNew = uniqid('', true).".".$fileActualExt;  
                echo"upload successful!";
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


    // Getting date
    $release_date = date("Y-m-d");
    // Concat platform names in a single var
    $game_platform = "";
    foreach($game_platforms as $platform)
    {
        $game_platform.=$platform." ";
    }
    // Getting company name
    $company_name = $_SESSION['company_name']['company_name'];
    // Inserting query for game table
    $insert_company_query = "INSERT INTO game (game_name, game_price, platform, game_category, game_logo, system_requirements, release_date, company_name, system_file)
                             VALUES ('$game_name', $game_price, '$game_platform', '$game_category', '$game_logo', '$fileName', '$release_date', '$company_name', '$fileTmpName');";
    // Executes the query
    $result0 = mysqli_query($db, $insert_company_query);
    // If the game is already exists
    if(!$result0)
    {
        echo "<h3> This game already exists in the system! </h3>";
        echo "<a href = 'publish_game.php'> Go back </a>";
    }
    else
    {
        echo "<h3> Game is added to the system successfully! </h3>";
        echo "<a href = 'published_games.php'> Go back </a>";
    }
?>
