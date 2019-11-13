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
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['hid'])) alert('Bad Request!');
else {
    if (isset($_POST['ischoice'])) {
        if (!isset($_POST['optionA']) || !isset($_POST['optionB']) || !isset($_POST['optionC']) || !isset($_POST['optionD']) ||
            !isset($_POST['title']) || !isset($_POST['score']) || !isset($_POST['choice_answer'])) alert('Bad Request!');
        elseif ($_POST['title'] == '') alert('Need Question Content!');
        elseif ($_POST['optionA'] == '') alert('Need Option A!');
        elseif ($_POST['optionB'] == '') alert('Need Option B!');
        elseif ($_POST['optionC'] == '') alert('Need Option C!');
        elseif ($_POST['optionD'] == '') alert('Need Option D!');
        else {
            $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
            $json = <<<json
{
    "A": "{$_POST['optionA']}",
    "B": "{$_POST['optionB']}",
    "C": "{$_POST['optionC']}",
    "D": "{$_POST['optionD']}"
}
json;
            $sql = "INSERT INTO group5_question (hid, type, score, title, selector, answer) VALUES ({$_POST['hid']}, 0, {$_POST['score']}, '{$_POST['title']}', '$json', '{$_POST['choice_answer']}')";
            $conn->query($sql);
            alert('Successfully!');
//            header("location:addquestion.php?hid={$_POST['hid']}");
        }
    }
    else {
        if (!isset($_POST['title']) || !isset($_POST['score']) || !isset($_POST['filling_answer']))
            alert('Bad Request!');
        elseif ($_POST['title'] == '') alert('Need Question Content!');
        elseif ($_POST['filling_answer'] == '') alert('Need Standard Answer!');
        else {
            $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
            $sql = "INSERT INTO group5_question (hid, type, score, title, answer) VALUES ({$_POST['hid']}, 1, {$_POST['score']}, '{$_POST['title']}', '{$_POST['filling_answer']}')";
            $conn->query($sql);
            alert('Successfully!');
//            header("location:addquestion.php?hid={$_POST['hid']}");
        }
    }
}
die(0);
?>