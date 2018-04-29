<!DOCTYPE html>

<html>
<title>Event</title>

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
          <a href="library.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Library</a>
          <a href="store.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Store</a>
          <a href="news.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
          <a href="wish_list.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Wishlist</a>
          <a href="cart.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Cart</a>
          <a href="chat.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Chat</a>
          <a href="about.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

          <!--Notif button-->
          <button class="w3-button w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"></span></button>

          <!-- Logout -->
          <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
            <img src="images/icons/logout.png" class="w3-circle" style="height:23px;width:23px" alt="Log out">
          </a>

          <!--Profile avatar-->
         <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            <img src=<?php if($_SESSION['player_pp'] != '') echo $_SESSION['player_pp']; else echo "images/icons/avatar.png";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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
      <h1 style="margin:20px"><br>EVENTS</h1>
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

      <!-- Middle Column -->
      <div class="w3-col m7">

          <!-- Slideshow -->
          <div class="w3-container">

            <div class="w3-display-container mySlides">
              <img src="images/game1.jpg" style="width:100%">
            </div>
            <div class="w3-display-container mySlides">
              <img src="images/game2.jpg" style="width:100%">
            </div>
            <div class="w3-display-container mySlides">
              <img src="images/game3.jpg" style="width:100%">
            </div>

            <!-- Slideshow next/previous buttons -->
            <div class="w3-container background white-font w3-padding w3-xlarge">
              <div class="w3-left" onclick="plusDivs(-1)"><i class="fa fa-arrow-circle-left w3-hover-text-teal"></i></div>
              <div class="w3-right" onclick="plusDivs(1)"><i class="fa fa-arrow-circle-right w3-hover-text-teal"></i></div>

              <div class="w3-center">
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
              </div>
            </div>

          </div>
          <!-- End of Slideshow -->

          <!--Game grid-->
          <div class="w3-row white-font">

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>

                <h4><br>Bundles</h4>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/game1.jpg" style="width:100%"></a>
                    <p>Witcher 3<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/witcher2.jpg" style="width:100%"></a>
                    <p>Witcher 2<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/heartandstone.png" style="width:100%"></a>
                    <p>Witcher Dlc1<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/bloodandwine.jpg" style="width:100%"></a>
                    <p>Witcher Dlc2<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/game2.jpg" style="width:100%"></a>
                    <p>Rocket League<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/game3.jpg" style="width:100%"></a>
                    <p>Euro Truck<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/sanandreas.jpg" style="width:100%"></a>
                    <p>Gta Sanandreas<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="bundle_information.html"><img src="images/gta5.jpg" style="width:100%"></a>
                    <p>Gta 5<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

            </div>

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>

                <h4><br>Games with discounts</h4>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/game1.jpg" style="width:100%"></a>
                    <p>Witcher 3<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/witcher2.jpg" style="width:100%"></a>
                    <p>Witcher 2<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/heartandstone.png" style="width:100%"></a>
                    <p>Witcher Dlc1<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/bloodandwine.jpg" style="width:100%"></a>
                    <p>Witcher Dlc2<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/game2.jpg" style="width:100%"></a>
                    <p>Rocket League<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/game3.jpg" style="width:100%"></a>
                    <p>Euro Truck<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

                <div class="w3-col l3 s6">
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/sanandreas.jpg" style="width:100%"></a>
                    <p>Gta Sanandreas<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                  <div class="w3-container">
                    <a href="game_information.html"><img src="images/gta5.jpg" style="width:100%"></a>
                    <p>Gta 5<br><b><del> $20.99 </del></b><br>$13.99 </b></p>
                  </div>
                </div>

            </div>

          </div>
          <!--End of Game grid-->

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
