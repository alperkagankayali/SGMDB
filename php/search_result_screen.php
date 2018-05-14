<?php
    include("db.php");
    session_start();

    $search =  mysqli_escape_string($db, $_POST['search']);

    // Acessing player id
    $player_id = $_SESSION['player_id'];

    // Accessing the friend starting with
    $access_players_query = "SELECT * FROM player WHERE username LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR middlename LIKE '%$search%'";

    // Execute query
    $result_query1 = mysqli_query($db, $access_players_query);

    // Numberof rows
    $counter1 = mysqli_num_rows($result_query1);

    // Accessing the game names starting with
    $access_games_query = "SELECT * FROM game WHERE game_name LIKE '%$search%'";

    // Execute query
    $result_query2 = mysqli_query($db, $access_games_query);

    // Numberof rows
    $counter2 = mysqli_num_rows($result_query2);


    // Accessing the news starting with
    $access_news_query = "SELECT * FROM news WHERE header LIKE '%$search%' OR txt LIKE '%$search%'";

    // Execute query
    $result_query3 = mysqli_query($db, $access_news_query);

    // Numberof rows
    $counter3 = mysqli_num_rows($result_query3);



    include("process_game_requests.php");
?>


<!DOCTYPE html>

<html>
<title>Search Result</title>

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
    .w3-bar-item {font-color: white}
    .nav_links {height: 50px; padding:10px}
    .search-form {margin:10px; margin-left:20px}
    .white-font {color:white}
    .background {background:url('images/bg.jpg')}
</style>

<!--*************************************************************************************************-->

