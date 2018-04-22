<!DOCTYPE html>

<html>
<title>Sign Up</title>

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
.background {background:url('../images/bg.jpg')}
</style>

<!--*************************************************************************************************-->

<body class="background">

  <!-- Content -->

  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Middle Column -->
      <div class="w3w3-center">

        <div class="w3-row white-font">

          <div class="container1">

            <h1>Sign Up to SGMDB</h1>
            <p>Please fill in this form to create a player account</p>
            <hr>
            <div class="signup-w3ls">
              <div class="signup-agile1">
                <form action="process_player_sign_up.php" method="post">
                    <!-- First Name -->
                    <p>
                    <div class="form-control">
                      <label class="header">First name:</label>
                      <div class="nl">

                        <input type="text" id="p_f_name" name="player_first_name" placeholder="First name" title="Please enter a valid name" required=""></div>
                      </div>
                    </p>

                    <!-- Middle Name -->
                    <p>
                    <div class="form-control">
                      <label class="header">Middle name:</label>
                      <div class="nl">

                        <input type="text" id="p_m_name" name="player_mid_name" placeholder="Middle name (optional)" title="Please enter a valid name" ></div>
                      </div>
                    </p>

                    <!-- Last Name -->
                    <p>
                    <div class="form-control">
                      <label class="header">Last name:</label>
                      <div class="nl">

                        <input type="text" id="p_l_name" name="player_last_name" placeholder="Last name" title="Please enter a valid name" required=""></div>
                      </div>
                    </p>

                    <!-- Username -->
                    <p>
                      <div class="form-control">
                        <label class="header">Username:</label>
                        <div class="nl">
                          <input type="text" id="p_username" name="player_username" placeholder="User Name" title="Please enter your username" required="">
                        </div>
                      </div>
                    </p>

                    <!-- Email -->
                    <p>
                      <div class="form-control">
                        <label class="header">Email:</label>
                        <div class="nl">
                          <input type="text" id="p_email" name="player_email" placeholder="Email" title="Please enter your email" required="">
                        </div>
                      </div>
                    </p>

                    <!-- Password -->
                    <p>
                      <div class="form-control">
                        <label class="header">Password:</label>
                        <div class="nl">
                          <input type="password" id="p_password" name="player_password" placeholder="Password" title="Please enter your password" required="">
                        </div>
                      </div>
                    </p>

                    <!-- Birthdate -->
                    <p>
                      <div class="form-control">
                        <label class="header">Birth Date :</label>
                        <div class="nl">

                          <input id="p_b_date" name="player_b_date" placeholder="YYYY-MM-DD" id="p_b_date" required="">
                        </div>
                      </div>
                    </p>

                    <!-- Repeat password -->
                    <p>
                      <div class = "c3">
                        <label for="psw-repeat"><b>Repeat Password</b></label>
                      </div>
                      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                    </p>

                    <!-- Profile Picture -->
                    <p>
                      <div class="form-control">
                        <label class="header">Profile Photo:</label>
                        <div class="nl">
                          <input id="p_p_picture" type="file" name="player_picture" placeholder="Photo" capture>
                        </div>
                      </div>
                    </p>

                    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                    <!-- Log in -->
                    <p>
                      <div class = "c3">
                        <a href = "../login/login-player.php" > Player login </a>
                      </div>
                    </p>

                    <!-- Submit -->
                    <input type="submit" class="register" value="Register">
                </form>

              </div>
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
