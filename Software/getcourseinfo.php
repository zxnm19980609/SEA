<?php
include_once 'config.php';
session_start();
if (!isset($_SESSION['uname'])) {
    header('location:login.html');
}
$conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);

if ($_SESSION['role'] == 2) {
    $sql = <<<sql
SELECT cid, cname, ctime, clocat FROM group5_course WHERE cid IN (
    SELECT cid FROM group5_studentcourse WHERE uid={$_SESSION['uid']}
)
sql;
}
elseif ($_SESSION['role'] == 1) {
    $sql = "SELECT cid, cname, ctime, clocat FROM group5_course WHERE uid={$_SESSION['uid']}";
}
else {
    $sql = "SELECT cid, cname, ctime, clocat FROM group5_course";
}
$result = $conn->query($sql);
$course_list = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $course_list[] = ['cid' => $row['cid'], 'cname' => $row['cname'], 'ctime' => $row['ctime'], 'clocat' => $row['clocat']];
    }
}
$conn->close();
die(json_encode($course_list));
?>