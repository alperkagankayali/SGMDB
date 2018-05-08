<?php
    include("db.php");
    session_start();

    // Accessing data from input fields from login page of player
    $header = mysqli_escape_string($db, $_POST['header']);
    $text = mysqli_escape_string($db, $_POST['text']);

    // Getting company name
    $company_name = $_SESSION['company_name']['company_name'];

    // Inserting query for news table
    $insert_news_query = "INSERT INTO news (news_id, header, text) VALUES (NULL, \"$header\", \"$text\");";

    // Executes the query
    $result0 = mysqli_query($db, $insert_news_query);
    //var_dump($result0);
    // If the game is already exists
    if(!$result0)
    {
        echo "<h3> Wrong parameters! </h3>";

        echo "<a href = 'publis_news.php'> Go back </a>";
    }
    else
    {
        echo "<h3> News is added to the system successfully! </h3>";

        echo "<a href = 'publish_news.php'> Go back </a>";
    }

    //echo $text;
    /*echo "<br>";
    echo $header;*/

?>
