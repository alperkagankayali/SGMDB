<?php
    include("db.php");
    session_start();

    $current_year = date("Y");

    // Accessing the games of the company logged in
    $company_name = $_SESSION['company_name']['company_name'];
    $company_rating = $_SESSION['company_name']['rating'];
    $company_logo = $_SESSION['company_name']['company_logo'];

    /*
        Monthly sales company
    */
    $report_query_1 = "
                      SELECT month, sum(cost)
                      FROM (

                            SELECT MONTH(payment_date) as month, cost
                            FROM payment NATURAL JOIN (buyGame NATURAL JOIN game)
                            WHERE company_name = '$company_name' AND YEAR(payment_date) = $current_year

                            ) as temp

                      GROUP BY month;";

    $report_query_1_exec = mysqli_query($db, $report_query_1);

    $report_array_1 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

    for($a = 0; $a < mysqli_num_rows($report_query_1_exec); $a++)
    {
        $arr_1 = $report_query_1_exec->fetch_assoc();

        $report_array_1[(int)$arr_1['month'] - 1] = round($arr_1['sum(cost)']) + 0;
    }

?>

<!DOCTYPE html>

<html>
<title>Company Profile</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
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
          <a href="published_games.php" class="w3-bar-item w3-button w3-teal nav_links"><i class="fa fa-home w3-margin-right"></i></a>
          <a href="published_games.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">Published Games</a>
          <a href="news_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">News</a>
          <a href="about_company.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white nav_links">About</a>

          <!-- Logout -->
          <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
            <img src="images/icons/logout.png" class="w3-circle" style="height:23px;width:23px" alt="Log out">
          </a>

          <!--Profile avatar-->
         <a href="company_profile.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            <img src=<?php include("picture_load.php");?> class="w3-circle" style="height:23px;width:23px" alt="Avatar">
         </a>
 </div>
</div>


<!-- Content -->
<div class="w3-content white-font" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
    <div class="w3-panel">
    <h1><br>Company Profile</h1>
    </div>

    <img align="Middle" class="w3-image" src=<?php include("picture_load.php");?> alt="Me" width="400" height="300" >

    <div class="w3-panel">
        <h4><br><?php echo $company_name ?></h4>
    </div>


  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">


    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">

      <!-- Chart -->
      <div id="chartContainer1" style="height: 370px; width: 100%; margin: 0px auto; margin-left: 45px"></div>

      <br>
      <br>

      <div id="chartContainer2" style="height: 370px; width: 100%; margin: 0px auto; margin-left: 45px"></div>

    <!-- End Middle Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>





<script>

      var a = <?php echo json_encode($report_array_1); ?>;

      var chart1 = new CanvasJS.Chart("chartContainer1", {

            animationEnabled: true,
            theme: "dark2", // "light1", "light2", "dark1", "dark2"
            title:{
              text: "Monthly Sales"
            },
            axisY: {
              title: "Sales ($)"
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

      chart1.render();

</script>

</body>
</html>
