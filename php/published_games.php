<?php
    include("db.php");
    session_start();

    // Accessing the games of the company logged in
    $company_name = $_SESSION['company_name']['company_name'];

    // Category sorting
    if(isset($_GET['category']))
    {
        // category chosen
        $category = $_GET['category'];

        if($category != "Free to play")
        {
            // Query for accessing all the games with the given category in the store by the company
            $access_games_query = "SELECT * FROM game
                                  WHERE game_category = '$category' AND company_name = '$company_name'";
        }
        else
        {
            // Query for accessing all free games in the store by the company
            $access_games_query = "SELECT * FROM game
                                   WHERE game_price = 0 AND company_name = '$company_name'";
        }
    }
    else if(!isset($_GET['category']) && isset($_GET['platform']))
    {
        // platform chosen
        $platform = $_GET['platform'];

        $access_games_query = "SELECT * FROM game
                               WHERE platform LIKE '%$platform%' AND company_name = '$company_name'";
    }
    else
    {
        // Query for getting the games of company
        $access_games_query = "SELECT *
                               FROM game WHERE company_name = '$company_name'";
    }


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
          <a href="news_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
          <a href="about_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

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
              <a href="published_games.php?category=Free to play" class="w3-button w3-block w3-theme-l1 w3-left-align"> Free to Play</a>
              <a href="published_games.php?category=Action" class="w3-button w3-block w3-theme-l1 w3-left-align"> Action</a>
              <a href="published_games.php?category=Adventure" class="w3-button w3-block w3-theme-l1 w3-left-align"> Adventure</a>
              <a href="published_games.php?category=Casual" class="w3-button w3-block w3-theme-l1 w3-left-align"> Casual</a>
              <a href="published_games.php?category=Indie" class="w3-button w3-block w3-theme-l1 w3-left-align"> Indie</a>
              <a href="published_games.php?category=Multiplayer" class="w3-button w3-block w3-theme-l1 w3-left-align"> Multiplayer</a>
              <a href="published_games.php?category=Racing" class="w3-button w3-block w3-theme-l1 w3-left-align"> Racing</a>
              <a href="published_games.php?category=RPG" class="w3-button w3-block w3-theme-l1 w3-left-align"> RPG</a>
              <a href="published_games.php?category=Simulation" class="w3-button w3-block w3-theme-l1 w3-left-align"> Simulation</a>
              <a href="published_games.php?category=Sports" class="w3-button w3-block w3-theme-l1 w3-left-align"> Sports</a>
              <a href="published_games.php?category=Strategy" class="w3-button w3-block w3-theme-l1 w3-left-align"> Strategy</a>
            </div>
        </div>

        <br>

        <div class="w3-panel white-font">
          <h4><br><u>Platforms<u></h4>
        </div>

        <!-- Accordion -->
        <div class="w3-card w3-round white-font">
            <div>
              <a href="published_games.php?platform=Windows" class="w3-button w3-block w3-theme-l1 w3-left-align"> Windows</a>
              <a href="published_games.php?platform=Mac" class="w3-button w3-block w3-theme-l1 w3-left-align"> MacOS</a>
              <a href="published_games.php?platform=Linux" class="w3-button w3-block w3-theme-l1 w3-left-align"> Linux</a>
            </div>
        </div>

      <!-- End Left Column -->
      </div>

      <div class="w3-col m7" style="overflow:auto">

        <div class="w3-panel white-font">


          <a class="w3-right w3-button w3-border" href = "publish_game.php" style = "margin: 3px" ><br>Publish A Game</h4></a>
          <a class="w3-right w3-button w3-border" href = "publish_bundle.php" style = "margin: 3px"><br>Publish Bundle</h4></a>
          <a class="w3-right w3-button w3-border" href = "publish_news.php" style = "margin: 3px"><br>Publish News</h4></a>

          <br><br>

          <h4><br><?php
                    if(isset($_GET['category']))
                        echo $category;
                    else if(isset($_GET['platform']))
                        echo $platform;
                    else
                        echo "Published Games"?>
          </h4>


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
                $release_date = $games['release_date'];

                $rating = mysqli_query($db, "SELECT rating FROM rating NATURAL JOIN rate WHERE game_name = '$game_name'")->fetch_assoc()['rating'];

        ?>
            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
                <span class="w3-right w3-opacity"><?php echo $release_date ?></span>

                <?php echo "<h4>".$game_name."</h4><br>"; ?>

                <div class="w3-row-padding" style="margin:0 -16px">
                    <div class="w3-half">
                      <a href="game_monthly_sale_information.php?game_name=<?php echo $game_name; ?>"><img src=<?php echo $game_logo; ?> style="width:100%" alt="Nature" class="w3-margin-bottom"></a>
                  </div>
                </div>
                <hr class="w3-clear">

                <p class="w3-left">Game Price = <?php echo $game_price ?> USD</p>
                <p class="w3-right"> Rating: <?php echo $rating ?></p>

            </div>

        <?php
            }
        ?>

        <!-- Display bundles-->

        <div class="w3-panel white-font">
          <h4 class="w3-left" ><br>Bundles</h4>
        </div>
        <?php
              $sql_get_all_bundles = "SELECT DISTINCT bundle_id, game_name FROM gameBundle NATURAL JOIN game WHERE company_name = \"$company_name\" ORDER BY bundle_id";
              $result_query = mysqli_query($db, $sql_get_all_bundles);
              $sql_bundle_count = "SELECT DISTINCT bundle_id FROM gameBundle NATURAL JOIN game WHERE company_name = \"$company_name\";";
              $bundle_ids = mysqli_query($db, $sql_bundle_count);
              $bundle_count = mysqli_num_rows($bundle_ids);
              //var_dump($bundle_count);
              for($i = 0; $i < $bundle_count; $i++)
              {
                $bundle_id = $bundle_ids->fetch_assoc();
                //echo $bundle_id['bundle_id'];
                $sql_get_bundles = "SELECT DISTINCT * FROM game NATURAL JOIN gameBundle WHERE bundle_id = " .$bundle_id['bundle_id']. ";";
                $games = mysqli_query($db, $sql_get_bundles);
                $game_count = mysqli_num_rows($games);

                echo "<div class=\"w3-container w3-card w3-border w3-round w3-margin white-font\"><br>
                <span class=\"w3-right w3-opacity\"></span>";
                $game_price = 0;

                for($j = 0; $j < $game_count; $j++)
                {
                  $game = $games->fetch_assoc();
                  $game_price += $game['game_price'];
                  echo "<h5>".$game['game_name']."</h5><br>";
                  //echo "<p class=\"w3-left\">".$game['game_name']."</p><br>";
                }

                echo "<hr class=\"w3-clear\">";
                $bundle_price_discount = $game_price*80/100;
                echo "<p class=\"w3-left\">Bundle Price = <del>". $game_price ." USD</del> ".$bundle_price_discount." USD</p>";
                echo "<p class=\"w3-right\"><a href=\"process_remove_bundle.php?bundle_id=".$bundle_id['bundle_id']."\" class=\"w3-left w3-margin-bottom w3-padding w3-border w3w3-button\" style = \"margin: 3px\">Remove Bundle</a></p>";

                echo "<p class=\"w3-right\"><a href=\"bundle_info_company.php?bundle_id=".$bundle_id['bundle_id']."\" class=\"w3-left w3-margin-bottom w3-padding w3-border w3w3-button\" style = \"margin: 3px\">Bundle Information</a></p>";
                echo "</div>";
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
