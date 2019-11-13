<?php
    session_start();
    include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Courses - Canvas</title>

		<meta name="description" content="Draggabble Widget Boxes with Persistent Position and State" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
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
				try{ace.settings.loadState('main-container')}catch(e){}
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
                                <div class="col-xs-8">
                                    <!-- PAGE CONTENT BEGINS -->
                                    <div class="visible" id="main-widget-container">
                                        <div class="row">
                                            <!--
                                                    admin: view all courses
                                                    teacher: view courses he/she teaches
                                                    student: view courses he/she studyes    
                                                -->
                                            <?php
                                                $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
                                                if($_SESSION["role"] == 0)
                                                    $query = "SELECT * FROM group5_course";
                                                else if($_SESSION["role"] == 1)
                                                    $query = "SELECT * FROM group5_course WHERE uid = '{$_SESSION["uid"]}'";
                                                else
                                                    $query = "SELECT * FROM group5_course WHERE cid in (SELECT cid FROM group5_studentcourse WHERE uid='{$_SESSION["uid"]}')";
                                                $result = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo '<div class="col-sm-6">
                                                            <div class="widget-box">
                                                                <div class="course-logo">
                                                                    <img src="assets/courses/'.$row["cname"].'/image.jpg" width="125" height="200">
                                                                </div>

                                                                <div style="margin=0 auto">
                                                                    <a href="home.php?cid='.$row["cid"].'"> <h2>'.$row["cname"].'</h2> </a>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                                mysqli_close($conn);
                                            ?>
                                        </div>
                                        
                                        <!-- only admin can add a new course -->
                                        <div class="row" style = '<?php if($_SESSION["role"]!=0) echo "display: none"; else echo "";?>'>
                                            <a href="addcourse.php">
                                                <input type="button" class="width-35 btn btn-sm btn-primary" style="display:block;margin:0 auto"/ value='Add A New Course'>
                                            </a>
                                        </div>
                                    </div><!-- PAGE CONTENT ENDS -->
                                </div><!-- /.col -->
                            
                                <div class="col-xs-4">
                                    <?php include_once 'todolist.php'; ?>
                                </div>
						</div><!-- /.row -->
					</div><!-- /.page-content -->
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
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
	</body>
</html>
