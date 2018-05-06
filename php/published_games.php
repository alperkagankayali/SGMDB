<?php
    include("db.php");
    session_start();

    // Accessing the games of the company logged in
    $company_name = $_SESSION['company_name']['company_name'];

    // Query for getting the games of company
    $access_games_query = "SELECT *
                           FROM game WHERE company_name = '$company_name'";

    // Executing the query
    $result_query = mysqli_query($db, $access_games_query);

    // Number of games
    $counter = mysqli_num_rows($result_query);

?>


<!DOCTYPE html>

<html>
<title>Published games</title>

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
          <a href="published_games.php" class="w3-bar-item w3-button w3-teal nav_links"><i class="fa fa-home w3-margin-right"></i></a>
          <a href="published_games.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Published Games</a>

          <!-- Logout -->
          <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
            <img src="images/icons/logout.png" class="w3-circle" style="height:23px;width:23px" alt="Log out">
          </a>

          <!--Profile avatar-->
          <a href="company_profile.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            <img src=<?php if ($_SESSION['company_name']['company_logo'] != '') echo $_SESSION['company_name']['company_logo']; else echo "images/icons/company_logo.png";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
          </a>
      </div>
  </div>

  <!-- Content -->
  <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

    <div class="w3-panel white-font w3-border">
      <h1><br>YOUR PUBLISHED GAMES</h1>
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
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Free to Play</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Action</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Adventure</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Casual</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Indie</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Multiplayer</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Racing</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> RPG</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Simulation</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Sports</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Strategy</button>
            </div>
        </div>

        <br>

        <div class="w3-panel white-font">
          <h4><br><u>Platforms<u></h4>
        </div>

        <!-- Accordion -->
        <div class="w3-card w3-round white-font">
            <div>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Windows</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> MacOS</button>
                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Linux</button>
            </div>
        </div>

      <!-- End Left Column -->
      </div>

      <div class="w3-col m7" style="overflow:auto">

        <div class="w3-panel white-font">

          <h4 class="w3-left" ><br>Published Games</h4>
          <a class="w3-right w3-button w3-border" href = "publish_game.php" ><br>Publish A Game</h4></a>

        </div>


        <!-- Displaying the games of the company -->
        <?php

            for($i = 0; $i < $counter; $i++)
            {
                // Obtained games
                $games = $result_query->fetch_assoc();

                $game_name = $games['game_name'];
                $game_price = $games['game_price'];
                $game_logo = $games['game_logo'];
                $rating = $games['rating'];
                $release_date = $games['release_date'];

        ?>
            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
                <span class="w3-right w3-opacity"><?php echo $release_date ?></span>

                <?php echo "<h4>".$game_name."</h4><br>"; ?>

                <div class="w3-row-padding" style="margin:0 -16px">
                    <div class="w3-half">
                      <img src= <?php echo $game_logo; ?> style="width:100%" alt="Nature" class="w3-margin-bottom">
                  </div>
                </div>
                <hr class="w3-clear">

                <p class="w3-left">Game Price = <?php echo $game_price ?> USD</p>
                <p class="w3-right"> Rating: <?php echo $rating ?></p>

            </div>

        <?php

            }
        ?>
        <!-- End of displaying games -->

      <!-- End Middle Column -->
      </div>
      <!-- Right Column -->
      <div class="w3-col m2">

        <div class="w3-card w3-round w3-center">
          <div class="w3-container w3-border white-font">

            <p>Upcoming Events:</p>
            <img src="images/gaben_summer_sale.jpg" alt="Summer sale" style="width:100%;">
            <p><strong>Summer Sale 2018</strong></p>
            <p><a class="w3-button w3-border w3-block w3-theme-l4" href="event.html" >Info</a></p>

          </div>
        </div>

        <br>

        <div class="w3-card w3-round w3-center">
          <div class="w3-container w3-border white-font">

            <p>Upcoming Events:</p>
            <img src="images/gaben_summer_sale.jpg" alt="Summer sale" style="width:100%;">
            <p><strong>Summer Sale 2018</strong></p>
            <p><a class="w3-button w3-border w3-block w3-theme-l4" href="event.html" >Info</a></p>

          </div>
        </div>

      <!-- End Right Column -->
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