<body class="background">

  <!-- Navbar -->
  <div class="w3-top w3-green background">
      <div class="w3-bar w3-theme-d2 w3-left-align">

          <!--Nav buttons-->
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
          <a href="store.php" class="w3-bar-item w3-button w3-teal nav_links"><i class="fa fa-home w3-margin-right"></i></a>
          <a href="library.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Library</a>
          <a href="store.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Store</a>
          <a href="news.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
          <a href="wish_list.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Wishlist</a>
          <a href="cart.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Cart</a>
          <a href="chat.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Chat</a>
          <a href="about.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

          <!--Notif button-->
          <div class="w3-dropdown-hover w3-hide-small">
              <?php include("process_notification.php");?>
          </div>

          <!-- Logout -->
          <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
            <img src="images/icons/logout.png" class="w3-circle" style="height:23px;width:23px" alt="Log out">
          </a>

          <!--Profile avatar-->
         <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            <img src=<?php include("picture_load.php");?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
         </a>

         <!--Search-->
         <form class="w3-bar-item w3-right" action="search_result_screen.php" method="post">
           <input type="text" placeholder="Search.." name="search" class="search-form">
           <button type="submit"><i class="fa fa-search search-form"></i></button>
         </form>

      </div>
  </div>

  <!-- Content -->
  <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

    <div class="w3-panel white-font w3-border">
      <h1 style="margin:20px"><br>SEARCH RESULT</h1>
    </div>


    <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Left Column -->
      <div class="w3-col m3">

      <!-- End Left Column -->
      </div>

      <!-- Middle Column -->
      <div class="w3-col m7 w3-center">

          <!-- Gmaes grid -->
          <div class="w3-row white-font">

              <div class="w3-panel white-font">
                <h4 class="w3-left"><br>Games containing <?php echo " '".$search."'"; ?></h4>
              </div>

              <!-- 1st column -->
              <div class="w3-col l6 s6">
                <?php
                    for($i = 0; $i < (int)($counter2/2); $i++)
                    {
                        // Result
                        $games = $result_query2->fetch_assoc();

                        $game_name = $games['game_name'];
                        $game_logo = $games['game_logo'];
                        $game_price = $games['game_price'];
                        $_SESSION['game_name'] = $game_name;
                ?>
                <div class="w3-container w3-border w3-margin">
                  <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top" src=<?php include("picture_load.php"); ?> style="width:100%"></a>
                  <p><?php echo $game_name; ?><br><?php echo $game_price; ?> $ </p>
                </div>

                <?php
                    }
                ?>

              </div>

              <!-- 2nd column -->
              <div class="w3-col l6 s6">
                <?php
                    for($i = (int)($counter2/2); $i < $counter2; $i++)
                    {
                        // Result
                        $games = $result_query2->fetch_assoc();

                        $game_name = $games['game_name'];
                        $game_logo = $games['game_logo'];
                        $game_price = $games['game_price'];
                        $_SESSION['game_name'] = $game_name;
                ?>
                <div class="w3-container w3-border w3-margin">
                  <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top" src=<?php include("picture_load.php"); ?> style="width:100%"></a>
                  <p><?php echo $game_name; ?><br><?php echo $game_price; ?> $ </p>
                </div>

                <?php
                    }
                ?>

              </div>
          </div>
          <!--End of Users grid-->

          <hr>

          <!-- USers grid -->
          <div class="w3-row white-font">

              <div class="w3-panel white-font">
                <h4 class="w3-left"><br>Users containing <?php echo " '".$search."'"; ?> </h4>
              </div>

              <!-- 1st column -->
              <div class="w3-col l6 s6">
                <?php
                    for($i = 0; $i < (int)($counter1/2); $i++)
                    {
                        // Result
                        $player = $result_query1->fetch_assoc();

                        // getting other attributes of player
                        $player_firstname = $player['firstname'];
                        $player_midname = $player['middlename'];
                        $player_lastname = $player['lastname'];
                        $player_picture = $player['profile_picture'];
                        $player_email = $player['email'];

                        $player_id2 = $player['player_id'];
                        $_SESSION['player_id2'] = $player_id2;

                        // Checking if already friend
                        $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM friendship WHERE player_id1 = $player_id AND player_id2 = $player_id2;"));
                ?>
                <div class="w3-container w3-border w3-margin">
                  <a href="#"><img class="w3-margin-top w3-left" src=<?php include("picture_load.php"); ?> style="width:100%"></a>
                  <h4><?php echo $player_firstname." ".$player_midname." ".$player_lastname; ?></h4>
                  <h5><?php echo $player_email ?></h5>

                  <?php
                        if($count == 0)
                        {
                    ?>
                        <a href="process_adding_friend.php?username=<?php echo $player['username']; ?>" class="w3-right w3-margin-bottom">Add Friend</a>
                  <?php
                        }
                        else if($player_id2 == $player_id)
                        {
                  ?>
                        <p class="w3-right w3-margin-bottom">You</p>
                  <?php
                        }
                        else
                        {
                    ?>
                        <p class="w3-right w3-margin-bottom">Your Friend</p>
                  <?php
                        }
                    ?>
                </div>

              <?php
                  }
              ?>

              </div>

              <!-- 2nd column -->
              <div class="w3-col l6 s6">
                <?php
                    for($i = (int)($counter1/2); $i < $counter1; $i++)
                    {
                        // Result
                        $player = $result_query1->fetch_assoc();

                        // getting other attributes of player
                        $player_firstname = $player['firstname'];
                        $player_midname = $player['middlename'];
                        $player_lastname = $player['lastname'];
                        $player_picture = $player['profile_picture'];
                        $player_email = $player['email'];

                        $player_id2 = $player['player_id'];
                        $_SESSION['player_id2'] = $player_id2;

                        // Checking if already friend
                        $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM friendship WHERE player_id1 = $player_id AND player_id2 = $player_id2;"));

                ?>
                <div class="w3-container w3-border w3-margin">
                  <a href="#"><img class="w3-margin-top w3-left" src=<?php include("picture_load.php"); ?> style="width:100%"></a>
                  <h4><?php echo $player_firstname." ".$player_midname." ".$player_lastname; ?></h4>
                  <h5><?php echo $player_email ?></h5>

                  <?php
                        if($player_id2 == $player_id)
                        {
                    ?>
                        <p class="w3-right w3-margin-bottom">You</p>
                  <?php
                        }
                        if($player_id2 != $player_id && $count == 0)
                        {
                  ?>
                        <a href="process_adding_friend.php?username=<?php echo $player['username']; ?>" class="w3-right w3-margin-bottom">Add Friend</a>
                  <?php
                        }
                        if($count != 0)
                        {
                    ?>
                        <p class="w3-right w3-margin-bottom">Your Friend</p>
                  <?php
                        }
                    ?>
                </div>

              <?php
                  }
              ?>


              </div>
          </div>
          <!--End of Users grid-->

          <hr>

         <!-- News grid -->
          <div class="w3-row white-font">

              <div class="w3-panel white-font">
                <h4 class="w3-left"><br>News containing <?php echo " '".$search."'"; ?>  </h4>
              </div>

              <!-- 1st column -->
              <div class="w3-col l20 s10">
              <?php

                for($i = 0; $i < $counter3; $i++)
                {
                  $news = $result_query3->fetch_assoc();
                  echo "<div class=\"w3-container w3-card w3-border w3-round w3-margin white-font\"><br>";
                //<span class=\"w3-right w3-opacity\">02.04.2018</span>";
                  echo " <h4>". $news['header']."</h4><br>";
                  echo   "<hr class=\"w3-clear\">";
                  echo "<p>". $news['txt'] ."</p>";
                  echo  "<div class=\"w3-row-padding\" style=\"margin:0 -16px\">";
                  $_SESSION['news_id'] = $news['news_id'];
                  echo "<img style = 'width:90%'src=";
                  include("picture_load.php");
                  echo " class=\"w3-right\">";
                  echo "</div>";
                  echo "<br> <h5> by ". $news['company_name']."</h5><br>";
                  echo "</div>";
                }
              ?>

              </div>


          </div>
          <!--End of Users grid-->



      <!-- End Middle Column -->
      </div>

    <!-- End Grid -->
    </div>

  <!-- End Page Container -->
  </div>

  <!--*************************************************************************************************-->

  <!--Scripts-->
  <script>

      // Slideshow
      var slideIndex = 1;
      showDivs(slideIndex);

      function plusDivs(n)
      {
        showDivs(slideIndex += n);
      }

      function currentDiv(n)
      {
        showDivs(slideIndex = n);
      }

      function showDivs(n)
      {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demodots");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length} ;
        for (i = 0; i < x.length; i++)
        {
           x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++)
        {
           dots[i].className = dots[i].className.replace(" w3-white", "");
        }

        x[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " w3-white";
      }
  </script>

</body>
</html>
