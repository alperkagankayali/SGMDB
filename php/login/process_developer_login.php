<?php
    include("../db.php");
    session_start();


    // Accessing the developer login input fields
    $developer_email = mysqli_escape_string($db, $_POST['developer_email']);
    $developer_password = mysqli_escape_string($db, $_POST['developer_password']);

    // SQL query for selecting rows
    $login_developer_query = "SELECT * FROM developer WHERE developer_email = '$developer_email' AND developer_password = '$developer_password'";

    // Executing the query
    $result = mysqli_query($db, $login_developer_query);

    // Number of rows
    $count_rows = mysqli_num_rows($result);

    // Checking whether the result of query is empty or not
    if($count_rows > 0)
    {
        header("location: ../publish_game.php");

        exit();
    }
    else
    {
        echo "<h3> Your developer email or password is incorrect </h3>";

        echo "<a href = 'login-developer.php'> Go back to login page </a>";
    }
?>
