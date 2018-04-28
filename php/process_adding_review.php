<?php
    include("db.php");
    session_start();

    // Access player id and game name
    $player_id = $_SESSION['player_id'];
    $game_name = $_GET['game_name'];

    // Access input fields
    $text = mysqli_escape_string($db, $_POST['review_text']);

    // Access date from system
    $date = date("Y-m-d");

    // STEP 1. Inserting review to review table
    $insert_review_query = "INSERT INTO review (review_text, review_date)
                            VALUES ('$text', '$date');";

    // Execute query
    mysqli_query($db, $insert_review_query);

    // STEP 2. Accessing review_id from inserted
    $access_review_id_query = "SELECT LAST_INSERT_ID()";

    // Executing the query
    $access_review_exec = mysqli_query($db, $access_review_id_query);

    // Result of the query
    $review = $access_review_exec->fetch_assoc();

    $review_id = $review['LAST_INSERT_ID()'];

    // STEP 3. Inserting tuple to 'writes' table
    $insert_to_writes = "INSERT INTO writes (review_id, game_name, player_id)
                         VALUES($review_id, '$game_name', $player_id);";

    // Executing the query
    mysqli_query($db, $insert_to_writes);

    header("location: game_information.php?game_name=".$game_name);

    exit();
?>
