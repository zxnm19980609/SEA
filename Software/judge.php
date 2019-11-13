<?php
include_once 'config.php';
session_start();
if (!isset($_SESSION['uname'])) {
    header('location:login.html');
}
if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['hid'])) {
    die('Bad Request!');
}
$conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM group5_answer WHERE score IS NULL AND qid IN (SELECT qid FROM question WHERE hid={$_GET['hid']}) LIMIT 1";
$answer_result = $conn->query($sql);
$count_result = $conn->query("SELECT FOUND_ROWS()");
$count_row = $count_result->fetch_row();
$pending_count = $count_row[0];

$answer_id = 0;
$student_name = '';
$question_content = '';
$question_pts = '';
$student_answer = '';
$standard_answer = '';
$file_flag = false;
$file_path = '';
if ($pending_count > 0) {
    $answer_row = $answer_result->fetch_assoc();
    $answer_id = $answer_row['aid'];
    $student_answer = $answer_row['content'];

    $student_result = $conn->query("SELECT uname FROM group5_user WHERE uid={$answer_row['uid']}");
    $student_row = $student_result->fetch_assoc();
    $student_name = $student_row['uname'];

    $question_result = $conn->query("SELECT score, title, answer FROM group5_question WHERE qid={$answer_row['qid']}");
    $question_row = $question_result->fetch_assoc();
    $question_content = $question_row['title'];
    $question_pts = $question_row['score'];
    $standard_answer = $question_row['answer'];

    $file_path = "assets/answer/{$answer_row['uid']}-{$answer_row['qid']}.pdf";
    $file_flag = file_exists($file_path);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Courses - Canvas</title>

    <meta name="description" content="with draggable and editable events"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css"/>
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<?php
    include_once 'header.php';
?>
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {
        }
    </script>

    <?php
        include_once 'sidebar.php';
    ?>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active"><a href="courses.php">Courses</a></li>
                    <li class="active"><?php echo $_SESSION["cname"] ?></li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <!-- PAGE CONTENT BEGINS -->

                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title"><?php echo $pending_count; ?> question(s) to be corrected.</h4>
                            </div>
                            <div class="panel-body" <?php if ($pending_count == 0) echo 'hidden'; ?>>
                                <form enctype="multipart/form-data" class="form-horizontal" role="form" action="judged.php" method="post">
                                    <input hidden name="aid" value="<?php echo $answer_id; ?>" readonly />
                                    <input hidden name="hid" value="<?php echo $_GET['hid']; ?>" readonly />
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-student-name">Student Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" value="<?php echo $student_name; ?>" readonly
                                                   id="form-student-name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-question-content">Question Content:</label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" readonly style="min-height: 100px;"
                                                   id="form-question-content"><?php echo $question_content; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-standard-answer">Standard Answer:</label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" readonly style="min-height: 100px;"
                                                      id="form-standard-answer"><?php echo $standard_answer; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-student-answer">Student Answer:</label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" readonly style="min-height: 100px;"
                                                      id="form-student-answer"><?php echo $student_answer; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" <?php if (!$file_flag) echo 'hidden'; ?>>
                                        <label class="col-sm-4 control-label no-padding-right" for="form-student-answer">Student PDF Answer:</label>
                                        <div class="col-sm-4">
                                            <a class="form-control" href="<?php echo $file_path; ?>" download="answer.pdf">Click to Download</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-question-pts">Question pts:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" value="<?php echo $question_pts; ?>" readonly
                                                   id="form-question-pts"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-student-score">Student Score:</label>
                                        <div class="col-sm-4">
                                            <input name="score" type="text" class="form-control" id="form-student-score"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-4">
                                            <button type="submit" class="col-sm-4 btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.page-content -->
        </div>
    </div>
</div>
<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery.nestable.min.js"></script>
<script src="assets/js/spinbox.min.js"></script>


<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        $('#form-student-score').ace_spinner({
            min: 0,
            max: <?php echo $question_pts; ?>,
            step: 1,
            icon_up: 'fa fa-plus',
            icon_down: 'fa fa-minus',
            btn_up_class: 'btn btn-success',
            btn_down_class: 'btn btn-danger',
            on_sides: true,
        });
    });
</script>
</body>