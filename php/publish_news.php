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
      <img src=<?php include("picture_load.php");?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
      </a>

    </div>
  </div>


  <!-- Content -->
  <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

    <div class="w3-panel white-font w3-border">
      <h1 style="margin:20px"><br>Publishing news</h1>
    </div>


    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

      <!-- The Grid -->
      <div class="w3-row">

        <!-- Middle Column -->
        <div class="w3w3-center">

          <div class="w3-row white-font">

            <h1>Publishing news</h1>
            <p>Please fill in this form to publish your news.</p>
            <hr>
            <div class="signup-w3ls">
              <div class="signup-agile1">
                <form action="process_news_publish.php" method="post" enctype="multipart/form-data">

                  <!-- Header -->
 <p>
                    <div class="form-control">
                      <label class="header">Header:</label>
                      <div>
                          <textarea placeholder= "Header" rows="1" cols="80" id="header" name="header" required=""></textarea>
                        </div>
                    </div>
                  </p>


                  <br>

                  <!-- Text -->
                  <p>
                    <div class="form-control">
                      <label class="header">Text:</label>
                      <div>
                          <textarea placeholder= "Text" rows="5" cols="80" id="text" name="text" required=""></textarea>
                        </div>
                    </div>
                  </p>

                  <br>


                  <!-- News Picture -->
                    <p>
                      <div class="form-control">
                        <label class="header">News Image:</label>
                        <div class="nl">
                          <input id="news_image" type="file" name="news_image" placeholder="Logo URL" capture>
                        </div>
                      </div>
                    </p>


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
