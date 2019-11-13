    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">

                    <img src="assets/images/logo.jpg" />

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php if(($_SERVER['REQUEST_URI'])=='/Group5/Software/index.php' or ($_SERVER['REQUEST_URI'])=='/Group5/Software/'){echo 'active';}else{ echo '';} ?>">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

                    <!-- only in course, open submenu. -->
					<li class="<?php if(($_SERVER['REQUEST_URI'])=='/Group5/Software/courses.php'){echo 'active';}elseif(($_SERVER['PHP_SELF'])=='/Group5/Software/home.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/syllabus.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/modules.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/discuss.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/homework.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/discuss_content.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/homework_content.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/reading_content.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/view_homework.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/judge.php'){echo 'active open';}else{ echo '';} ?>">
						<a href="courses.php">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text">
								Courses
							</span>
						</a>

                        <ul class="submenu">
							<li class="<?php if(($_SERVER['PHP_SELF'])=='/Group5/Software/home.php') echo 'active'?>">
								<a href="home.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Home
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(($_SERVER['PHP_SELF'])=='/Group5/Software/syllabus.php') echo 'active'?>">
								<a href="syllabus.php">
									<i class="menu-icon fa fa-caret-right"></i>
                                    Syllabus
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(($_SERVER['PHP_SELF'])=='/Group5/Software/modules.php') echo 'active'?>">
								<a href="modules.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Modules
								</a>

								<b class="arrow"></b>
							</li>

                            <li class="<?php if(($_SERVER['PHP_SELF'])=='/Group5/Software/discuss.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/discuss_content.php') echo 'active'?>">
								<a href="discuss.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Discuss
								</a>

								<b class="arrow"></b>
							</li>

                            <li class="<?php if(($_SERVER['PHP_SELF'])=='/Group5/Software/homework.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/homework_content.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/view_homework.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/judge.php') echo 'active'?>">
								<a href="homework.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Homework
								</a>

								<b class="arrow"></b>
							</li>


						</ul>

                    </li>

					<li class="<?php if(($_SERVER['REQUEST_URI'])=='/Group5/Software/calendar.php'){echo 'active';}else{ echo '';} ?>">
						<a href="calendar.php">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Calendar
							</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php if(($_SERVER['REQUEST_URI'])=='/Group5/Software/inbox.php'||($_SERVER['PHP_SELF'])=='/Group5/Software/mail_content.php'){echo 'active';}else{ echo '';} ?>">
				        <a href="inbox.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Inbox
                        </a>

                        <b class="arrow"></b>
				    </li>


					<li>
				        <a href="mailto:1875860189@qq.com">
                            <i class="menu-icon fa fa-book fa-fw"></i>
                            Contact
                        </a>

                        <b class="arrow"></b>
				    </li>

					<li>
				        <a href="UserDoc.pdf" target="_blank">
                            <i class="menu-icon fa fa-square"></i>
                            Help
                        </a>

                        <b class="arrow"></b>
				    </li>


                    </ul><!-- /.nav-list -->

			</div>
