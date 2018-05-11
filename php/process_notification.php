<?php
    
    if (session_status() == PHP_SESSION_NONE) {
        include("db.php");
        session_start();
    }

    // ID of the player logged in
    $player_id = $_SESSION['player_id'];

    // Accessing all notification for this player which are not read
    $access_notif = "SELECT NT.notification_text, NT.notification_date, NT.notification_id FROM notify as NR NATURAL JOIN notification as NT
                     WHERE NR.player_id = $player_id AND NT.notification_status = 0";

    if($access_notif != NULL){
        $access_notif_exe = mysqli_query($db, $access_notif);
    }
    // Executing the query
    

    // Number of rows
    $count = mysqli_num_rows($access_notif_exe);
?>

    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $count; ?></span></button>
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
<?php

    for($i = 0; $i < $count; $i++)
    {
        // Result
        $notifications = $access_notif_exe->fetch_assoc();
        $notification_id = $notifications['notification_id'];
?>
      <a href="process_read_notification.php?notif=<?php echo $notification_id; ?>&notif_text=<?php echo $notifications['notification_text']; ?>" class="w3-bar-item w3-button"><?php echo $notifications['notification_text']; ?><span class="w3-right w3-small"><?php echo $notifications['notification_date']; ?></span></a>

<?php
    }
?>
    </div>
