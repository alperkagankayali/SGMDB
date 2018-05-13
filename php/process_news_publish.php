<?php
    include("db.php");
    session_start();

    // Accessing data from input fields from login page of player
    $header = mysqli_escape_string($db, $_POST['header']);
    $text = mysqli_escape_string($db, $_POST['text']);

    //$imagename=mysqli_escape_string($db, $_POST['text']);
    //echo $imagename;


    $fileName = mysqli_escape_string($db, $_FILES['news_image']['name']);
    $fileTmpName = mysqli_escape_string($db, file_get_contents($_FILES['news_image']['tmp_name']));
    $fileSize = $_FILES['news_image']['size'];
    $fileError = $_FILES['news_image']['error'];
    $fileType = mysqli_escape_string($db, $_FILES['news_image']['type']);

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

    //Getting company name
    $company_name = $_SESSION['company_name']['company_name'];

    // Inserting query for news table
    $insert_news_query = "INSERT INTO news (news_id, header, txt, news_image, company_name, news_picture) VALUES (NULL, \"$header\", \"$text\", \"$FileNameNew\", \"$company_name\", \"$fileTmpName\");";
    echo $insert_news_query;

    // Executes the query
    $result0 = mysqli_query($db, $insert_news_query);
    //var_dump($result0);

    if(!$result0)
    {
        echo "<h3> Wrong parameters! </h3>";

        echo "<a href = 'publish_news.php'> Go back </a>";
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
