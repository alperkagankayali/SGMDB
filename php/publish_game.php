<!DOCTYPE html>

<html>
<title>Publish a game</title>

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
          <a href="library.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Library</a>
          <a href="store.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Store</a>
          <a href="news.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
          <a href="wish_list.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Wishlist</a>
          <a href="cart.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Cart</a>
          <a href="chat.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Chat</a>
          <a href="about.html" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

          <!--Notif button-->
          <button class="w3-button w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"></span></button>

          <!--Search-->
          <input type="text" placeholder="Search.." name="search" class="search-form">
          <button type="submit"><i class="fa fa-search search-form"></i></button>

          <!--Profile avatar-->
          <a href="profile.html" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="images/profil.jpg" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
  </a>

      </div>
  </div>


  <!-- Content -->
  <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

    <div class="w3-panel white-font w3-border">
      <h1 style="margin:20px"><br>Publishing game</h1>
    </div>


  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Middle Column -->
      <div class="w3w3-center">

          <div class="w3-row white-font">

            <h1>Publish a game</h1>
            <p>Please fill in this form to publish your game.</p>
            <hr>
            <div class="signup-w3ls">
              <div class="signup-agile1">
                  <form action="#" method="post">
                      <p>
                        <div class="form-control">
                            <label class="header">Name of the game:</label>
                                              <div class="nl">

                            <input type="text" id="owner_type" name="owner_type" placeholder="Game name..." title="Please enter a valid email" required=""></div>
                        </div>
                      </p>

                      <br>

                      <p>
                        <div class="form-control">
                            <label class="header">Price:</label>
                            <div class="nl">
                            <input type="text" id="store_name" name="price" placeholder="Price..." title="Please enter your First Name" required="number"></div>
                        </div>
                      </p>

                      <br>

                       <p>
                        <div class="form-control">
                            <label class="header">Platform:</label>
                            <br>
                            <label>
                                <input type="checkbox" checked="checked" name="windows" style="margin-bottom:15px"> Windows
                            </label>
                            <label>
                                <input type="checkbox" checked="checked" name="mac" style="margin-bottom:15px"> macOS
                            </label>
                            <label>
                                <input type="checkbox" checked="checked" name="linux" style="margin-bottom:15px"> Linux
                            </label>
                        </div>
                      </p>

                      <br>

                      <p>
                        <div class="form-control">
                            <label class="header">Category:</label>
                            <div class="nl">
                              <select name="example">
                                  <option value="-">--Select a category--</option>
                                  <option value="Action">Action</option>
                                  <option value="Advernture">Adventure</option>
                                  <option value="Casual">Casual</option>
                                  <option value="Indie">Indie</option>
                                  <option value="Multiplayer">Multiplayer</option>
                                  <option value="Racing">Racing</option>
                                  <option value="RPG">RPG</option>
                                  <option value="Simulation">Simulation</option>
                                  <option value="Sports">Sports</option>
                                  <option value="Strategy">Strategy</option>
                              </select>
                        </div>
                      </p>

                      <br>

                      <p>
                        <div class="form-control">
                          <label class="header">System Requirements:</label>
                          <div class="nl">
                          <input id="image" type="file" name="System Requirements" placeholder="Textfile" required="" capture>
                        </div>
                        </div>
                      </p>

                      <br>

                      <p>
                        <div class="form-control">
                          <label class="header">Game Icon:</label>
                          <div class="nl">
                          <input id="image" type="file" name="Game Photo" placeholder="Photo" required="" capture>
                        </div>
                        </div>
                      </p>

                      <br>

                       <p>By publishing this game as a company you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                       <input type="submit" class="publish" value="Publish">
                  </form>

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


    <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">



      <!-- Middle Column -->
      <div class="w3w3-center">

        <div class="w3-row white-font">



                  </div>
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
