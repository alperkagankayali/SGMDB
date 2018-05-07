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

    // PLAYER INFORMATION -------------------------
    $player_firstname = $player['firstname'];
    $player_midname = $player['middlename'];
    $player_lastname = $player['lastname'];
    $player_picture = $player['profile_picture'];
    $player_email = $player['email'];

    //***********************************************

    // Acessing the stats of the player with the given player id
    $access_stats = "SELECT * FROM stats WHERE player_id = $player_id";

    // Execute the query
    $access_result = mysqli_query($db, $access_stats);

    // Result of the query
    $stats = $access_result->fetch_assoc();


    // STATS INFORMATION -------------------------
    $last_active_date = $stats['last_active_date'];
    $level = $stats['level'];

    //***********************************************

    // Acessing the stats of the player with the given player id
    $access_wallet = "SELECT * FROM wallet WHERE player_id = $player_id";

    // Execute the query
    $wallet_result = mysqli_query($db, $access_wallet);

    // Result of the query
    $wallet = $wallet_result->fetch_assoc();


    // WALLET INFORMATION
    $wallet_balance = $wallet['balance'];
    $payment_method = $wallet['payment_method'];
    $card_number = $wallet['card_number'];
    $expiration_date = $wallet['expiration_date'];
    $security_code = $wallet['security_code'];
    $balance = $wallet['balance'];

    // Passing wallet id
    $_SESSION['wallet_id'] = $wallet['wallet_id'];


    // GAME EXPERIENCE INFORMATION
    $game_exp_query = "SELECT * FROM game_experience WHERE player_id = $player_id";

    // executing the query
    $game_exp_exe = mysqli_query($db, $game_exp_query);

    // Number of tuples
    $counter = mysqli_num_rows($game_exp_exe);

    /*
        Here we will be a query for reports
    */

    $arr = array(10, 0, 10, 2, 200, 30, 1, 1, 3, 1, 4, 3);
?>

<!DOCTYPE html>

<html>
<title>Profile</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" type="text/css" href="css/bar_chart.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

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
    <h1><br>Profile</h1>
    </div>

    <img align="Middle" class="w3-image" src=<?php if($player_picture != '') echo $player_picture; else echo "images/icons/avatar.png";?> alt="Me" width="400" height="300" >

    <div class="w3-panel">
      <h4><br><?php echo $player_firstname." ".$player_midname." ".$player_lastname; ?></h4>
      <h6><br><?php echo $player_email; ?></h6>
      <h4><br>Level <?php echo $level; ?></h4>
      <h6><br>Last active date: <?php echo $last_active_date; ?></h6>
    </div>

      <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
      <!-- The Grid -->
      <div class="w3-row">
        <!-- Left Column -->
        <div class="w3-col m3">

          <?php
              if(mysqli_num_rows($wallet_result) == 0)
              {
          ?>

          <a href="add_wallet.php" class="w3-left w3-margin-bottom w3-padding w3-border w3w3-button">Add Wallet</a>

          <div class="w3-card w3-round white-font">
              <br><br><h4 class="w3-block w3-theme-l1 w3-left-align w3-left">You have no wallet!</h4>
          </div>

          <?php
              }
              else
              {
          ?>

          <!-- Accordion -->
          <div class="w3-card w3-round white-font">

              <a href="#" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-usd fa-fw w3-margin-left w3-large w3-text-teal w3-left-align"></i>Net Balance: <?php echo $wallet_balance; ?> $ </a>
              <a href="#" class="w3-button w3-block w3-theme-l1 w3-left-align">Card Number: <?php echo $card_number; ?></a>
              <a href="#" class="w3-button w3-block w3-theme-l1 w3-left-align"> Security Code: <?php echo $security_code; ?></a>
              <a href="#" class="w3-button w3-block w3-theme-l1 w3-left-align"> Expiration Date: <?php echo $expiration_date; ?></a>
              <a href="#" class="w3-button w3-block w3-theme-l1 w3-left-align"> Card type: <?php echo $payment_method; ?></a>

          </div>

          <a href="add_balance.php?wallet_id=<?php echo $wallet['wallet_id']?>; " class="w3-right w3-margin-bottom w3-padding w3w3-button">Add Balance</a>

          <?php
             }
          ?>

          <br>

        <!-- End Left Column -->
        </div>

        <!-- Middle Column -->
        <div class="w3-col m7">

          <!-- Chart -->
          <div id="chartContainer" style="height: 370px; width: 100%; margin: 0px auto; margin-left: 45px"></div>

          <br>

          <div class="w3-container w3-card w3-round w3-margin"><br>

            <?php
                  for($i = 0; $i < $counter; $i++)
                  {
                      // Accessed experience
                      $game_exp = $game_exp_exe->fetch_assoc();

                      $experience = $game_exp['experience'];
                      $play_hour = $game_exp['play_hour'];
                      $game_name = $game_exp['game_name'];

                      // Accessing game information (logo)
                      $game_exp = "SELECT game_logo FROM game WHERE game_name = '$game_name'";

                      // Executing the query
                      $access_logo_exe = mysqli_query($db, $game_exp);

                      // Result
                      $game_access_logo = $access_logo_exe->fetch_assoc();

                      $game_logo = $game_access_logo['game_logo'];
            ?>

            <div class="w3-container w3-card w3-margin w3-border">

              <img src=<?php echo $game_logo; ?> alt="Avatar" class="w3-left w3-circle w3-margin- w3-margin" style="width:60px">
              <h4><?php echo $game_name; ?></h4><br>
              <hr class="w3-clear">
              <p>Gameplay Time: <?php echo $play_hour; ?> hours</p>
              <p>Gained Experience: <?php echo $experience; ?> XP</p>
                <div class="w3-row-padding" style="margin:0 -16px">
                  <div class="w3-half">
                    <img src=<?php echo $game_logo; ?> style="width:100%" alt="Gameplay Screenshot" class="w3-margin-bottom">
                  </div>
              </div>

          </div>

            <?php
                  }
            ?>

          </div>

        <!-- End Middle Column -->
        </div>

      <!-- End Grid -->
      </div>

<!-- End Page Container -->
</div>




<script>

    window.onload = function () {

    var a = <?php echo json_encode($arr); ?>;

    var chart = new CanvasJS.Chart("chartContainer", {

          animationEnabled: true,
        	theme: "light2", // "light1", "light2", "dark1", "dark2"
        	title:{
        		text: "Your Monthly Purchases"
        	},
        	axisY: {
        		title: "Purchases of Player ($)"
        	},
        	data: [{
        		type: "column",
        		dataPoints: [
        			{ y: a[0],  label: "Jan" },
        			{ y: a[1],  label: "Feb" },
        			{ y: a[2],  label: "Mar" },
        			{ y: a[3],  label: "Apr" },
        			{ y: a[4],  label: "May" },
        			{ y: a[5],  label: "June" },
        			{ y: a[6],  label: "July" },
        			{ y: a[7],  label: "Aug" },
              { y: a[8],  label: "Sep" },
              { y: a[9],  label: "Oct" },
              { y: a[10], label: "Nov" },
              { y: a[11], label: "Dec" }
        		]
        	}]
        });
      chart.render();

    }
</script>

</body>
</html>
