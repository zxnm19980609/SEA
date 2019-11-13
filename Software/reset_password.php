<?php
    session_start();
    include_once 'config.php';
    $old_pwd = MD5($_POST['old_password']);
    $new_pwd = MD5($_POST['new_password']);
    $rep_pwd = MD5($_POST['rep_password']);
    //new pwd must be same as rep pwd
    if($new_pwd != $rep_pwd) {
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."密码不同！"."\"".")".";"."</script>";
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."setting.php"."\""."</script>";
    } else {
        $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
        $query = "SELECT * FROM group5_user WHERE uname='{$_SESSION['uname']}' and pwd='{$old_pwd}';";
        $result = mysqli_query($conn, $query);
        
        // the same as login
        if(mysqli_num_rows($result) > 0) {
            $query = "UPDATE user SET pwd='{$new_pwd}' WHERE uid='{$_SESSION["uid"]}';";
            mysqli_query($conn, $query);
            header('location:index.php');
        } else {
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."账号或密码错误！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."setting.php"."\""."</script>";
        }
        mysqli_close($conn);
    }
?>