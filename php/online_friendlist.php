<?php
    include("db.php");
    session_start();

    // Acessing the player id who has logged on
    $player_id = $_SESSION['player_id'];
    $game_name = $_GET['game_name'];

    // Access all friends of the player

    $access_friends = "SELECT F.player_id2 FROM friendship as F WHERE player_id1 = $player_id
                      AND EXISTS (SELECT * FROM library WHERE game_name = '$game_name' AND player_id = F.player_id2)";


    // Execute the query
    $result_query = mysqli_query($db, $access_friends);

    // Number of rows
    $counter = mysqli_num_rows($result_query);
?>


<!DOCTYPE html>

<html>
<title>Online Friends</title>

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
<div class="w3-content white-font" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
    <div class="w3-panel">
    <h1><br>Online Friends</h1>
    </div>



  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Middle Column -->
    <div class="w3-col m7">

      <form action="gameplay.php?game_name=<?php echo $game_name; ?>" method="post">
      <?php
          for($i = 0; $i < $counter; $i++)
          {
              // Result
              $result = $result_query->fetch_assoc();

              $player_id2 = $result['player_id2'];


              $firstname = mysqli_query($db, "SELECT firstname FROM player WHERE player_id = $player_id2 AND status = 1")->fetch_assoc()['firstname'];
              $midname = mysqli_query($db, "SELECT middlename FROM player WHERE player_id = $player_id2 AND status = 1")->fetch_assoc()['middlename'];
              $lastname = mysqli_query($db, "SELECT lastname FROM player WHERE player_id = $player_id2 AND status = 1")->fetch_assoc()['lastname'];
              $profile_picture = mysqli_query($db, "SELECT profile_picture FROM player WHERE player_id = $player_id2 AND status = 1")->fetch_assoc()['profile_picture'];

              if($firstname == null)
                  continue;
      ?>

        <div class="w3-container w3-card w3-round w3-margin"><br>
          <input type="checkbox" class="w3-left" name="check[]"></input>
          <img src=<?php if($profile_picture != null) echo $profile_picture; else echo "images/icons/avatar.png";?> alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!--<span class="w3-right w3-opacity">1 min</span><-->
          <h4><?php echo $firstname." ".$midname." ".$lastname; ?></h4><br>
          <hr class="w3-clear">
        </div>

      <?php
          }
      ?>
      <button type="submit" class="w3-button w3-block w3-theme-l1 w3-left-align">Invite friend ></a>
    </form>
    <!-- End Middle Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>

</body>
</html>
