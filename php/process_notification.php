<?php

    // ID of the player logged in
    $player_id = $_SESSION['player_id'];

    // Accessing all notification for this player
    $access_notif = "SELECT NT.notification_text, NT.notification_date FROM notify as NR NATURAL JOIN notification as NT
                     WHERE NR.player_id = $player_id";

    // Executing the query
    $access_notif_exe = mysqli_query($db, $access_notif);

    // Number of rows
    $count = mysqli_num_rows($access_notif_exe);
?>

    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $count; ?></span></button>

<?php

    for($i = 0; $i < $count; $i++)
    {
        // Result
        $notifications = $access_notif_exe->fetch_assoc();
?>

    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <a href="#" class="w3-bar-item w3-button"><?php echo $notifications['notification_text']; ?><span class="w3-right w3-small"><?php echo $notifications['notification_date']; ?></span></a>
    </div>

<?php
    }
?>
