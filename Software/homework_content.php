<?php
    session_start();
    include_once 'config.php';
    if($_SESSION["role"] == 2) {
        $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);
        $result = mysqli_query($conn, "SELECT * FROM group5_answer WHERE uid='{$_SESSION["uid"]}' AND qid in (SELECT qid FROM group5_question WHERE hid='{$_GET["hid"]}')");
        if(mysqli_num_rows($result) > 0) {
            header("location:view_homework.php?uid=".$_SESSION["uid"]."&hid=".$_GET["hid"]);
        }
        mysqli_close($conn);
    }
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
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4> Homework </h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">  
                                    <form action='<?php echo "submit_homework.php?hid=".$_GET["hid"]; ?>' method="post" enctype="multipart/form-data">
                                        <?php
                                            $conn = mysqli_connect($sql_host, $sql_db_user, $sql_db_pwd, $sql_db_name);                                      
                                            $query = "SELECT * FROM group5_question WHERE hid='{$_GET["hid"]}' ORDER BY qid";
                                            $que_res = mysqli_query($conn, $query);
                                            $cnt = 0;
                                            while($question = mysqli_fetch_assoc($que_res)) {
                                                $cnt = $cnt + 1;
                                                echo '<div>
                                                        <div class="row">
                                                            <label> <font color="#FF0000"> Question '.$cnt.': '.$question["title"].'(score:'.$question["score"].'pt)</font> </label>
                                                        </div>
                                                        <div class="row">';
                                                if($question["type"] == 1) {
                                                    //subjective question
                                                    echo '<input type="text" class="form-control" name="answer'.$question["qid"].'"/>';
                                                    echo '<input class="file-input" type="file" name="file'.$question["qid"].'"/>';
                                                } else {
                                                    //objective question
                                                    $json = json_decode($question["selector"]);
                                                    echo '<label> <input type="radio" name="answer'.$question["qid"].'" value="A" checked>A: '.$json->A.'</label> <br>';
                                                    echo '<label> <input type="radio" name="answer'.$question["qid"].'" value="B">B: '.$json->B.'</label> <br>';
                                                    echo '<label> <input type="radio" name="answer'.$question["qid"].'" value="C">C: '.$json->C.'</label> <br>';
                                                    echo '<label> <input type="radio" name="answer'.$question["qid"].'" value="D">D: '.$json->D.'</label>';
                                                }
                                                echo        '</div>
                                                      </div>

                                                      <hr />';
                                            } 
                                            mysqli_close($conn);
                                            if($_SESSION["role"] == 2)
                                                echo '<div class="row">
                                                          <button type="submit" style="display:block;margin:0 auto" class="width-35 btn btn-sm btn-primary">
                                                                  <span class="bigger-110">submit</span>
                                                          </button>
                                                      </div>';
                                        ?>
                                    </form>
                                </div>
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
			
				$('.dd-handle a').on('mousedown', function(e){
					e.stopPropagation();
				});
				
				$('[data-rel="tooltip"]').tooltip();
                
                $('.file-input').ace_file_input({
                    allowExt: ['pdf'],
                    allowMime: ['application/pdf'],
                }).on('file.error.ace', function (event, info) {
                    if (info.invalid_count > 0) {
                        alert('Invalid File Type!');
                    }
                });
			
			});
            
		</script>
    </body>