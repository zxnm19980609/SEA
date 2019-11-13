<?php
include_once 'config.php';
session_start();
if (!isset($_SESSION['uname'])) {
    header('location:login.html');
}
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['hid']) || !isset($_POST['aid']) || !isset($_POST['score']))
    die('Bad Request!');
$conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
$sql = "UPDATE group5_answer SET score={$_POST['score']} WHERE aid={$_POST['aid']}";
$conn->query($sql);
header("location:judge.php?hid={$_POST['hid']}");
?>