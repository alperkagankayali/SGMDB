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

            <h1>Add Event</h1>
            <p>Please fill in this form to add a new event.</p>
            <hr>
            <div class="signup-w3ls">
              <div class="signup-agile1">
                <form action="process_add_event.php" method="post" enctype="multipart/form-data">
                  <!-- Company Name -->
                  <p>
                    <div class="form-control">
                      <label class="header">Event Type:</label>
                      <div class="nl">

                        <input type="text" id="e_type" name="event_name" placeholder="Event Name" title="Please enter a valid event name" required=""></div>
                      </div>
                    </p>

                    <!-- Email -->
                    <p>
                      <div class="form-control">
                        <label class="header">Start Date :</label>
                        <div class="nl">
                          <input id="start_date" name="start_date" placeholder="YYYY-MM-DD" id="start_date" required="">
                        </div>
                      </div>
                    </p>

                    <!-- Password -->
                    <p>
                      <div class="form-control">
                        <label class="header">End Date :</label>
                        <div class="nl">
                          <input id="end_date" name="end_date" placeholder="YYYY-MM-DD" id="end_date" required="">
                        </div>
                      </div>
                    </p>

                    <!-- Repeat password -->
                    <p>
                      <div class="form-control">
                        <label class="header">Event Photo:</label>
                        <div class="nl">
                          <input id="event_picture" type="file" name="event_picture" placeholder="Photo" capture>
                        </div>
                      </div>
                    </p>

                    
                    <!-- Log in -->

                    <!-- Submit -->
                    <input type="submit" class="add" value="Add Event">
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
