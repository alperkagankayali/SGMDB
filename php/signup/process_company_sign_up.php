<?php
    include("../db.php");
    session_start();

    // Accessing data from input fields from login page of player
    $company_name = mysqli_escape_string($db, $_POST['company_name']);
    $company_email = mysqli_escape_string($db, $_POST['company_email']);
    $company_password = mysqli_escape_string($db, $_POST['company_password']);
    $company_rep_password = mysqli_escape_string($db, $_POST['company_psw_repeat']);
    $company_logo = mysqli_escape_string($db, $_POST['company_logo']);

    // Inserting query for company table
    $insert_company_query = "INSERT INTO company (company_name, company_email, company_password, company_logo, rating)
                               VALUES ('$company_name', '$company_email', '$company_password','$company_logo', 0);";

    $result1 = ($company_password == $company_rep_password);

    // Check the password match
    if(!$result1)
    {
        echo "<h3> Passwords do not match! </h3>";

        echo "<a href = 'signup-company.php'> Go back to login page </a>";
    }

    else
    {
        // Executes the query
        $result0 = mysqli_query($db, $insert_company_query);

        // Check if query is successful
        if(!$result0)
        {
            echo "<h3> This name or email is already used! </h3>";

            echo "<a href = 'signup-company.php'> Go back to login page </a>";
        }
        else
        {
            echo "<h3> Company is created successfully! </h3>";

            echo "<a href = '../login/login-company.php'> Go back to login page </a>";
        }
    }
?>
