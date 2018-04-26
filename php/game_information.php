<?php
    include("db.php");
    session_start();

    // Accessing the name of the game whose link is clicked
    $game_name = $_REQUEST['game_name'];



    // Qeuery for accessing the game with the given name
    $access_game = "SELECT * FROM game WHERE game_name = '$game_name'";

    // Executing the Query
    $result_query = mysqli_query($db, $access_game);

    // Fetching the game information from the result of query
    $game_information = $result_query->fetch_assoc();

    // GAME INFORMATION
    $game_price = $game_information['game_price'];
    $game_logo = $game_information['game_logo'];
    $game_platform = $game_information['game_platform'];
    $game_category = $game_information['game_category'];
    $game_rating = $game_information['rating'];
    $game_sys_req = $game_information['system_requirements'];
    $game_release_date = $game_information['release_date'];
    $company_name = $game_information['company_name'];
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
            <img src=<?php if($_SESSION['player_pp'] != '') echo $_SESSION['player_pp']; else echo "images/profil.jpg";?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
         </a>
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
            <img src=<?php echo $game_logo; ?> style="width:100%">
          </div>
          <div class="w3-display-container mySlides">
            <img src="images/witcher/witcher2.jpg" style="width:100%">
          </div>
          <div class="w3-display-container mySlides">
            <img src="images/witcher/witcher3.jpg" style="width:100%">
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
          <p class="w3-center"><?php echo $game_price; ?> $</p>
          <a href="#" class="w3-button w3-block w3-theme-l1 ">Buy now</a>
          <a href="process_adding_to_cart.php?game_name=<?php echo $game_name; ?>" class="w3-button w3-block w3-theme-l1 "><img src="images/icons/cart.png" style="width:3%">Add to cart</a>
          <a href="process_adding_to_wishlist.php?game_name=<?php echo $game_name; ?>" class="w3-button w3-block w3-theme-l1 "><img src="images/icons/wish.png" style="width:1%">Add to wish list</a>
        </div>

        <!--About game -->
        <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
            <h4>ABOUT THIS GAME</h4><br>
            <hr class="w3-clear">
            <p>The Witcher: Wild Hunt is a story-driven, next-generation open world role-playing game set in a visually stunning fantasy universe full of meaningful choices and impactful consequences. In The Witcher you play as the professional monster hunter, Geralt of Rivia, tasked with finding a child of prophecy in a vast open world rich with merchant cities, viking pirate islands, dangerous mountain passes, and forgotten caverns to explore.

                <h6>PLAY AS A HIGHLY TRAINED MONSTER SLAYER FOR HIRE</h6>
                Trained from early childhood and mutated to gain superhuman skills, strength and reflexes, witchers are a distrusted counterbalance to the monster-infested world in which they live.
                Gruesomely destroy foes as a professional monster hunter armed with a range of upgradeable weapons, mutating potions and combat magic.
                Hunt down a wide range of exotic monsters from savage beasts prowling the mountain passes to cunning supernatural predators lurking in the shadows of densely populated towns.
                Invest your rewards to upgrade your weaponry and buy custom armour, or spend them away in horse races, card games, fist fighting, and other pleasures the night brings.

                <h6>EXPLORE A MORALLY INDIFFERENT FANTASY OPEN WORLD</h6>
                Built for endless adventure, the massive open world of The  Witcher sets new standards in terms of size, depth and complexity.
                Traverse a fantastical open world: explore forgotten ruins, caves and shipwrecks, trade with merchants and dwarven smiths in cities, and hunt across the open plains, mountains and seas.
                Deal with treasonous generals, devious witches and corrupt royalty to provide dark and dangerous services.
                Make choices that go beyond good & evil, and face their far-reaching consequences.

                <h6>CHASE DOWN THE CHILD OF PROPHECY</h6>
                Take on the most important contract to track down the child of prophecy, a key to save or destroy this world.
                In times of war, chase down the child of prophecy, a living weapon of power, foretold by ancient elven legends.
                Struggle against ferocious rulers, spirits of the wilds and even a threat from beyond the veil – all hell-bent on controlling this world.
                Define your destiny in a world that may not be worth saving.

                <h6>FULLY REALIZED NEXT GENERATION</h6>
                Built exclusively for next generation hardware, the REDengine 3 renders the world of The Witcher visually nuanced and organic, a real true to life fantasy.
                Dynamic weather systems and day/night cycles affect how the citizens of the towns and the monsters of the wilds behave.
                Rich with storyline choices in both main and subplots, this grand open world is influenced by the player unlike ever before.
          .</p>
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
                          <li><b>OS:</b> 64-bit Windows 7, 64-bit Windows 8 (8.1) or 64-bit Windows 10</li>
                          <li><b>Processor:<b> Intel CPU Core i5-2500K 3.3GHz / AMD CPU Phenom II X4 940</li>
                          <li><b>Memory:</b> 6 GB RAM</li>
                          <li><b>Graphics:</b> Nvidia GPU GeForce GTX 660 / AMD GPU Radeon HD 7870</li>
                          <li><b>Storage:</b> 35 GB available space</li>
                        </ul>
                  </div>
                </div>

                <div class="w3-col l6 s6">
                  <div class="w3-container">
                      <h6>Recommended</h6>
                      <ul>
                        <li><b>OS:</b> 64-bit Windows 7, 64-bit Windows 8 (8.1) or 64-bit Windows 10</li>
                        <li><b>Processor:<b> Intel CPU Core i7 3770 3.4 GHz / AMD CPU AMD FX-8350 4 GHz</li>
                        <li><b>Memory:</b> 8 GB RAM</li>
                        <li><b>Graphics:</b> Nvidia GPU GeForce GTX 770 / AMD GPU Radeon R9 290</li>
                        <li><b>Storage:</b> 35 GB available space</li>
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

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
              <span class="w3-right w3-opacity">02.04.2018</span>
              <h4>Fuad Aghazada</h4><br>
              <hr class="w3-clear">

              <p>Best game  I have ever played!</p>
            </div>

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
              <span class="w3-right w3-opacity">02.05.2018</span>
              <h4>Enes Varol</h4><br>
              <hr class="w3-clear">

              <p>I finished this game in an only night!</p>
            </div>

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
              <span class="w3-right w3-opacity">01.06.2018</span>
              <h4>Eliz Tekcan</h4><br>
              <hr class="w3-clear">

              <p>I did not like the game </p>
            </div>

            <div class="w3-container w3-card w3-border w3-round w3-margin white-font"><br>
              <span class="w3-right w3-opacity">03.07.2018</span>
              <h4>Alper Kağan Kayalı</h4><br>
              <hr class="w3-clear">

              <p>Enes Varol, how is it possible?! </p>
            </div>

        </div>

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
