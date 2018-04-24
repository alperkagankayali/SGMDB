<?php
    include("../db.php");
    session_start();


    // Accessing the company login input fields
    $company_email = mysqli_escape_string($db, $_POST['company_email']);
    $company_password = mysqli_escape_string($db, $_POST['company_password']);

    // SQL query for selecting rows
    $login_query = "SELECT * FROM company WHERE company_email = '$company_email' AND company_password = '$company_password'";

    // Executing the query
    $result = mysqli_query($db, $login_query);

    // Getting company name and passing it to next sessions
    $company_name = $result->fetch_assoc();
    $_SESSION['company_name'] = $company_name;

    // Number of rows
    $count_rows = mysqli_num_rows($result);

    // Checking whether the result of query is empty or not
    if($count_rows > 0)
    {
        header("location: ../published_games.php");

        exit();
    }
    else
    {
        echo "<h3> Your company email or password is incorrect </h3>";

        echo "<a href = 'login-company.php'> Go back to login page </a>";
    }
?>
