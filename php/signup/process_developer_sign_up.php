<?php
    include("../db.php");
    session_start();

    // Accessing data from input fields from login page of player
    $developer_first_name = mysqli_escape_string($db, $_POST['developer_first_name']);
    $developer_mid_name = mysqli_escape_string($db, $_POST['developer_mid_name']);
    $developer_last_name = mysqli_escape_string($db, $_POST['developer_last_name']);
    $developer_email = mysqli_escape_string($db, $_POST['developer_email']);
    $developer_password = mysqli_escape_string($db, $_POST['developer_password']);
    $developer_rep_password = mysqli_escape_string($db, $_POST['developer_psw_repeat']);

    // Inserting query for company table
    $insert_developer_query = "INSERT INTO developer (developer_firstname, developer_midname, developer_lastname, developer_email, developer_password)
                               VALUES ('$developer_first_name', '$developer_mid_name', '$developer_last_name', '$developer_email', '$developer_password');";

    $result1 = ($developer_password == $developer_rep_password);

    // Check the password match
    if(!$result1)
    {
        echo "<h3> Passwords do not match! </h3>";

        echo "<a href = 'signup-developer.php'> Go back to login page </a>";
    }

    else
    {
        // Executes the query
        $result0 = mysqli_query($db, $insert_developer_query);

        // Check if query is successful
        if(!$result0)
        {
            echo "<h3> This email is already used! </h3>";

            echo "<a href = 'signup-developer.php'> Go back to login page </a>";
        }
        else
        {
            echo "<h3> Account is created successfully! </h3>";

            echo "<a href = '../login/login-developer.php'> Go back to login page </a>";
        }
    }
?>
