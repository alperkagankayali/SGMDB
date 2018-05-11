<?php
    include("db.php");
    session_start();

    // Acessing the player id who has logged on
    $player_id = $_SESSION['player_id'];


    // Accessing game name and game price
    $Text = urldecode($_REQUEST['game_info']);
    //echo $Text;
    $game_names = json_decode($Text);
    //print_r($game_names);
    $array = json_decode(json_encode($game_names), True);
    //echo (array_values($array)[0]);

    // Access all friends of the player, who do not have the chosen games
    $access_friends = "SELECT F.player_id2 FROM friendship as F
                      WHERE F.player_id1 = $player_id AND
                      NOT EXISTS (SELECT * FROM library as L
                                  WHERE L.player_id = F.player_id2 AND";

    //var_dump($array);
    foreach($array as $game_name => $price){
        //echo $price;
        $access_friends = $access_friends . " L.game_name = '$game_name' AND";
      }


      $Text = json_encode($array);
      $requestText = urlencode($Text);

      echo "size " . sizeof($array);
      if(!empty($array))
        $access_friends = substr($access_friends, 0, -3);
      else
        $access_friends = substr($access_friends, 0, -4);


      $access_friends = $access_friends . ");";
    //$access_friends = $access_friends . ");"; 
    /*echo "<br>";
    echo $access_friends;*/

    // Execute the query
    $result_query = mysqli_query($db, $access_friends);
    //echo "<br>";

    //var_dump($result_query);
    // Number of rows
    $counter = mysqli_num_rows($result_query);


?>


<!DOCTYPE html>

<html>
<title>List of Friends</title>

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
    <h1><br>Friends do not have the bundle</h1>
    </div>



  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Middle Column -->
    <div class="w3-col m7">


      <?php
        //echo $access_friends;
        //echo $counter;
          for($i = 0; $i < $counter; $i++)
          {
              // Result
              $result = $result_query->fetch_assoc();

              $player_id2 = $result['player_id2'];    //friend id

              $firstname = mysqli_query($db, "SELECT firstname FROM player WHERE player_id = $player_id2")->fetch_assoc()['firstname'];
              $midname = mysqli_query($db, "SELECT middlename FROM player WHERE player_id = $player_id2")->fetch_assoc()['middlename'];
              $lastname = mysqli_query($db, "SELECT lastname FROM player WHERE player_id = $player_id2")->fetch_assoc()['lastname'];
              $profile_picture = mysqli_query($db, "SELECT profile_picture FROM player WHERE player_id = $player_id2")->fetch_assoc()['profile_picture'];
      ?>
        <div class="w3-container w3-card w3-round w3-margin"><br>
          <img src=<?php if($profile_picture != null) echo $profile_picture; else echo "images/icons/avatar.png";?> alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <h4><?php echo $firstname." ".$midname." ".$lastname; ?></h4><br>
          <hr class="w3-clear">
          <a href="process_buying_gift_bundle.php?receiver_id=<?php echo $player_id2 ?>&game_info=
          <?php echo $requestText;?>" class="w3-button w3-block w3-theme-l1 w3-left-align">Send Gift ></a>
        </div>

      <?php
          }
      ?>

    <!-- End Middle Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>

</body>
</html>