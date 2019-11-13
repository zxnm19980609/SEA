<?php
    session_start();
    include_once 'config.php';
    if (!isset($_SESSION['uname'])) {
        header('location:login.html');
    }
    if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['name']) || !isset($_POST['title']) || !isset($_POST['content'])) {
        die('Bad Request!');
    }
    $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
    $to_result = $conn->query("SELECT uid FROM group5_user WHERE uname='{$_POST['name']}'");
    if ($to_result->num_rows > 0) {
        $to_row = $to_result->fetch_assoc();
        $tuid = $to_row['uid'];
        date_default_timezone_set('PRC');
        $current_time = date('Y-m-d H:i:s');
        $sql = "INSERT INTO group5_mail (suid, tuid, maname, content, matime) VALUES ({$_SESSION['uid']}, $tuid, '{$_POST['title']}', '{$_POST['content']}', '$current_time')";
        $conn->query($sql);
        $conn->close();
        die(0);
    }
    else {
        $conn->close();
        die('Wrong Recipient!');
    }
?>