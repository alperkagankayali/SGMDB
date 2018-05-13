<?php
    include("db.php");
    session_start();

    // Accessing the name of the game whose link is clicked
    $game_name = $_GET['game_name'];
    //
    // Accessing the player's id who logged in
    $player_id = $_SESSION['player_id'];

    // Qeuery for accessing the game with the given name
    $access_game = "SELECT * FROM game WHERE game_name = '$game_name'";

    // Executing the Query
    $result_query = mysqli_query($db, $access_game);

    // Fetching the game information from the result of query
    $game_information = $result_query->fetch_assoc();

    // GAME INFORMATION
    $game_price = $game_information['game_price'];
    $game_logo = $game_information['game_logo'];
    $game_platform = $game_information['platform'];
    $game_category = $game_information['game_category'];
    $game_sys_req = $game_information['system_requirements'];
    $game_release_date = $game_information['release_date'];
    $company_name = $game_information['company_name'];
    $_SESSION['company_name'] = $company_name;

    // CHECKING if teh game is in the user's library
    $check_library = "SELECT * FROM library WHERE player_id = $player_id AND game_name = '$game_name';";

    // Executing the query
    $result_check = mysqli_query($db, $check_library);

    // Number of rows
    $row_size = mysqli_num_rows($result_check);


    // GETTING REVIEWS
    $access_reviews = "SELECT review_text, review_date, player_id FROM review NATURAL JOIN writes
                       WHERE game_name = '$game_name'";

    // Executing query
    $result_reviews = mysqli_query($db, $access_reviews);

    // Number of rows
    $counter = mysqli_num_rows($result_reviews);

    // GETTING AVERAGE RATING
    $avg_rating = mysqli_query($db, "SELECT AVG(rating) as avgRating FROM rating NATURAL JOIN rate WHERE game_name = '$game_name'")->fetch_assoc()['avgRating'];

    include("process_game_requests.php");
?>

<!DOCTYPE html>

<html>
<title>Game Information</title>

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
    .checked { color: orange; }
</style>

<!--*************************************************************************************************-->

