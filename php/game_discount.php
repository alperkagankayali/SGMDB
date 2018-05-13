<?php
    include("db.php");
    session_start();
    $game_name = "";
    $id = $_SESSION['company_name'];
    if(is_array($id)){
      $id = $id['company_name'];
    }
    $query = "SELECT game_name, game_logo FROM game WHERE company_name = '$id'";
    $access_query = mysqli_query($db, $query);
    $counter = mysqli_num_rows($access_query);
?>


<!DOCTYPE html>

<html>
<title>Games You Have</title>

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
          <a href="store.php" class="w3-bar-item w3-button w3-teal nav_links"><i class="fa fa-home w3-margin-right"></i></a>
          <a href="published_games.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Published Games</a>
          <a href="news_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
          <a href="about_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

          <!-- Logout -->
          <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
            <img src="images/icons/logout.png" class="w3-circle" style="height:23px;width:23px" alt="Log out">
          </a>




 </div>
</div>





<!-- Content -->
<div class="w3-content white-font" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
    <div class="w3-panel">
    <h1><br>Games You Have</h1>
    </div>



  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Middle Column -->
    <div class="w3-col m7">

       <form action="process_game_discount.php" method="post">
      <?php

          //echo $id;
          //echo $counter;
          for($i = 0; $i < $counter; $i++)
          {
              // Result
              $array = $access_query->fetch_assoc();
              //print_r($array);
              $game_name = $array['game_name'];
              //echo $array['game_logo'];
              $game_logo = $array['game_logo'];
              $_SESSION['game_name'] = $game_name;

      ?>

        <div class="w3-container w3-card w3-round w3-margin" method="post"><br>
          <input type="checkbox" class="w3-left" name="check<?php echo $game_name ?>"></input>
          <input type="number" step="any" min="0" id="g_price" name="game_price<?php echo $game_name ?>" placeholder="Discount..." title="Please enter your discount amount"></input>
          <input type="text" id="event_name" name="event_name<?php echo $game_name ?>" placeholder="Event..." title="Please enter the event you want to include"></input>
          <!--<span class="w3-right w3-opacity">1 min</span><-->
            <h4 class="game_name" name="game_name[]"><?php echo $game_name; ?></h4><br>
          <hr class="w3-clear">
        </div>



      <?php
          }
      ?>
      <button type="submit" class="w3-button w3-block w3-theme-l1 w3-left-align">Do it! ></button>
      </form>

    <!-- End Middle Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>

</body>
</html>
