<?php
    session_start();
    include_once 'config.php';
    // add a new comment to database
    $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO group5_comment (did, uid, cotime, ccontent) VALUES ('{$_SESSION["did"]}', '{$_SESSION["uid"]}', '{$date}', '{$_POST["message"]}');";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    //jump to the former page
    header("location:discuss_content.php?did=".$_SESSION["did"]);
?>