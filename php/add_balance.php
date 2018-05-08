<!DOCTYPE html>

<html>
<title>Wallet Information</title>

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

  <!-- Content -->

  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

    <!-- The Grid -->
    <div class="w3-row">

      <!-- Middle Column -->
      <div class="w3w3-center">

        <div class="w3-row white-font">

          <div class="container1">

            <h1>Add Balance</h1>
            <p>Please fill in this form to add balance to your wallet</p>
            <hr>
            <div class="signup-w3ls">
              <div class="signup-agile1">
                <form action="process_adding_balance.php" method="post">

                    <!-- Balance -->
                    <p>
                    <div class="form-control">
                      <label class="header">Balance:</label>
                      <div class="nl">

                        <input type="number" id="card_balance" name="balance" placeholder="$" title="Please enter a balance" required=""></div>
                      </div>
                    </p>

                    <!-- Card type -->
                    <p>
                      <div class="form-control">
                        <label class="header">Card:</label>
                        <div class="nl">
                          <select name="payment_method">
                            <option value="-" disabled>--Select a category--</option>
                            <option value="MasterCard" selected>Master Card</option>
                            <option value="Visa">Visa Card</option>
                          </select>
                        </div>
                      </div>
                    </p>

                    <!-- Card number -->
                    <p>
                    <div class="form-control">
                      <label class="header">Card number:</label>
                      <div class="nl">

                        <input type="number" id="card_number" name="card_number" placeholder="1234-1234-1234-1234" title="Please enter card number" required=""></div>
                      </div>
                    </p>

                    <!-- Expiration date -->
                    <p>
                    <div class="form-control">
                      <label class="header">Expiration date:</label>
                      <div class="nl">
                          <input id="exp_date" name="wallet_exp_date" placeholder="YYYY-MM-DD" required="">
                      </div>
                    </p>

                    <!-- Security code -->
                    <p>
                    <div class="form-control">
                      <label class="header">Security code:</label>
                      <div class="nl">

                        <input type="password" id="sec_code" name="security_code" placeholder="3 Number" title="Please enter security code" required=""></div>
                      </div>
                    </p>

                    <!-- Submit -->
                    <input type="submit" class="register" value="Submit">

                    <!-- Back to profile -->
                    <p>
                      <div class = "c3">
                        <a href = "profile.php" > Back to profile </a>
                      </div>
                    </p>

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
