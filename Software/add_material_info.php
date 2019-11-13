<?php
    session_start();
    include_once 'config.php';
    $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
    if($_GET["type"] == 1) {
        $query = "SELECT MAX(unlabel) as max FROM group5_unit WHERE mid='{$_GET["mid"]}'";
        $result = mysqli_query($conn, $query);
        $unlabel = mysqli_fetch_assoc($result)["max"] + 1;
        $query = "INSERT INTO group5_unit (mid, unname, unlabel) VALUES ('{$_GET["mid"]}', '{$_POST["name"]}', '{$unlabel}')";
        mysqli_query($conn, $query);
    } else if($_GET["type"] == 2) {
        $query = "INSERT INTO grou5_homework (cid, unid, hname) VALUES ('{$_SESSION["cid"]}', '{$_GET["unid"]}', '{$_POST["name"]}')";
        mysqli_query($conn, $query);
    } else if($_GET["type"] == 3) {
        $query = "INSERT INTO group5_reading (unid, rname) VALUES ('{$_GET["unid"]}', '{$_POST["name"]}')";
        mysqli_query($conn, $query);
    } else if($_GET["type"] == 4) {
        $query = "INSERT INTO group5_discuss (cid, dname, unid) VALUES ('{$_SESSION["cid"]}', '{$_POST["name"]}', '{$_GET["unid"]}')";
        mysqli_query($conn, $query);
    } else {
        $query = "SELECT MAX(mlabel) as max FROM group5_module WHERE cid='{$_SESSION["cid"]}'";
        $result = mysqli_query($conn, $query);
        $mlabel = mysqli_fetch_assoc($result)["max"] + 1;
        $query = "INSERT INTO group5_module (cid, mname, mlabel) VALUES ('{$_SESSION["cid"]}', '{$_POST["name"]}', '{$mlabel}')";
        mysqli_query($conn, $query);
    }
    mysqli_close($conn);
    header('location:modules.php');
?>