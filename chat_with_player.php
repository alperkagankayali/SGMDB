<?php
    include("db.php");
    session_start();

    $player_id = $_SESSION['player_id'];

    // Access info about friend that message will be sent
    $send_id = $_GET['send_id'];
    $me = "SELECT * FROM player WHERE player_id = $player_id";
    $you = "SELECT * FROM player WHERE player_id = $send_id";
    $all_msg= "SELECT * FROM message WHERE player_id2 = $send_id AND player_id1 = $player_id union SELECT * FROM message WHERE player_id1 = $send_id AND player_id2 = $player_id ORDER BY time ASC";

    // Execute the query
    //$info = mysqli_query($db, $send_message_to);
    $messages = mysqli_query($db, $all_msg);
    $me = mysqli_query($db, $me);
    $you = mysqli_query($db, $you);
    //$messages_sent = mysqli_query($db, $previous_messages_sent);
    //$messages_received = mysqli_query($db, $previous_messages_received);

    $you= mysqli_fetch_array($you);
    $me= mysqli_fetch_array($me);
    // Number of rows
    //$counter = mysqli_num_rows($info); //should be 1
    $msg_count = mysqli_num_rows($messages); 
?>

<!DOCTYPE html>

<html>
<title>Chat</title>

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
    .container {
    border: 2px solid #dedede;
    background-color: darkturquoise;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
}

.container::after {
    content: "";
    clear: both;
    display: table;
    border-color: #ccc;
    background-color: #fff;
}

.darker {
    border-color: #ccc;
    background-color: #ddd;
}

.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #aaa;
}

.time-left {
    float: left;
    color: #999;
}
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
    <h1><br>Chat with <?php echo $you['username'];?></h1>
    </div>



  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Middle Column -->
    <div class="w3-col m7">
      <?php

      //echo $msg_count;
      for($i = 0; $i < $msg_count; $i++)
      {
          $row = mysqli_fetch_array($messages);
          if($row['player_id1'] == $player_id){ //sent
              echo "<div class=\"container darker\">";
              echo "<img src=";
              if($me['profile_picture'] != null) 
                echo $me['profile_picture'];
              else 
                echo "images/icons/avatar.png";
              echo "alt=\"Avatar\" class=\"right\" style=\"width:60px\">";
              echo "<p>"." ".$row['text']." "."</p>";
              echo "<span class=\"time-right\">";
              echo $row['time'];
              echo "</span>";
              echo "</div>";
          }
          else if($row['player_id2'] == $player_id){ //received
              echo "<div class=\"container darker\">";
              echo "<img src=";
              if($you['profile_picture'] != null) 
                echo $you['profile_picture']; 
              else 
                echo "images/icons/avatar.png";
              echo "alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">";
              echo "<p>"." ".$row['text']." "."</p>";
              echo "<span class=\"time-left\">";
              echo $row['time'];
              echo "</span>";
              echo "</div>";
          } 

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
