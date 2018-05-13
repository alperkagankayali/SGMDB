<?php
    include("../db.php");
    session_start();
    var_dump($_POST);
    // Accessing data from input fields from login page of player
    $company_name = mysqli_escape_string($db, $_POST['company_name']);
    $company_email = mysqli_escape_string($db, $_POST['company_email']);
    $company_password = mysqli_escape_string($db, $_POST['company_password']);
    $company_rep_password = mysqli_escape_string($db, $_POST['company_psw_repeat']);
    


    $fileTmpName = "";
    $FileNameNew = "";
    $fileActualExt = "";
    $fileError = -1;
    $fileSize = -1;
    //This is for uploading the image into the hizliresim.com and getting the web address into the db.
    if(($_FILES['company_logo']['name'] != "")){
        $fileName = mysqli_escape_string($db, $_FILES['company_logo']['name']);
        $fileTmpName = mysqli_escape_string($db, file_get_contents($_FILES['company_logo']['tmp_name']));
        $fileSize = $_FILES['company_logo']['size'];
        $fileError = $_FILES['company_logo']['error'];
        $fileType = mysqli_escape_string($db, $_FILES['company_logo']['type']);

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
    
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

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
    }


    // Inserting query for company table
    $insert_company_query = "INSERT INTO company (company_name, company_email, company_password, company_logo, rating, company_picture)
                               VALUES ('$company_name', '$company_email', '$company_password','$FileNameNew', 0, '$fileTmpName');";

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
