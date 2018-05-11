<?php
    include("db.php");
    session_start();
    // Accessing data from input fields from login page of player
    $game_name = mysqli_escape_string($db, $_POST['game_name']);
    $game_price = mysqli_escape_string($db, $_POST['game_price']);
    $game_platforms = $_POST['game_platform'];                     // when empty gives error
    $game_category = mysqli_escape_string($db, $_POST['game_category']);
    $system_requirements = mysqli_escape_string($db, $_POST['game_sys_requirements']);
    $game_logo = mysqli_escape_string($db, $_POST['game_logo']);
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
    $insert_company_query = "INSERT INTO game (game_name, game_price, platform, game_category, game_logo, system_requirements, release_date, company_name)
                             VALUES ('$game_name', $game_price, '$game_platform', '$game_category', '$game_logo', '$system_requirements', '$release_date', '$company_name');";
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
