<?php
    include("db.php");
    session_start();

    $player_password = mysqli_escape_string($db, $_POST['player_password']);
    $old_password = mysqli_escape_string($db, $_POST['player_old_password']);
    $repeated_password = mysqli_escape_string($db, $_POST['psw-repeat']);

    $player_id = $_SESSION['player_id'];
    $get_pw_query ="SELECT password FROM player WHERE player_id =" .$player_id .";";


    $result1 = ($player_password == $repeated_password);

    // Check the password match
    if(!$result1)
    {
        echo "<h3> Passwords do not match! </h3>";

        echo "<a href = 'change_password.php'> Go back to previous page </a>";
    }
    else
    {
        // Executes the query
        $result0 = mysqli_query($db, $get_pw_query);

        if($result0 == false)
        {
             echo "<h3> Something went wrong!</h3>";

            echo "<a href = 'change_password.php'> Go back to previous page </a>";
        }
        else if($result0->fetch_assoc()['password'] == $old_password)
        {
           $update_pw = "UPDATE player SET password = '".$player_password."' WHERE player_id=" .$player_id .";";

           mysqli_query($db, $update_pw);

            echo "<h3> Password change successfull! </h3>";

            echo "<a href = 'profile.php'> Go back to your profile </a>";
        }
        else
        {
            echo "<h3> Wrong password cannot change! </h3>";

            echo "<a href = 'change_password.php'> Go back to previous page </a>";
           
        }
    }
?>
