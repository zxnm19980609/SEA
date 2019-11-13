<?php
include_once 'config.php';
session_start();
if (!isset($_SESSION['uname'])) {
    header('location:login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Calendar - Canvas</title>

    <meta name="description" content="with draggable and editable events"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css"/>
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css"/>
    <link rel="stylesheet" href="assets/css/bootstrap-multiselect.min.css"/>
    <link rel="stylesheet" href="assets/css/chosen.min.css">

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
                    <li class="active">Courses</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="row">
                    <!-- PAGE CONTENT BEGINS -->
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="add_course.php" method="post">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-name">Course Name:</label>
                            <div class="col-sm-4">
                                <input name="cname" type="text" class="form-control" placeholder="Course Name"
                                       id="form-course-name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-image">Course Image:</label>
                            <div class="col-sm-4">
                                <input name="cimg" type="file" class="form-control" id="form-course-image"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-weeks">Course Weeks:</label>
                            <div class="col-sm-4">
                                <input name="cweeks" type="text" class="form-control" id="form-course-weeks"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-time">Course Time:</label>
                            <div class="col-sm-4">
                                <select name="ctime[]" class="form-control" id="form-course-time"
                                        multiple="multiple">
                                    <option value="11">Mon Morning</option>
                                    <option value="12">Mon Afternoon</option>
                                    <option value="13">Mon Evening</option>
                                    <option value="21">Tue Morning</option>
                                    <option value="22">Tue Afternoon</option>
                                    <option value="23">Tue Evening</option>
                                    <option value="31">Wed Morning</option>
                                    <option value="32">Wed Afternoon</option>
                                    <option value="33">Wed Evening</option>
                                    <option value="41">Thu Morning</option>
                                    <option value="42">Thu Afternoon</option>
                                    <option value="43">Thu Evening</option>
                                    <option value="51">Fri Morning</option>
                                    <option value="52">Fri Afternoon</option>
                                    <option value="53">Fri Evening</option>
                                    <option value="61">Sat Morning</option>
                                    <option value="62">Sat Afternoon</option>
                                    <option value="63">Sat Evening</option>
                                    <option value="71">Sun Morning</option>
                                    <option value="72">Sun Afternoon</option>
                                    <option value="73">Sun Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-students">Students:</label>
                            <div class="col-sm-4">
                                <select name="stus[]" class="form-control" id="form-course-students"
                                        multiple="multiple">
                                    <?php
                                    $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
                                    $result = $conn->query("SELECT uid, uname FROM group5_user WHERE role=2");
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo <<<html
                                    <option value="{$row['uid']}">{$row['uname']}</option>
html;
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-teacher">Teacher:</label>
                            <div class="col-sm-4">
                                <select name="uid" class="col-sm-4 chosen-select">
                                    <?php
                                        $conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
                                        $result = $conn->query("SELECT uid, uname FROM group5_user WHERE role=1");
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo <<<html
                                    <option value="{$row['uid']}">{$row['uname']}</option>
html;
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-course-time">Class Venue:</label>
                            <div class="col-sm-4">
                                <input name="clocat" type="text" class="form-control" placeholder="Class Venue" id="form-course-loaction"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button type="submit" class="col-sm-4 btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

                <span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

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
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/fullcalendar.min.js"></script>
<script src="assets/js/bootbox.js"></script>
<script src="assets/js/bootstrap-multiselect.min.js"></script>
<script src="assets/js/spinbox.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        $('#form-course-image').ace_file_input({
            no_file: 'Please upload the course cover...',
            allowExt: ['jpg'],
            allowMime: ['image/jpg', 'image/jpeg'],
        }).on('file.error.ace', function (event, info) {
            if (info.invalid_count > 0) {
                alert('Invalid File Type!');
            }
        });
        $('#form-course-weeks').ace_spinner({
            min: 1,
            max: 16,
            step: 1,
            icon_up: 'fa fa-plus',
            icon_down: 'fa fa-minus',
            btn_up_class: 'btn btn-success',
            btn_down_class: 'btn btn-danger',
            on_sides: true,
        });
        $('#form-course-time').multiselect({
            maxHeight: 200,
            buttonClass: 'btn btn-info'
        });
        $('#form-course-students').multiselect({
            maxHeight: 200,
            buttonClass: 'btn btn-info'
        });
    });
</script>
</body>
</html>

