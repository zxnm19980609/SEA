<?php
    include_once 'config.php';
    $uname = $_POST['username'];
    $pwd = MD5($_POST['password']);
    
    $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
    $query = "SELECT * FROM group5_user WHERE uname='{$uname}' and pwd='{$pwd}';";
    $result = mysqli_query($conn, $query);
    
    // if we can find a record from database, then login successfully.
    if(mysqli_num_rows($result) > 0) {
        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['uid'] = $user["uid"];
        $_SESSION['uname'] = $user["uname"];
        $_SESSION['role'] = $user["role"];
        header('location:index.php');
    } else {
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."账号或密码错误！"."\"".")".";"."</script>";
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."login.html"."\""."</script>";
    }
    mysqli_close($conn);
?>