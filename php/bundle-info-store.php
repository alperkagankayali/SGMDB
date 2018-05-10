<?php


echo "<div class=\"w3-panel white-font\">
                <h4><br> All Bundles
                </h4>
                <hr>
              </div>";

$sql_bundle_count = "SELECT DISTINCT bundle_id FROM gameBundle NATURAL JOIN game;";
$bundle_ids = mysqli_query($db, $sql_bundle_count);
$bundle_count = mysqli_num_rows($bundle_ids);

for($j = 0; $j < $bundle_count; $j++){
  $bundle_id = $bundle_ids->fetch_assoc();
  $sql_bundle_info = "SELECT DISTINCT * FROM gameBundle NATURAL JOIN game WHERE bundle_id = ".$bundle_id['bundle_id'].";";

  $bundle_info = mysqli_query($db, $sql_bundle_info);
  $game_count = mysqli_num_rows($bundle_info);
  echo "<div class=\"w3-container w3-card w3-border w3-round w3-margin white-font\"><br>
                <span class=\"w3-right w3-opacity\"></span>";
  $bundle_price = 0;
  for($i = 0; $i < $game_count; $i++)
  {
    $game_info = $bundle_info->fetch_assoc();
    $image = $game_info['game_logo'];
    $game_name =$game_info['game_name'];
    $game_price = $game_info['game_price'];
    $bundle_price += $game_price;
                
    echo "<div class=\"w3-col l3 s6\">";
    echo "<div class=\"w3-container\">";
    echo "<img src=\""; 
    echo $image; 
    echo "\""; 
    echo "style=\"width:100%\">";
    echo "<p> $game_name <br><b> $game_price USD</b></p>";
    echo "</div>";
    echo "</div>";
    
    }
    $bundle_price_discount = $bundle_price*80/100;
    if($bundle_price != 0)
      echo "<div <p class=\"w3-left w3-block\">Bundle Price = <del>". $bundle_price ." USD</del> ".$bundle_price_discount." USD</p> </div>";
    else
      echo "<div <p class=\"w3-left w3-block\">Free Bundle</p> </div>";

    echo "</div>";
  }
echo "<!--End of Game grid-->";

?>