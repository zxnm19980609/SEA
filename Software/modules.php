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

		<meta name="description" content="with draggable and editable events" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="assets/css/fullcalendar.min.css" />

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
                            <li class="active"> <a href="courses.php">Courses</a> </li>
                            <li class="active"><?php echo $_SESSION["cname"] ?></li>
						</ul><!-- /.breadcrumb -->

					</div>
                </div>
                
                <div class="row">
                    <div class="col-xs-8">
                        <div class="dd">
                            <ol class="dd-list">
                                <!--
                                    fa-plus: add a new unit
                                    fa-pencil-square-o: add homework
                                    fa fa-comment: add discuss
                                    glyphicon-book: add reading
                                -->
                                <?php
                                    $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
                                    $query = "SELECT * FROM group5_module WHERE cid='{$_SESSION['cid']}' ORDER BY mlabel DESC;";
                                    $result = mysqli_query($conn, $query);
                                    $sty = $_SESSION["style"];
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo '<li class="dd-item">';
                                            
                                        echo '<div class="dd2-content"> Module'.$row["mlabel"].' - '.$row["mname"];
                                        echo        '<div class="pull-right action-buttons" style="'.$sty.'">
												        <a class="red" href="add_material.php?type=1&mid='.$row["mid"].'">
												            <i class="ace-icon fa fa-plus bigger-130"></i>
												        </a>
												     </div>';
                                        echo '</div>';
                                        
                                        $query = "SELECT * FROM group5_unit WHERE mid='{$row['mid']}' ORDER BY unlabel";
                                        $un_res = mysqli_query($conn, $query);
                                        echo '<ol class="dd-list">';
                                        while($unit = mysqli_fetch_assoc($un_res)) {
                                            echo '<li class="dd-item">';
                                            echo '<div class="dd2-content">'.$unit["unname"];
                                            echo    '<div class="pull-right action-buttons" style="'.$sty.'">
												        <a class="red" href="add_material.php?type=2&unid='.$unit["unid"].'">
												            <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
												        </a>
                                                        <a class="red" href="add_material.php?type=3&unid='.$unit["unid"].'">
												            <i class="ace-icon glyphicon glyphicon-book bigger-130"></i>
												        </a>
                                                        <a class="red" href="add_material.php?type=4&unid='.$unit["unid"].'">
												            <i class="ace-icon fa fa-comment bigger-130"></i>
												        </a>
												     </div>';
                                            echo '</div>';
                                            
                                            echo '<ol class="dd-list">';
                                            $query = "SELECT * FROM group5_reading WHERE unid='{$unit['unid']}'";
                                            $read_res = mysqli_query($conn, $query);
                                            // list readinf
                                            while($reading = mysqli_fetch_assoc($read_res)) {
                                                echo '<li class="dd-item">';
                                                echo '<div class="dd2-content"> <a href="reading_content.php?rid='.$reading["rid"].'">reading - '.$reading["rname"].'</a> </div>';
                                                echo '</li>';
                                            }
                                            $query = "SELECT * FROM group5_homework WHERE unid='{$unit['unid']}'";
                                            $home_res = mysqli_query($conn, $query);
                                            //list homework
                                            while($homework = mysqli_fetch_assoc($home_res)) {
                                                echo '<li class="dd-item">';
                                                echo '<div class="dd2-content"> <a href="homework_content.php?hid='.$homework["hid"].'">homework - '.$homework["hname"].'</a> </div>';
                                                echo '</li>';
                                            }
                                            $query = "SELECT * FROM group5_discuss WHERE unid='{$unit['unid']}'";
                                            $dis_res = mysqli_query($conn, $query);
                                            // list discussion
                                            while($discuss = mysqli_fetch_assoc($dis_res)) {
                                                echo '<li class="dd-item">';
                                                echo '<div class="dd2-content"> <a href="discuss_content.php?did='.$discuss["did"].'">discuss - '.$discuss["dname"].'</a> </div>';
                                                echo '</li>';
                                            }
                                            echo '</ol>';
                                            
                                            echo '</li>';
                                        }
                                        echo '</ol>';
                                        
                                        echo '</li>';
                                        
                                        echo '<div class="space"></div>';
                                    }
                                    echo '<li class="dd-item">
                                            <div class="dd2-content" style="'.$sty.'">
                                                Add new module
                                                <div class="pull-right action-buttons">
                                                    <a class="red" href="add_material.php?type=5">
                                                        <i class="ace-icon fa fa-plus bigger-130"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>';
                                ?>
                            </ol>
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
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery.nestable.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($){
			
				$('.dd').nestable();
			
				$('.dd-handle a').on('mousedown', function(e){
					e.stopPropagation();
				});
				
				$('[data-rel="tooltip"]').tooltip();
			
			});
		</script>
    </body>