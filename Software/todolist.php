<?php
    include_once 'config.php';
    $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);

    if ($_SESSION['role'] == 2) {
        $sql = <<<sql
SELECT cname, ctime, clocat FROM group5_course WHERE cid IN (
    SELECT cid FROM group5_studentcourse WHERE uid={$_SESSION['uid']}
)
sql;
    }
    elseif ($_SESSION['role'] == 1) {
        $sql = "SELECT cname, ctime, clocat FROM group5_course WHERE uid={$_SESSION['uid']}";
    }
    else {
        $sql = "SELECT cname, ctime, clocat FROM group5_course";
    }
    $result = $conn->query($sql);

    echo '<ul class="list-group">';
    echo '    <li class="list-group-item list-group-item-success">TODO List</li>';

    if ($result->num_rows > 0) {
        $todolist = [];
        while ($row=$result->fetch_assoc()) {
            $time_list = json_decode($row['ctime']);
            foreach ($time_list as $time) {
                $todolist []= ['text' => $row['cname'].' - '.$row['clocat'], 'start_time' => $time[0], 'end_time' => $time[1]];
            }
        }
        $key_list = array_column($todolist, 'start_time');
        array_multisort($key_list, $todolist);

        date_default_timezone_set('PRC');
        $count = 0;
        foreach ($todolist as $li) {
            if ($count > 15) break;
            if ($li['start_time'] /1000 > time()) {
                $count += 1;
                $str_time = date('Y-m-d h:i:s', $li['start_time'] / 1000);
                echo <<<html
    <li class="list-group-item list-group-item-primary">{$li['text']}&nbsp;&nbsp;&nbsp;&nbsp;{$str_time}</li>
html;
            }
        }
    }

    echo '</ul>';
?>