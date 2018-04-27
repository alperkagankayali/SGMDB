<!DOCTYPE html>

<html>
<title>About</title>

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
          <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Chat</a>
          <a href="about.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

          <!--Notif button-->
          <button class="w3-button w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"></span></button>

          <!--Search-->
          <input type="text" placeholder="Search.." name="search" class="search-form">
          <button type="submit"><i class="fa fa-search search-form"></i></button>

          <!-- Logout -->
          <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
            <img src="images/icons/logout.png" class="w3-circle" style="height:23px;width:23px" alt="Log out">
          </a>

          <!--Profile avatar-->
         <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            <img src=<?php if($_SESSION['player_pp'] != '') echo $_SESSION['player_pp']; else echo "images/icons/avatar.png";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
         </a>

      </div>
  </div>

  <!-- Content -->
  <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

    <div class="w3-panel white-font w3-border">
      <h1 style="margin:20px"><br>ABOUT</h1>
    </div>


  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">



      <!-- Middle Column -->
      <div class="w3w3-center">

          <div class="w3-row white-font">

            <div class="w3-panel white-font">
              <h4><br>About project</h4>
            </div>

            <p> Social Gaming Marketplace is a web-based application for observing, buying, publishing games and etc. The project is designed to be used by players, companies which contain publishers and developers. System includes information about games, their developers and companies which are published the game. Players can view, purchase games, add other players to their friend list, invite them to the games, make reviews and add ratings to the games, check whether a game supports the platform (system requirements) of their computers or gaming consoles, catch events, benefit from the bundles (a collection of some games with more suitable price) or discounts on the games, categorize the games according to the game genres, view the library of the games they bought, add games to their wishlist or cart and etc. With this web application, we are planning to create a social market, introduces considerably more suitable prices, which could draw the attention of the gamers from the economic point of view. In addition, we would like to create a huge gaming network with a number of players on it. The security of payment and maintenance of the data are so important factors in this database system so that the users are not put in any unwanted situation. Shortly, Social Gaming Marketplace is a virtual bazaar such that companies will demonstrate their games and players will buy and play with their friends.
            </p>

          </div>

          <div class="w3-row white-font">

              <div class="w3-panel white-font">
                <h4><br>Developers</h4>
              </div>

              <div class="w3-col l3 s6">
                <div class="w3-container">
                  <a href="#"><img src="images/fuad.jpeg" style="width:100%"></a>
                  <p>Fuad Aghazada</p>
                </div>
              </div>

              <div class="w3-col l3 s6">
                <div class="w3-container">
                  <a href="#"><img src="images/enes.jpeg" style="width:100%"></a>
                  <p>Enes Varol</p>
                </div>
              </div>

              <div class="w3-col l3 s6">
                <div class="w3-container">
                  <a href="#"><img src="images/alper.jpeg" style="width:100%"></a>
                  <p>Alper Kağan Kayalı</p>
                </div>
              </div>

              <div class="w3-col l3 s6">
                <div class="w3-container">
                  <a href="#"><img src="images/eliz.jpeg" style="width:100%"></a>
                  <p>Eliz Tekcan</p>
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
