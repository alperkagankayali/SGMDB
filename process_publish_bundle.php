<?php
    include("db.php");
    session_start();

    $bundle_games = $_POST['game_id'];

    $count = count($bundle_games);

    if($count < 2)
    {
        echo "Bundles should contain 2 or more games";
    }
    else{

        $company_name = $_SESSION['company_name']['company_name'];

        $insert_bundle = "INSERT INTO bundle (bundle_id) VALUES (NULL);";
        $result_query = mysqli_query($db, $insert_bundle);


        $bundle_id = "SELECT MAX(bundle_id) AS \"max_bundle\" FROM bundle;";

        $result = mysqli_query($db, $bundle_id);
        $values = array_values($bundle_games);

        $row = $result->fetch_assoc();
        $max_bundle =  $row['max_bundle'];

        for($i = 0; $i < $count; $i++){
            $insert_game_bundle = "INSERT INTO gameBundle(bundle_id,game_name) VALUES ($max_bundle, \"$values[$i]\");";
            mysqli_query($db, $insert_game_bundle);
        }
        echo "Bundle created successfully";

    }
    echo "<br><a href = 'publish_bundle.php'> Go back </a>";
?>