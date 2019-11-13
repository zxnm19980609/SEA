<?php
    session_start();
    if($_FILES["file"]["error"] > 0){
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."Invalid File！"."\"".")".";"."</script>";
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/courses/".$_SESSION["cname"]."/home.md");
    }
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."home.php"."\""."</script>";
?>