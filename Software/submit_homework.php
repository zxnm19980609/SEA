<?php
    session_start();
    include_once 'config.php';
    $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
    $result = mysqli_query($conn, "SELECT * FROM group5_question WHERE hid='{$_GET["hid"]}'");
    while($question = mysqli_fetch_assoc($result)) {
        if($question["type"] == 0) {
            //objective question
            if($_POST["answer".$question["qid"]] == $question["answer"]) //your answer is right
                $score = $question["score"];
            else
                $score = 0;
            $query = "INSERT INTO group5_answer (uid, qid, score, content) VALUES ('{$_SESSION["uid"]}', '{$question["qid"]}', '{$score}', '{$_POST["answer".$question["qid"]]}')";
            mysqli_query($conn, $query);
        } else {
            $query = "INSERT INTO group5_answer (uid, qid, content) VALUES ('{$_SESSION["uid"]}', '{$question["qid"]}', '{$_POST["answer".$question["qid"]]}')";
            mysqli_query($conn, $query);
            if($_FILES["file".$question["qid"]]["error"] == 0) {
                move_uploaded_file($_FILES["file".$question["qid"]]["tmp_name"], "D:/wamp64/www/assets/answer/".$_SESSION["uid"]."-".$question["qid"].".pdf");
            }
        }
    }
    mysqli_close($conn);
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."homework_content.php?hid=".$_GET["hid"]."\""."</script>";
?>