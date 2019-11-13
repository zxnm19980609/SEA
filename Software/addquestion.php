<?php
    include_once 'config.php';
    session_start();
    if (!isset($_SESSION['uname'])) {
        header('location:login.html');
    }
    if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['hid']))
        die('Bad Request!');
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
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="add_question.php" method="post">
                        <input hidden name="hid" value="<?php echo $_GET['hid']; ?>" readonly />
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-is-choice">Choice Question:</label>
                            <div class="col-sm-4">
                                <label class="form-control">
                                    <input name="ischoice" type="checkbox" class="ace ace-switch"
                                    id="form-is-choice"/>
                                    <span class="lbl" data-lbl="Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-question-content">Question Content:</label>
                            <div class="col-sm-4">
                                <textarea name="title" class="form-control" style="min-height: 100px;" id="form-question-content"></textarea>
                            </div>
                        </div>
                        <fieldset class="choice-question" style="display: none;">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-option-a">Option A:</label>
                                <div class="col-sm-4">
                                    <textarea name="optionA" class="form-control" style="min-height: 100px;" id="form-option-a"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-option-b">Option B:</label>
                                <div class="col-sm-4">
                                    <textarea name="optionB" class="form-control" style="min-height: 100px;" id="form-option-b"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-option-c">Option C:</label>
                                <div class="col-sm-4">
                                    <textarea name="optionC" class="form-control" style="min-height: 100px;" id="form-option-c"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-option-d">Option D:</label>
                                <div class="col-sm-4">
                                    <textarea name="optionD" class="form-control" style="min-height: 100px;" id="form-option-d"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-question-pts">Question pts:</label>
                            <div class="col-sm-4">
                                <input name="score" type="text" class="form-control" id="form-question-pts"/>
                            </div>
                        </div>
                        <fieldset class="choice-question" style="display: none;">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-choice-std">Standard Answer:</label>
                                <div class="col-sm-4">
                                    <select name="choice_answer" class="col-sm-4 chosen-select">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="filling-question">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-filling-std">Standard Answer:</label>
                                <div class="col-sm-4">
                                    <textarea name="filling_answer" class="form-control" style="min-height: 100px;" id="form-filling-std"></textarea>
                                </div>
                            </div>
                        </fieldset>
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
        function render_show_content() {
            if ($('#form-is-choice').prop('checked')) {
                $('.choice-question').show();
                $('.filling-question').hide();
            }
            else {
                $('.choice-question').hide();
                $('.filling-question').show();
            }
        }
        render_show_content();
        $('#form-is-choice').on('change', render_show_content);
        $('#form-question-pts').ace_spinner({
            min: 1,
            max: 20,
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
</html>

