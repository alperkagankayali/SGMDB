<?php
    include("db.php");
    session_start();

    // Acess notif id
    $notification_id = $_GET['notif'];
    $notification_text = $_GET['notif_text'];

    mysqli_query($db, "UPDATE notification SET notification_status = 1 WHERE notification_id = $notification_id");

    if (strpos($notification_text, 'message') !== false || strpos($notification_text, 'friend') !== false)
    {
        header("location: chat.php");
    }
    else if (strpos($notification_text, 'gift') !== false)
    {
        header("location: library.php");
    }
    exit();

?>
