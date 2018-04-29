<?php
      include("db.php");
      session_start();

      $result = $_SESSION['buygame'];

      displayResult($result);

      function displayResult($result)
      {
          echo $result;
      }

?>
