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
  $gift_price = 0;
  $game_names = array();
  $gift_names = array();
  $total_row_size = 0;
  for($i = 0; $i < $game_count; $i++)
  {
    
    $game_info = $bundle_info->fetch_assoc();
    $image = $game_info['game_logo'];
    $game_name =$game_info['game_name'];
    $game_price = $game_info['game_price'];
    $gift_price += $game_price;
    
                
    echo "<div class=\"w3-col l3 s6\">";
    echo "<div class=\"w3-container\">"; ?>
    <a href="game_information.php?game_name=<?php echo $game_name; ?>"><img class="w3-margin-top" src=<?php echo $image; ?> style="width:100%"></a>
    <?php
    echo "<p> $game_name <br><b> $game_price USD</b></p>";
    echo "</div>";
    echo "</div>";

    // CHECKING if teh game is in the user's library
    $check_library = "SELECT * FROM library WHERE player_id = $player_id AND game_name = '$game_name';";

    // Executing the query
    $result_check = mysqli_query($db, $check_library);

    // Number of rows
    $row_size = mysqli_num_rows($result_check);
    $total_row_size += $row_size;

    if($row_size == 0){
        $bundle_price += $game_price;
        $count++; //if count=0 can buy all games
        $game_names[$game_name] = $game_price*80/100; //add games not contained in users library to this array
    }
    $gift_names[$game_name] = $game_price*80/100;
  
  }

  $Text = json_encode($game_names);
  $requestText = urlencode($Text);
  $bundle_price_discount = $bundle_price*80/100;

  $Text1 = json_encode($gift_names);
  $requestText1 = urlencode($Text1);


    if($total_row_size != $game_count){
        if($bundle_price != 0)
      echo "<div <p class=\"w3-left w3-block\">Bundle Price = <del>". $bundle_price ." USD</del> ".$bundle_price_discount." USD</p> ";
      else
        echo "<div <p class=\"w3-left w3-block\">Free Bundle</p>";
      $gift_price_discount = $gift_price*80/100;
     echo " <p class=\"w3-left w3-block\">Gift Price = <del>". $gift_price ." USD</del> ". $gift_price_discount." USD</p> ";
         echo "<a href=\"buying_bundle_from_store.php?game_info=$requestText\" class=\"w3-button w3-block w3-theme-l1 \">Buy now<br></a>";
     echo "<a href=\"friend_list_bundle.php?game_info=$requestText1\" class=\"w3-button w3-block w3-border w3-theme-l1 w3-margin-bottom\"><img src=\"images/icons/gift.png\" style=\"width:2%\">Buy as a Gift</a>";
     echo "</div>";
  
    //echo "</div>";
  }
  else{
    $gift_price_discount = $gift_price*80/100;
     echo "<div <p class=\"w3-left w3-block\">Gift Price = <del>". $gift_price ." USD</del> ". $gift_price_discount." USD</p> ";
     echo "<a href=\"friend_list_bundle.php?game_info=$requestText1\" class=\"w3-button w3-block w3-border w3-theme-l1 w3-margin-bottom\"><img src=\"images/icons/gift.png\" style=\"width:2%\">Buy as a Gift</a>";
     echo "</div>";

  }

     echo "</div>";     
    
  }
echo "<!--End of Game grid-->";

?>