<?php
    include("db.php");
    session_start();

    // ID of the player looged on
    $player_id = $_SESSION['player_id'];

    // Category sorting
    if(isset($_GET['category']))
    {
        // category chosen
        $category = $_GET['category'];

        if($category != "Free to play")
        {
            // Query for accessing all the games with the given category in the wishlist
            $access_wishes = "SELECT W.game_name FROM game as G NATURAL JOIN wishlist as W
                               WHERE G.game_category = '$category' AND W.player_id = $player_id";
        }
        else
        {
            // Query for accessing all free games in the wishlist
            $access_wishes = "SELECT W.game_name FROM game as G NATURAL JOIN wishlist as W
                               WHERE G.game_price = 0 AND W.player_id = $player_id";
        }
    }
    else if(!isset($_GET['category']) && isset($_GET['platform']))
    {
        // platform chosen
        $platform = $_GET['platform'];

        $access_wishes = "SELECT W.game_name FROM game as G NATURAL JOIN wishlist as W
                           WHERE G.platform LIKE '%$platform%' AND W.player_id = $player_id";
    }
    else
    {
        // Query for accessing all the games in the wishlist
        $access_wishes = "SELECT game_name FROM wishlist
                          WHERE player_id = $player_id;";
    }


    // Executing the query
    $access_exe = mysqli_query($db, $access_wishes);

    // number of games in wishlist
    $counter = mysqli_num_rows($access_exe);
?>

<!DOCTYPE html>

<html>
<title>Your Wish list</title>

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
          <a href="#" class="w3-bar-item w3-button w3-teal nav_links"><i class="fa fa-home w3-margin-right"></i></a>
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
            <img src=<?php if($_SESSION['player_pp'] != '') echo ("signup/uploads/". $_SESSION['player_pp']); else echo "images/icons/avatar.png";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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
      <h1><br><img src="images/icons/wish.png" style="width:2%"> Wish List</h1>
    </div>


    <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Left Column -->
      <div class="w3-col m3">

        <div class="w3-panel white-font">
          <h4><br><u>Categories<u></h4>
        </div>

        <!-- Accordion -->
        <div class="w3-card w3-round white-font">
            <div>
                <a href="wish_list.php?category=Free to play" class="w3-button w3-block w3-theme-l1 w3-left-align"> Free to Play</a>
                <a href="wish_list.php?category=Action" class="w3-button w3-block w3-theme-l1 w3-left-align"> Action</a>
                <a href="wish_list.php?category=Adventure" class="w3-button w3-block w3-theme-l1 w3-left-align"> Adventure</a>
                <a href="wish_list.php?category=Casual" class="w3-button w3-block w3-theme-l1 w3-left-align"> Casual</a>
                <a href="wish_list.php?category=Indie" class="w3-button w3-block w3-theme-l1 w3-left-align"> Indie</a>
                <a href="wish_list.php?category=Multiplayer" class="w3-button w3-block w3-theme-l1 w3-left-align"> Multiplayer</a>
                <a href="wish_list.php?category=Racing" class="w3-button w3-block w3-theme-l1 w3-left-align"> Racing</a>
                <a href="wish_list.php?category=RPG" class="w3-button w3-block w3-theme-l1 w3-left-align"> RPG</a>
                <a href="wish_list.php?category=Simulation" class="w3-button w3-block w3-theme-l1 w3-left-align"> Simulation</a>
                <a href="wish_list.php?category=Sports" class="w3-button w3-block w3-theme-l1 w3-left-align"> Sports</a>
                <a href="wish_list.php?category=Strategy" class="w3-button w3-block w3-theme-l1 w3-left-align"> Strategy</a>
            </div>
        </div>

        <br>

        <div class="w3-panel white-font">
          <h4><br><u>Platforms<u></h4>
        </div>

        <!-- Accordion -->
        <div class="w3-card w3-round white-font">
            <div>
                <a href="wish_list.php?platform=Windows" class="w3-button w3-block w3-theme-l1 w3-left-align"> Windows</a>
                <a href="wish_list.php?platform=Mac" class="w3-button w3-block w3-theme-l1 w3-left-align"> MacOS</a>
                <a href="wish_list.php?platform=Linux" class="w3-button w3-block w3-theme-l1 w3-left-align"> Linux</a>
            </div>
        </div>


      <!-- End Left Column -->
      </div>

      <!-- Middle Column -->
      <div class="w3-col m7">

          <!--Game grid-->
          <div class="w3-row white-font">

              <div class="w3-panel white-font">
                <h4><br><?php
                          if(isset($_GET['category']))
                              echo $category;
                          else if(isset($_GET['platform']))
                              echo $platform;
                          else
                              echo "Your Wish List"?>
                </h4>
                <hr>
              </div>

              <!-- 1st column -->
              <div class="w3-col l6 s6">
                <?php
                    for($i = 0; $i < (int)($counter/2); $i++)
                    {
                        // Accessed games
                        $games = $access_exe->fetch_assoc();

                        // getting other attributes of game

                        $game_name = $games['game_name'];

                        $query = "SELECT * FROM game
                                  WHERE game_name = '$game_name'";

                        // execute the query
                        $result_game = mysqli_query($db, $query);

                        // result
                        $game = $result_game->fetch_assoc();
                ?>
                <div class="w3-container w3-border w3-margin">
                  <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top w3-left" src=<?php echo $game['game_logo']; ?> style="width:100%"></a>
                  <p><?php echo $game_name; ?><br><?php echo $game['game_price']; ?></b>$</p>
                  <a href="process_removing_from_wishlist.php?game_name=<?php echo $game_name; ?>" class="w3-right w3-margin-bottom" style="color:red">Remove</a>
                </div>

                <?php
                    }
                ?>

              </div>

              <!-- 2nd column -->
              <div class="w3-col l6 s6">
                <?php
                    for($i = (int)($counter/2); $i < $counter; $i++)
                    {
                      // Accessed games
                      $games = $access_exe->fetch_assoc();

                      // getting other attributes of game

                      $game_name = $games['game_name'];

                      $query = "SELECT * FROM game
                                WHERE game_name = '$game_name'";

                      // execute the query
                      $result_game = mysqli_query($db, $query);

                      // result
                      $game = $result_game->fetch_assoc();
                ?>
                <div class="w3-container w3-border w3-margin">
                  <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top w3-left" src=<?php echo $game['game_logo']; ?> style="width:100%"></a>
                  <p><?php echo $game_name; ?><br><?php echo $game['game_price']; ?></b>$</p>
                  <a href="process_removing_from_wishlist.php?game_name=<?php echo $game_name; ?>" class="w3-right w3-margin-bottom" style="color:red">Remove</a>
                </div>

                <?php
                    }
                ?>

              </div>

          </div>
          <!--End of Game grid-->

      <!-- End Middle Column -->
      </div>

      <!-- Right Column -->
      <?php include("upcoming-events.php"); ?>

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