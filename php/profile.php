<?php
    include("db.php");
    session_start();

    // Player id
    $player_id = $_SESSION['player_id'];

    // Accessing Player information
    $access_player = "SELECT * FROM player WHERE player_id = $player_id";

    // Execute the query
    $result_query = mysqli_query($db, $access_player);

    // Result of the query
    $player = $result_query->fetch_assoc();

    // Player information
    $player_firstname = $player['firstname'];
    $player_midname = $player['middlename'];
    $player_lastname = $player['lastname'];
    $player_picture = $player['profile_picture'];
    $player_email = $player['email'];

?>

<!DOCTYPE html>

<html>
<title>Profile</title>

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
            <img src=<?php if($_SESSION['player_pp'] != '') echo $_SESSION['player_pp']; else echo "images/profil.jpg";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
         </a>
 </div>
</div>





<!-- Content -->
<div class="w3-content white-font" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
    <div class="w3-panel">
    <h1><br>Profile</h1>
    </div>
   <img align="Middle" class="w3-image" src=<?php if($player_picture != '') echo $player_picture; else echo "images/profil.jpg";?> alt="Me" width="400" height="300" >
   <div class="w3-panel">
    <h4><br><?php echo $player_firstname." ".$player_midname." ".$player_lastname; ?></h4>
    <h6><br><?php echo $player_email; ?></h6>
    <h4><br>Level 22- Lion</h4>
  </div>


  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">

      <!-- Accordion -->
      <div class="w3-card w3-round white-font">

          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-usd fa-fw w3-margin-left w3-large w3-text-teal w3-left-align"></i>Net Balance: 25.99</button><!--needs to be revised(vertical align problem)-->
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align">Card Number: 0670 **** **** **29</button>
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Security Code: 671</button>
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"> Expiration Date: 7/2019</button>
          <select class="w3-button w3-block w3-theme-l1 w3-left-align">
            <option value="Wallet1">MasterCard 1</option>
            <option value="Wallet2">MasterCard 2</option>
            <option value="Wallet3">Visa 1</option>
            <option value="Wallet4">Visa 2</option>
          </select>

      </div>
      <br>




    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">



      <div class="w3-container w3-card w3-round w3-margin"><br>
        <img src="images/ppass.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <!--<span class="w3-right w3-opacity">1 min</span><-->
        <h4>Assassin's Creed Origins</h4><br>
        <hr class="w3-clear">
        <p>Gameplay Time: 3 hours</p>
        <p>Gained Experience: 500</p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
              <img src="images/assassgameplay.jpg" style="width:100%" alt="Gameplay Screenshot" class="w3-margin-bottom">
            </div>
        </div>

      </div>



    <!-- End Middle Column -->
    </div>



  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>





<script>
// Slideshow
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demodots");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-white";
}
</script>

</body>
</html>
