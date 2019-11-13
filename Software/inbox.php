<?php
    include_once 'config.php';
session_start();
if (!isset($_SESSION['uname'])) {
    header('location:login.html');
}
$show_inbox = true;
if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['sent']) and $_GET['sent'] == 1) {
    $show_inbox = false;
}
$conn = new mysqli($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);

if ($show_inbox) {
    $sql = "SELECT maid, suid, maname, matime FROM group5_mail WHERE tuid={$_SESSION['uid']}";
} else {
    $sql = "SELECT maid, tuid, maname, matime FROM group5_mail WHERE suid={$_SESSION['uid']}";
}
$result = $conn->query($sql);
$mail_list = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $temp_result = $conn->query("SELECT uname FROM group5_user WHERE uid={$row[1]}");
        $temp_row = $temp_result->fetch_assoc();
        $mail_list []= ['maid' => $row[0], 'name' => $temp_row['uname'], 'title' => $row[2], 'time' => $row[3]];
    }
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
                            <?php echo $show_inbox ? 'Inbox' : 'Sent'; ?>
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

                                        <li class="<?php echo $show_inbox ? 'active' : ''; ?>">
                                            <a href="inbox.php">
                                                <i class="blue ace-icon fa fa-inbox bigger-130"></i>
                                                <span class="bigger-110">Inbox</span>
                                            </a>
                                        </li>

                                        <li class="<?php echo $show_inbox ? '' : 'active'; ?>">
                                            <a href="inbox.php?sent=1">
                                                <i class="orange ace-icon fa fa-location-arrow bigger-130"></i>
                                                <span class="bigger-110">Sent</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content no-border no-padding">
                                        <div id="inbox" class="tab-pane in active">
                                            <div class="message-container">
                                                <div id="id-message-list-navbar" class="message-navbar clearfix">
                                                    <div class="message-bar">
                                                        <div class="message-infobar" id="id-message-infobar">
                                                            <span class="blue bigger-150">Inbox</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="message-list-container">
                                                    <div class="message-list" id="message-list">
                                                        <?php
                                                            foreach ($mail_list as $mail) {
                                                                echo <<<mail_template
                                                        <div class="message-item message-unread">
                                                            <span class="sender" title="{$mail['name']}">{$mail['name']}</span>
                                                            <span class="time" style="min-width:150px;">{$mail['time']}</span>
                                                            <span class="summary" onclick="window.location.href='mail_content.php?maid={$mail['maid']}'">
                                                                <span class="text">
                                                                    {$mail['title']}
                                                                </span>
                                                            </span>
                                                        </div>
mail_template;
                                                            }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="message-footer clearfix">
                                                    <div class="pull-left"><?php echo $result->num_rows; ?> messages total</div>

                                                    <div class="pull-right">
                                                        <div class="inline middle"> page 1 of 1</div>
                                                        &nbsp; &nbsp;
                                                        <ul class="pagination middle">
                                                            <li class="disabled">
																		<span>
																			<i class="ace-icon fa fa-step-backward middle"></i>
																		</span>
                                                            </li>

                                                            <li class="disabled">
																		<span>
																			<i class="ace-icon fa fa-caret-left bigger-140 middle"></i>
																		</span>
                                                            </li>

                                                            <li class="disabled">
																		<span>
																			<input value="1" maxlength="3" type="text">
																		</span>
                                                            </li>

                                                            <li class="disabled">
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-caret-right bigger-140 middle"></i>
                                                                </a>
                                                            </li>

                                                            <li class="disabled">
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-step-forward middle"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.tab-content -->
                                </div><!-- /.tabbable -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>

        </div>
    </div><!-- /.main-content -->

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

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
</body>
</html>
