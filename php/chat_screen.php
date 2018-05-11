<?php
    include("db.php");
    session_start();

    echo "<br><br><br>";

    // Access the id of the player 1 - sender player & player 2 - receiver player
    $sender_id = $_SESSION['player_id'];
    $receiver_id = $_GET['receiver_id'];
    $sender_pp = null;
    $receiver_pp = $_GET['receiver_pp'];

    $receiver_username = mysqli_query($db, "SELECT username FROM player WHERE player_id = $receiver_id")->fetch_assoc()['username'];

    if($_SESSION['player_pp'] != '') $sender_pp = ("signup/uploads/". $_SESSION['player_pp']); else $sender_pp = "images/icons/avatar.png";

    // Messages between sender and receiver
    $messages_exec = mysqli_query($db, "SELECT * FROM message WHERE (player_id1 = $sender_id AND player_id2 = $receiver_id) OR (player_id1 = $receiver_id AND player_id2 = $sender_id)");

    $num_rows = mysqli_num_rows($messages_exec);
?>

<!DOCTYPE html>

<html>
<title>Chat Screen</title>

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
    background-color: #f1f1f1;
    border-radius: 5px; padding: 10px; margin: 10px 0; }

    .darker { border-color: #ccc;background-color: #ddd;}
    .container::after {content: ""; clear: both; display: table;}
    .container img { float: left; max-width: 60px; width: 100%; margin-right: 20px; border-radius: 50%; }
    .container img.right { float: right; margin-left: 20px; margin-right:0;}
    .time-right {float: right; color: #aaa;}
    .time-left {float: left; color: #999;}
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
            <img src=<?php if($_SESSION['player_pp'] != '') echo ("signup/uploads/". $_SESSION['player_pp']); else echo "images/icons/avatar.png";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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
      <h1 style="margin:20px"><br>CHAT CONTENT</h1>
    </div>


  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Middle Column -->
      <div class="w3w3-center">

          <div class="w3-row white-font" style="overflow: scroll">

              <div class="w3-panel white-font">
                <h4 class="w3-left"><br>Chat with <u><?php echo $receiver_username; ?></u></h4>
                <a href="process_clearing_chat.php?sender_id=<?php echo $sender_id; ?>&receiver_id=<?php echo $receiver_id; ?>" class="w3-right"> Clear Chat </a>
              </div>

              <?php
                  for($i = 0; $i < $num_rows; $i++)
                  {
                      $messages = $messages_exec->fetch_assoc();

                      $message_text = $messages['message_text'];
                      $message_date = $messages['message_date'];
                      $sender = $messages['player_id1'];
                      $receiver = $messages['player_id2'];

                      if($sender == $sender_id)
                      {
              ?>

              <div class="container darker background">
                <img src=<?php echo $sender_pp; ?> alt="Avatar" class="right" style="width:100%;">
                <p class="w3-right"><?php echo $message_text; ?></p>
                <span class="time-left w3-margin-top"><?php echo $message_date; ?></span>
              </div>

              <?php
                      }
                      else
                      {
              ?>

              <div class="container background">
                <img src=<?php echo $receiver_pp; ?> alt="Avatar" style="width:100%;">
                <p><?php echo $message_text; ?></p>
                <span class="time-right w3-margin-top"><?php echo $message_date; ?></span>
              </div>

              <?php
                      }
                  }
              ?>

          </div>

      <!-- End Middle Column -->
      </div>

      <!--Message send-->
      <form action="process_send_message.php?sender_id=<?php echo $sender_id; ?>&receiver_id=<?php echo $receiver_id; ?>&receiver_pp=<?php echo $receiver_pp; ?>" method="post">
        <div class="w3-container w3-center w3-card w3-round w3-margin white-font w3w3-center">
            <input class="w3-margin" type="text" id="text_review" name="chat_field" placeholder="Write a message..." style="width: 80%">
            <input type="submit" class="send" value="Send">
        </div>
      </form>

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
