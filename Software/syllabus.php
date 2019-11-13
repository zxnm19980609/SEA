<?php
session_start();
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
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div id="showdown" style="display: none;"><?php
                            $filepath = './assets/courses/' . $_SESSION["cname"] . '/syllabus.md';
                            if (file_exists($filepath))
                                include_once $filepath; ?></div>
                    </div>
                </div>

                <hr/>

                <div class="row">
                    <div class="col-xs-2 col-xs-offset-5" style='<?php echo $_SESSION["style"]; ?>'>
                        <form action="upload_syl.php" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="file" name="file" id="file"/>
                                        </span>
                                </label>

                                <div class="space"></div>

                                <label class="block clearfix">
                                    <button type="submit" class="btn btn-sm btn-primary"
                                            style="display:block;margin:0 auto">
                                        <span class="bigger-110">upload</span>
                                    </button>
                                </label>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
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
<script src="assets/js/showdown.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        var markdown = $('#showdown').html();
        console.log(markdown);
        var converter = new showdown.Converter();
        var html = converter.makeHtml(markdown);
        console.log(html);
        $('#showdown').html(html);
        $('#showdown').show();
        $('#file').ace_file_input({
            allowExt: ['md'],
            allowMime: ['text/markdown'],
        }).on('file.error.ace', function (event, info) {
            if (info.invalid_count > 0) {
                alert('Invalid File Type!');
            }
        });
    });
</script>
</body>