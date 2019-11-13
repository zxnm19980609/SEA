<?php
    session_start();
    if($_FILES["file"]["error"] > 0){
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."Invalid File！"."\"".")".";"."</script>";
    } else {
        // save the uploaded file
        move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/reading/".$_GET["rid"].".md");
    }
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."reading_content.php?rid=".$_GET["rid"]."\""."</script>";
?>