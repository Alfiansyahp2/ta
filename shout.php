<?php
include "koneksi.php"; // Sertakan file koneksi.php untuk mendapatkan objek $mysqli

if ($_POST) {
    // check if it's an ajax request, exit if not
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }

    if (isset($_POST["message"]) && strlen($_POST["message"]) > 0) {
        //sanitize user name and message received from chat box
        //You can replace username with registered username, if only registered users are allowed.
        $username = $mysqli->real_escape_string(trim($_POST["username"]));
        $message = $mysqli->real_escape_string(trim($_POST["message"]));
        $user_ip = $_SERVER['REMOTE_ADDR'];

        //insert new message in db
        if ($mysqli->query("INSERT INTO shout_box(user, message, ip_address) VALUES ('$username', '$message', '$user_ip')")) {
            $msg_time = date('h:i A M d', time()); // current time
            echo '<div class="shout_msg"><time>' . $msg_time . '</time><span class="username">' . $username . '</span><span class="message">' . $message . '</span></div>';
        }

        // delete all records except the last 10 if you don't want to grow your db size
        $mysqli->query("DELETE FROM shout_box WHERE id NOT IN (SELECT id FROM (SELECT id FROM shout_box ORDER BY id DESC LIMIT 0, 10) as sb)");
    } elseif ($_POST["fetch"] == 1) {
        $results = $mysqli->query("SELECT user, message, date_time FROM (SELECT * FROM shout_box ORDER BY id DESC LIMIT 10) shout_box ORDER BY shout_box.id ASC");
        while ($row = $results->fetch_assoc()) {
            $msg_time = date('h:i A M d', strtotime($row["date_time"])); //message posted time
            echo '<div class="shout_msg"><time>' . $msg_time . '</time><span class="username">' . $row["user"] . '</span> <span class="message">' . $row["message"] . '</span></div>';
        }
    } else {
        header('HTTP/1.1 500 Are you kidding me?');
        exit();
    }
}
?>
