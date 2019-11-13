<?php
    include_once 'config.php';
    $uname = $_POST["uname"];
    $pwd = $_POST["pwd"];
    $role = $_POST["role"];
    // to be security
    if(strlen($uname)<8 || !ctype_alnum($pwd)) {
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."输入有误！"."\"".")".";"."</script>";
    } else {
        $pwd = MD5($pwd);
        $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
        $query = "SELECT * FROM group5_user WHERE uname='{$uname}';";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
            // uname must be unique
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名已被使用！"."\"".")".";"."</script>";
        } else {
            $query = "INSERT INTO group5_user (uname, pwd, role) VALUES ('{$uname}', '{$pwd}', '{$role}');";
            mysqli_query($conn, $query);
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."添加成功！"."\"".")".";"."</script>";
        }
        mysqli_close($conn);
    }
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."add_user.php"."\""."</script>";
?>