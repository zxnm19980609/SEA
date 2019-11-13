<?php
include_once 'config.php';
session_start();
if (!isset($_SESSION['uname'])) {
    header('location:login.html');
}
if (!isset($_GET['maid'])) {
    header('location:inbox.php');
}
$row = null;
$conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
$sql = "SELECT * FROM group5_mail WHERE maid={$_GET['maid']}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
$suname = '';
$tuname = '';
$s_result = $conn->query("SELECT uname FROM group5_user WHERE uid={$row['suid']}");
if ($s_result->num_rows > 0) {
    $s_row = $s_result->fetch_assoc();
    $suname = $s_row['uname'];
}
$t_result = $conn->query("SELECT uname FROM group5_user WHERE uid={$row['tuid']}");
if ($t_result->num_rows > 0) {
    $t_row = $t_result->fetch_assoc();
    $tuname = $t_row['uname'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Inbox - Canvas</title>

    <meta name="description" content="Mailbox with some customizations as described in docs"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->

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
                    <li class="active">Inbox</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        Inbox
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php echo $row['suid'] == $_SESSION['uid'] ? 'Sent' : 'Received'; ?> Mail Content
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="tabbable">
                                    <ul id="inbox-tabs"
                                        class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
                                        <li class="li-new-mail pull-right">
                                            <a href="writemail.php" class="btn-new-mail">
														<span class="btn btn-purple no-border">
															<i class="ace-icon fa fa-envelope bigger-130"></i>
															<span class="bigger-110">Write Mail</span>
														</span>
                                            </a>
                                        </li><!-- /.li-new-mail -->

                                        <li>
                                            <a  href="inbox.php">
                                                <i class="blue ace-icon fa fa-inbox bigger-130"></i>
                                                <span class="bigger-110">Inbox</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="inbox.php?sent=1">
                                                <i class="orange ace-icon fa fa-location-arrow bigger-130"></i>
                                                <span class="bigger-110">Sent</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content no-border no-padding">
                                        <div id="inbox" class="tab-pane in active">
                                            <div class="message-container">
                                                <div id="id-message-item-navbar" class="message-navbar clearfix">
                                                    <div class="message-bar">
                                                        <div class="messagebar-item-right">
<!--                                                            <button type="button"-->
<!--                                                                    class="btn btn-xs btn-white btn-primary">-->
<!--                                                                <i class="ace-icon fa fa-trash-o bigger-125 orange"></i>-->
<!--                                                                <span class="bigger-110">Delete</span>-->
<!--                                                            </button>-->
                                                        </div>
                                                    </div>

                                                    <div class="messagebar-item-left">
                                                        <a href="#" class="btn-back-message-list">
                                                            <i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
                                                            <b class="bigger-110 middle">Back</b>
                                                        </a>
                                                    </div>

                                                    <div class="messagebar-item-right">
                                                        <i class="ace-icon fa fa-clock-o bigger-110 orange"></i>
                                                        <span class="grey"><?php echo $row['matime']; ?></span>
                                                    </div>
                                                </div>


                                                <div class="message-list-container">
                                                    <div class="message-content" id="id-message-content">
                                                        <div class="message-header clearfix">
                                                            <div class="pull-left">
                                                                <span class="blue bigger-125"><?php echo $row['maname']; ?></span>

                                                                <div class="space-4"></div>
                                                                &nbsp;
                                                                <img class="middle"
                                                                     src="assets/images/avatar.png" width="32">
                                                                &nbsp;
                                                                <a class="sender"><?php echo $row['suid'] == $_SESSION['uid'] ? $tuname : $suname; ?></a>
                                                                &nbsp;
                                                                <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                                                                <span class="time grey"><?php echo $row['matime']; ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="hr hr-double"></div>

                                                        <div class="message-body" style="position: relative;">
                                                            <div class="scroll-content" style="max-height: 150px;">
                                                                <p>
                                                                    <?php echo $row['content']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.tab-content -->
                                </div><!-- /.tabbable -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- /.message-content -->

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

                &nbsp; &nbsp;
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
<script src="assets/js/bootstrap-tag.min.js"></script>
<script src="assets/js/jquery.hotkeys.index.min.js"></script>
<script src="assets/js/bootstrap-wysiwyg.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        //back to message list
        $('.btn-back-message-list').on('click', function (e) {
            e.preventDefault();
            window.history.back();
        });
    });
</script>
</body>
</html>
