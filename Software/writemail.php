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
                            Write Mail
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
                                        <li class="li-new-mail pull-right active">
                                            <a href="writemail.php" class="btn-new-mail">
														<span class="btn btn-purple no-border">
															<i class="ace-icon fa fa-envelope bigger-130"></i>
															<span class="bigger-110">Write Mail</span>
														</span>
                                            </a>
                                        </li><!-- /.li-new-mail -->

                                        <li>
                                            <a href="inbox.php">
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
                                                        <a href="inbox.php" class="btn-back-message-list">
                                                            <i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
                                                            <b class="bigger-110 middle">Back</b>
                                                        </a>
                                                    </div>
                                                    <div class="messagebar-item-right">
                                                        <span class="inline btn-send-message">
                                                            <button type="button" class="btn btn-sm btn-primary no-border btn-white btn-round" id="btn-send-massage">
                                                                <span class="bigger-110">Send</span>
                                                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="message-list-container">
                                                    <form id="id-message-form"
                                                          class="form-horizontal message-form col-xs-12">
                                                        <div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right"
                                                                       for="form-field-recipient">Recipient:</label>
                                                                <div class="col-sm-9">
                                                                    <span class="input-icon">
                                                                        <input type="email" name="recipient" id="form-field-recipient"
                                                                               placeholder="Recipient">
                                                                        <i class="ace-icon fa fa-user"></i>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="hr hr-18 dotted"></div>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right"
                                                                       for="form-field-subject">Subject:</label>

                                                                <div class="col-sm-6 col-xs-12">
                                                                    <div class="input-icon block col-xs-12 no-padding">
                                                                        <input maxlength="100" type="text"
                                                                               class="col-xs-12" name="subject"
                                                                               id="form-field-subject"
                                                                               placeholder="Subject">
                                                                        <i class="ace-icon fa fa-comment-o"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="hr hr-18 dotted"></div>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right">
                                                                    <span class="inline space-24 hidden-480"></span>
                                                                    Message:
                                                                </label>

                                                                <div class="col-sm-6">
                                                                    <div class="wysiwyg-editor" contenteditable="true"></div>
                                                                </div>
                                                            </div>
                                                            <div class="hr hr-18 dotted"></div>
                                                            <div class="space"></div>
                                                        </div>
                                                    </form>
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
        $('#btn-send-massage').click(function (e) {
            $.post('sendmail.php', {
                'name': $('#form-field-recipient').val(),
                'title': $('#form-field-subject').val(),
                'content': $('.wysiwyg-editor').text(),
            }, function (info) {
                if (info == 0) {
                    alert('Successfully!');
                    window.location.href = 'inbox.php?sent=1';
                } else {
                    alert(info);
                }
            });
        })
    });
</script>
</body>
</html>
