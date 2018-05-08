<?php
    include("db.php");
    session_start();

    // Getting company name
    $company_name = $_SESSION['company_name']['company_name'];

    $bundle_id = $_GET['bundle_id'];



    // Inserting query for news table
    $delete_game_bundle_query = "DELETE FROM gameBundle WHERE bundle_id =" .$bundle_id.";";

    $delete_bundle_query = "DELETE FROM bundle WHERE bundle_id =" .$bundle_id.";";

    // Executes the query
    $result0 = mysqli_query($db, $delete_game_bundle_query);
    $result1 = mysqli_query($db, $delete_bundle_query);


    if(!$result0)
    {
        echo "<h3> Something is wrong </h3>";

        echo "<a href = 'published_games.php'> Go back </a>";
    }
    else
    {
        echo "<h3> Bundle deleted </h3>";

        echo "<a href = 'published_games.php'> Go back </a>";
    }

?>
