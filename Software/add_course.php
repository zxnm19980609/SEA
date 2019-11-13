<?php
    function alert($msg) {
        echo <<<html
<script type="text/javascript">
    alert("$msg");
    window.history.back();
</script>
html;
    }
    include_once 'config.php';
    session_start();
    if (!isset($_SESSION['uname'])) {
        header('location:login.html');
    }
    if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['cname']) ||
        !isset($_POST['cweeks']) || !isset($_POST['ctime']) ||
        !isset($_POST['uid']) || !isset($_POST['clocat']) ||
        !isset($_FILES['cimg']) || !isset($_POST['stus'])) alert('Bad Request!');
    elseif ($_POST['cname'] == '') alert('Need Course Name!');
    elseif ($_POST['cweeks'] == '') alert('Need Course Weeks!');
    elseif ($_POST['clocat'] == '') alert('Need Class Venue');
    elseif (count($_POST['ctime']) == 0) alert('Select At Least One Class Time!');
    elseif (count($_POST['stus']) == 0) alert('Select At Least One Student!');
    elseif ($_FILES['cimg']['error'] > 0) alert('Please Upload a JPEG Image For Course Cover!');
    else {
        mkdir("./assets/courses/".$_POST["cname"]);
        move_uploaded_file($_FILES["cimg"]["tmp_name"], "./assets/courses/".$_POST["cname"]."/image.jpg");
        date_default_timezone_set('PRC');
        $base_time = mktime(0, 0, 0, 9, 1, 2019);
        $weeks = $_POST['cweeks'] - 1;
        $ctime = [];
        $day_ms = 24 * 60 * 60 * 1000;
        $hour_ms = 60 * 60 * 1000;
        foreach ($_POST['ctime'] as $time_str) {
            $start_time = $base_time + number_format($time_str[0]) * $day_ms;
            $end_time = 0;
            switch ($time_str[1]) {
                case '1':
                    $start_time += 8 * $hour_ms;
                    $end_time = $start_time + 4 * $hour_ms;
                    break;
                case '2':
                    $start_time += 13 * $hour_ms;
                    $end_time = $start_time + 4 * $hour_ms;
                    break;
                case '3':
                    $start_time += 18 * $hour_ms;
                    $end_time = $start_time + 3 * $hour_ms;
                    break;
            }
            $ctime []= [$start_time, $end_time];
            for ($i = 0; $i < $weeks; $i += 1) {
                $start_time += 7 * $day_ms;
                $end_time += 7 * $day_ms;
                $ctime []= [$start_time, $end_time];
            }
        }
        $ctime_str = json_encode($ctime);
        $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
        $sql = "INSERT INTO group5_course (cname, ctime, clocat, uid) VALUES ('{$_POST['cname']}', '{$ctime_str}', '{$_POST['clocat']}', {$_POST['uid']})";
        $conn->query($sql);

        $sql = "SELECT cid FROM group5_course WHERE cname='{$_POST['cname']}'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $cid = $row['cid'];
        foreach ($_POST['stus'] as $student) {
            $sql = "INSERT INTO group5_studentcourse(uid, cid) VALUES ($student, $cid)";
            $conn->query($sql);
        }
        alert('Successfully!');
        header('location:courses.php');
    }
    die(0);
?>