<body class="background">

  <!-- Navbar -->
  <div class="w3-top w3-green background">
      <div class="w3-bar w3-theme-d2 w3-left-align">

          <!--Nav buttons-->
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
          <a href="store.php" class="w3-bar-item w3-button w3-teal nav_links"><i class="fa fa-home w3-margin-right"></i></a>
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
            <img src=<?php include("picture_load.php");?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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
      <h1 style="margin:20px"><br>Game Information</h1>
    </div>


    <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Middle Column -->
      <div class="w3w3-center">

        <div class="w3-panel white-font">
          <h4><br><?php echo $game_name; ?></h4>
          <h6><br><?php echo $company_name; ?></h6>
        </div>

        <!--Slide show-->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>

          <div class="w3-display-container mySlides">
            <img src=<?php $_SESSION['game_name'] = $game_name; include("picture_load.php"); ?> style="width:100%">
          </div>
          <div class="w3-display-container mySlides">
            <img src=<?php $_SESSION['game_name'] = $game_name; include("picture_load.php"); ?> style="width:100%">
          </div>
          <div class="w3-display-container mySlides">
            <img src=<?php $_SESSION['game_name'] = $game_name; include("picture_load.php"); ?> style="width:100%">
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
        <!-- End of Slideshow-->

        <!--Buy/Play now-->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>

          <?php
                if($row_size == 0)
                {
          ?>

          <p class="w3-center"><?php echo $game_price; ?> $</p>
          <a href="process_buying_from_store.php?game_name=<?php echo $game_name; ?>&game_price=<?php echo $game_price; ?>" class="w3-button w3-block w3-theme-l1 ">Buy now</a>
          <a href="process_adding_to_cart.php?game_name=<?php echo $game_name; ?>" class="w3-button w3-block w3-theme-l1 "><img src="images/icons/cart.png" style="width:3%">Add to cart</a>
          <a href="process_adding_to_wishlist.php?game_name=<?php echo $game_name; ?>" class="w3-button w3-block w3-theme-l1 "><img src="images/icons/wish.png" style="width:1%">Add to wish list</a>

          <?php
                }
                else
                {
          ?>
          <a href="gameplay.php?game_name=<?php echo $game_name; ?>" class="w3-button w3-block w3-border w3-theme-l1 w3-margin-bottom">Play</a>
          <a href="online_friendlist.php?game_name=<?php echo $game_name; ?>" class="w3-button w3-block w3-border w3-theme-l1 w3-margin-bottom">Play With Friends </a>
          <?php
                }
          ?>
          <a href="friendlist.php?game_name=<?php echo $game_name; ?>&game_price=<?php echo $game_price; ?>" class="w3-button w3-block w3-border w3-theme-l1 w3-margin-bottom"><img src="images/icons/gift.png" style="width:2%">Buy as a Gift</a>
        </div>

        <!-- Rating -->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font w3w3-center"><br>
            <h4>RATING</h4><br>

            <div class="w3-container w3-margin-bottom w3-center">

              <!-- Rating stars -->
              <?php
                  for($k = 0; $k < 5; $k++)
                  {
                      if($k < $avg_rating)
                      {

              ?>
              <span class="fa fa-star checked"></span>
              <?php
                      }
                      else
                      {

              ?>
              <span class="fa fa-star"></span>
              <?php
                      }
                }
              ?>

              <!-- Give a rating the game is in your library -->
              <?php
                    if($row_size != 0)
                    {
              ?>

              <form action="process_game_rating.php?game_name=<?php echo $game_name; ?>" method="post">
                <div class="w3-container w3-center w3-card w3-round w3-margin white-font w3-center">
                    <div class="nl">
                      <label class="header">Give a rating:</label>
                      <select name="rating" class="w3-margin">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                      </select>
                    </div>
                    <input type="submit" class="send" value="RATE">
                </div>
              </form>

              <?php
                    }
                    if(mysqli_num_rows(mysqli_query($db, "SELECT * FROM rating NATURAL JOIN rate WHERE player_id = $player_id")) != 0)
                    {
                        $rating = mysqli_query($db, "SELECT * FROM rating NATURAL JOIN rate WHERE player_id = $player_id")->fetch_assoc()['rating'];

                        $warning = "You have already rated this game by ".$rating.". You can update your choice!";
              ?>

              <h5><?php echo $warning; ?></h5>

              <?php
                    }
              ?>

            </div>
        </div>
        <?php $_SESSION['game_name'] = $game_name; ?>
        <!--About game -->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
            <h4>ABOUT THIS GAME</h4><br>
            <hr class="w3-clear">
            <p><?php
                include("sys_requirements_read.php");
                $array = $_SESSION['game_about'];
                echo $array[0];
                for($i = 1; $i < count($array); $i++){
                  if($i % 2 == 1){
                    echo "<h6>" . $array[$i] . "</h6>";
                  }
                  else{
                    echo $array[$i];
                  }
                }
                ?>

            </p>
        </div>

        <br>

        <!--System Requirements -->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font w3w3-center"><br>
            <h4>SYSTEM REQUIREMENTS</h4><br>
            <hr class="w3-clear">
            <div class="w3-row white-font">
                <div class="w3-col l6 s6">
                  <div class="w3-container">
                      <h6>Minimum</h6>
                        <ul>
                          <li><b>OS:</b><?php echo $_SESSION['game_requirements'][0] ?> </li>
                          <li><b>Processor:<b> <?php echo $_SESSION['game_requirements'][1] ?> </li>
                          <li><b>Memory:</b> <?php echo $_SESSION['game_requirements'][2] ?> </li>
                          <li><b>Graphics:</b> <?php echo $_SESSION['game_requirements'][3] ?> </li>
                          <li><b>Storage:</b> <?php echo $_SESSION['game_requirements'][4] ?> </li>
                        </ul>
                  </div>
                </div>

                <div class="w3-col l6 s6">
                  <div class="w3-container">
                      <h6>Recommended</h6>
                      <ul>
                        <li><b>OS:</b> <?php echo $_SESSION['game_requirements'][5] ?> </li>
                        <li><b>Processor:<b> <?php echo $_SESSION['game_requirements'][6] ?> </li>
                        <li><b>Memory:</b> <?php echo $_SESSION['game_requirements'][7] ?> </li>
                        <li><b>Graphics:</b> <?php echo $_SESSION['game_requirements'][8] ?> </li>
                        <li><b>Storage:</b> <?php echo $_SESSION['game_requirements'][9] ?> </li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>

        <br>

        <!--Reviews -->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font w3w3-center" style="overflow:scroll"><br>
            <h4>REVIEWS</h4><br>
            <hr class="w3-clear">

        <?php
              for($i = 0; $i < $counter; $i++)
              {
                  $review = $result_reviews->fetch_assoc();

                  $review_date = $review['review_date'];
                  $review_text = $review['review_text'];
                  $player_id = $review['player_id'];

                  // Accessing the name of the player
                  $access_player_info = "SELECT firstname, middlename, lastname FROM player WHERE player_id = $player_id";

                  // Executing the query
                  $access_player_exec = mysqli_query($db, $access_player_info);

                  $player = $access_player_exec->fetch_assoc();

                  $firstname = $player['firstname'];
                  $midname = $player['middlename'];
                  $lastname = $player['lastname'];
        ?>

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
              <span class="w3-right w3-opacity"><?php echo $review_date; ?></span>
              <h4><?php echo $firstname." ".$midname." ".$lastname; ?></h4><br>
              <hr class="w3-clear">
              <p><?php echo $review_text; ?></p>
            </div>
        <?php
              }
        ?>
        </div>

        <!-- Write a review if the game is in your library -->
        <?php
              if($row_size != 0)
              {
        ?>

        <form action="process_adding_review.php?game_name=<?php echo $game_name; ?>" method="post">
          <div class="w3-container w3-center w3-card w3-border w3-round w3-margin white-font w3w3-center">
              <input class="w3-margin" type="text" id="text_review" name="review_text" placeholder="Write a Review" style="width: 80%">
              <input type="submit" class="send" value="Send">
          </div>
        </form>

        <?php
              }
        ?>


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
