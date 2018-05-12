<?php
    include("db.php");
    session_start();

?>

<!DOCTYPE html>

<html>
<title>Publish a game</title>

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
      <a href="news_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
      <a href="about_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

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
      <h1 style="margin:20px"><br>Publishing game</h1>
    </div>


    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

      <!-- The Grid -->
      <div class="w3-row">

        <!-- Middle Column -->
        <div class="w3w3-center">

          <div class="w3-row white-font">

            <h1>Publish a game</h1>
            <p>Please fill in this form to publish your game.</p>
            <hr>
            <div class="signup-w3ls">
              <div class="signup-agile1">
                <form action="process_game_publish.php" method="post" enctype="multipart/form-data">

                  <!-- Game Name -->
                  <p>
                    <div class="form-control">
                      <label class="header">Name of the game:</label>
                      <div class="nl">
                          <input type="text" id="g_name" name="game_name" placeholder="Game name..." title="Please enter a game name" required="">
                      </div>
                    </div>
                  </p>

                  <br>

                  <!-- Game Price -->
                  <p>
                    <div class="form-control">
                      <label class="header">Price:</label>
                      <div class="nl">
                          <input type="number" step="any" min="0" id="g_price" name="game_price" placeholder="Price..." title="Please enter your game price" required="">
                      </div>
                    </div>
                  </p>

                  <br>

                  <!-- Game Platform -->
                  <p>
                    <div class="form-control">
                      <label class="header">Platform:</label>
                      <br>
                      <label>
                        <input type="checkbox" checked="checked" name="game_platform[]" value="Windows" style="margin-bottom:15px"> Windows
                      </label>
                      <label>
                        <input type="checkbox" checked="checked" name="game_platform[]" value="Mac" style="margin-bottom:15px"> macOS
                      </label>
                      <label>
                        <input type="checkbox" checked="checked" name="game_platform[]" value="Linux" style="margin-bottom:15px"> Linux
                      </label>
                    </div>
                  </p>

                  <br>

                  <!-- Game Category -->
                  <p>
                    <div class="form-control">
                      <label class="header">Category:</label>
                      <div class="nl">
                        <select name="game_category">
                          <option value="-">--Select a category--</option>
                          <option value="Action">Action</option>
                          <option value="Adventure">Adventure</option>
                          <option value="Casual">Casual</option>
                          <option value="Indie">Indie</option>
                          <option value="Multiplayer">Multiplayer</option>
                          <option value="Racing">Racing</option>
                          <option value="RPG">RPG</option>
                          <option value="Simulation">Simulation</option>
                          <option value="Sports">Sports</option>
                          <option value="Strategy">Strategy</option>
                        </select>
                      </div>
                    </div>
                  </p>

                  <br>

                  <!-- Game Sys Requirements -->
                  <p>
                    <div class="form-control">
                      <label class="header">System Requirements:</label>
                      <div class="nl">
                        <input id="g_sys_requirement" type="file" name="game_sys_requirements" placeholder="Textfile" required="" capture>
                      </div>
                    </div>
                  </p>

                  <br>

                  <!-- Game Logo -->
                  <p>
                    <div class="form-control">
                      <label class="header">Game Icon:</label>
                      <div class="nl">
                        <input id="g_logo" type="text" name="game_logo" placeholder="URL" required="" capture>
                      </div>
                    </div>
                  </p>

                  <br>

                  <p>By publishing this game as a company you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                  <!-- Publish (Submit) -->
                  <input type="submit" class="publish" value="Publish">

                </form>

              </div>
              <!--End of Game grid-->

            <!-- End Middle Column -->
            </div>

          <!-- End Grid -->
          </div>

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
