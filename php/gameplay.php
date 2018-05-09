<?php
    include("db.php");
    session_start();

    // Player id and game name
    $player_id = $_SESSION['player_id'];
    $game_name = $_GET['game_name'];

    // start time
    $start_date = date("Y-m-d");
    $start_time = date("H:i:s");

    // Check boxes selected
    $check_arr = null;

    // Selected player ids
    $player_ids = mysqli_query($db, "SELECT player_id2 FROM friendship WHERE player_id1 = $player_id");
    $player_ids_arr = array();

    $session_id = mysqli_query($db, "SELECT MAX(session_id) as max_session FROM play;")->fetch_assoc()['max_session'] + 1;

    if(isset($_POST['check']))
    {
        $check_arr = $_POST['check'];

        $count = count($check_arr);     // number of selected check boxes

        for($i = 0; $i < $count; $i++)
        {
            $player_id2 = $player_ids->fetch_assoc()['player_id2'];

            if(($check_arr[$i] == "on") == 1)
            {
                  array_push($player_ids_arr, $player_id2);
                  // Inserting game session data into play table
                  $insert_gameplay = "INSERT INTO play (session_id, player_id1, player_id2, game_name, session_date, session_time) VALUES ($session_id, $player_id, $player_id2, '$game_name', '$start_date', '$start_time');";

                  mysqli_query($db, $insert_gameplay);
            }
        }
    }
    else
    {
        // Inserting game session data into play table
        $insert_gameplay = "INSERT INTO play (session_id, player_id1, player_id2, game_name, session_date, session_time) VALUES ($player_id, null, '$game_name', '$start_date', '$start_time')";

        // Executing the query
        mysqli_query($db, $insert_gameplay);
    }

    $_SESSION['player_ids'] = $player_ids_arr;
?>

<!DOCTYPE html>

<html>
<title>Game Information</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    html,body,h1,h2,h3,h4 {font-family:"Lato", sans-serif}
    .mySlides {display:none}
    .w3-tag, .fa {cursor:pointer}
    .w3-tag {height:15px;width:15px;padding:0;margin-top:6px}
    .white-font {color:white}
    .background {background:url('images/bg.jpg')}
</style>

<script>

    var myVar = setInterval(myTimer, 1000);

    function myTimer()
    {
        var d = new Date();
        document.getElementById("game").innerHTML = d.toLocaleTimeString();
    }

</script>

<body class="background">

  <h4 class="white-font w3-center"><?php echo $game_name; ?></h4>
  <a href="process_quit_game.php?start_time=<?php echo $start_time; ?>&game_name=<?php echo $game_name;?>" class="w3-button w3-center white-font"> Quit </a>
  <h4 class="white-font w3-left w3-margin-left" >Start time: <?php echo $start_time; ?></h4>
  <h4 class="white-font w3-right w3-margin-right" id="game"></h4>

</body>
