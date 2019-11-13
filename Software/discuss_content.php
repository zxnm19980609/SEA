<?php
    session_start();
    include_once 'config.php';
    $_SESSION["did"] = $_GET["did"];
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
                
                <!-- vie the old comment -->
                <div class="row">
                    <div class="col-sm-11">
                        <div class="widget-body">
				            <div class="widget-main no-padding">
				                <div class="dialogs">
                                    <?php
                                        $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
                                        $query = "SELECT * FROM group5_comment where did='{$_GET["did"]}';";
                                        $com_res = mysqli_query($conn, $query);
                                        while($comment = mysqli_fetch_assoc($com_res)) {
                                            echo '<div class="itemdiv dialogdiv">';
                                            
                                            echo '<div class="user">';
                                            echo '<img src="assets/images/avatars/user.jpg" />';
                                            echo '</div>';
                                            
                                            echo '<div class="body">';
                                            
                                            echo '<div class="time">';
                                            echo '<i class="ace-icon fa fa-clock-o"></i>';
                                            echo '<span>'.$comment["cotime"].'</span>';
                                            echo '</div>';
                                            
                                            echo '<div class="name">';
                                            $query = "SELECT * FROM group5_user where uid='{$comment["uid"]}';";
                                            $uname = mysqli_fetch_assoc(mysqli_query($conn, $query))["uname"];
                                            echo '<a href="#">'.$uname.'</a>';
                                            echo '</div>';
                                            
                                            echo '<div class="text">';
                                            echo $comment["ccontent"];
                                            echo '</div>';
                                            
                                            echo '<div class="tools">
												      <a href="#" class="btn btn-minier btn-info">
												          <i class="icon-only ace-icon fa fa-share"></i>
												      </a>
								                  </div>';
                                            
                                            echo '</div>';
                                            
                                            echo '</div>';
                                        }
                                        mysqli_close($conn);
                                    ?>
								</div>

				                <form action="comment.php" method="post">
                                    <div class="form-actions">
								        <div class="input-group">
								            <input placeholder="Type your message here ..." type="text" class="form-control" name="message" />
												<span class="input-group-btn">
												    <button class="btn btn-sm btn-info no-radius" type="submit">
												        <i class="ace-icon fa fa-share"></i>
												            Send
												        </button>
												</span>
								        </div>
								    </div>
								</form>
				            </div><!-- /.widget-main -->
				        </div><!-- /.widget-body -->
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