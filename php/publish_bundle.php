<?php
    include("db.php");
    session_start();

    $company_name = $_SESSION['company_name']['company_name'];

    $access_query = "SELECT * FROM game WHERE company_name = '$company_name'";

    // Executing the Query
    $result_query = mysqli_query($db, $access_query);

    // Number of games
    $counter = mysqli_num_rows($result_query);

?>

<!DOCTYPE html>

<html>
<title>Publish bundle</title>

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
      <a href="published_games.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Published Games</a>
      <a href="news.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
      <a href="about.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

      <!--Notif button
      <button class="w3-button w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"></span></button>-->

      <!--Search
      <input type="text" placeholder="Search.." name="search" class="search-form">
      <button type="submit"><i class="fa fa-search search-form"></i></button>-->

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
      <h1 style="margin:20px"><br>Publishing bundle</h1>
    </div>


    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">


          <!--Game grid-->

        <form action="process_publish_bundle.php" method="post">
          <div class="w3-row white-font">

              <div class="w3-panel white-font">
                <h4><br><?php echo "Select from published games to form a bundle" ?>
                </h4>
                <hr>
              </div>
              <div class="form-control">
              <!-- 1st column -->
              <div class="w3-col l6 s6">

                <?php
                      for($i = 0; $i < (int)($counter/2); $i++)
                      {
                          // Accessed games
                          $games = $result_query->fetch_assoc();

                          $game_name = $games['game_name'];
                          $game_logo = $games['game_logo'];
                          $game_price = $games['game_price'];
                ?>

                <div class="w3-container w3-border w3-margin">
                  <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top" src=<?php echo $game_logo; ?> style="width:100%"></a>
                  <p><?php echo $game_name; ?><br><?php echo $game_price; ?> $ </p>
                  <input type="checkbox"  name= "game_id[]" value= "<?php echo $game_name; ?>"> Add to bundle<br>
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
                          $games = $result_query->fetch_assoc();

                          $game_name = $games['game_name'];
                          $game_logo = $games['game_logo'];
                          $game_price = $games['game_price'];
                ?>

                <div class="w3-container w3-border w3-margin">
                  <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top" src=<?php echo $game_logo; ?> style="width:100%"></a>
                  <p><?php echo $game_name; ?><br><?php echo $game_price; ?> $ </p>
                  <input type="checkbox" name= "game_id[]" value= "<?php echo $game_name; ?>"> Add to bundle<br>
                </div>

                <?php
                      }
                ?>

              </div>
              </div>
          </div>
          <!--End of Game grid-->

           <input type="submit" class="publish" value="Publish">
          </form>
        <!-- End Page Container -->
        </div>

      <!-- End Container -->
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
