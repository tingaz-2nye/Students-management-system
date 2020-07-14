<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> School Management</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/datatables.net-bs/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/datatables.net-responsive/css/responsive.bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-daterangepicker/daterangepicker.css">
</head>
<body>
    <div class="wrapper">

        <nav id="small-device-nav" class="navbar navbar-default visible-xs">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#myNavbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" class="navbar-brand">
                        College
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                    <?php  
                if(student_login()){
                    echo'
                    <li><a href="index.php"><i class="fa fa-mortar-board"></i> <span style="margin-left:15px;">Student</span></a></li>
                    <li><a href="Community.php"><i class="fa fa-users"></i> <span style="margin-left:15px;"> Community</span></a></li>
                    <li><a href="attendance.php"><i class="fa fa-check-square-o"></i> <span style="margin-left:15px;"> Attendance</span></a></li>
                    <li><a href="exams.php"><i class="fa fa-edit"></i> <span style="margin-left:15px;"> Exams</span></a></li>
                    <li><a href="assignment.php"><i class="fa fa-tasks"></i> <span style="margin-left:15px;"> Assignments</span></a></li>
                    <li><a href="timetable.php"><i class="fa fa-calendar"></i> <span style="margin-left:15px;"> Time Table</span></a></li>
                    <li><a href="events.php"><i class="fa fa-newspaper-o"></i> <span style="margin-left:15px;"> Events</span></a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span style="margin-left:15px;">Logout</span></a></li>';
                }else if(parent_login()){
                    echo'
                    <li><a href="index.php"><i class="fa fa-mortar-board"></i> <span style="margin-left:15px;">Student</span></a></li>
                    <li><a href="teachers.php"><i class="fa fa-institution"></i> <span style="margin-left:15px;"> Teacher/Tutor</span></a></li>
                    <li><a href="attendance.php"><i class="fa fa-check-square-o"></i> <span style="margin-left:15px;"> Attendance</span></a></li>
                    <li><a href="exams.php"><i class="fa fa-edit"></i> <span style="margin-left:15px;"> Exams</span></a></li>
                    <li><a href="events.php"><i class="fa fa-newspaper-o"></i> <span style="margin-left:15px;"> Events</span></a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span style="margin-left:15px;">Logout</span></a></li>'; 
                }else{
                    redirect_to('login.php');
                }
            ?>
                    </ul>
                </div>
            </div>
        </nav>
        
        <nav id="sidebar" class="hidden-xs">
            <div class="sidebar-header">
                <h3><a href="index.php">College</a></h3>
            </div>
            <ul class="unstyled-list components">
            <?php  
                if(student_login()){
                    echo'
                    <li><a href="index.php"><i class="fa fa-mortar-board"></i> <span style="margin-left:15px;">Student</span></a></li>
                    <li><a href="Community.php"><i class="fa fa-users"></i> <span style="margin-left:15px;"> Community</span></a></li>
                    <li><a href="attendance.php"><i class="fa fa-check-square-o"></i> <span style="margin-left:15px;"> Attendance</span></a></li>
                    <li><a href="exams.php"><i class="fa fa-edit"></i> <span style="margin-left:15px;"> Exams</span></a></li>
                    <li><a href="assignment.php"><i class="fa fa-tasks"></i> <span style="margin-left:15px;"> Assignments</span></a></li>
                    <li><a href="timetable.php"><i class="fa fa-calendar"></i> <span style="margin-left:15px;"> Time Table</span></a></li>
                    <li><a href="events.php"><i class="fa fa-newspaper-o"></i> <span style="margin-left:15px;"> Events</span></a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span style="margin-left:15px;">Logout</span></a></li>';
                }else if(parent_login()){
                    echo'
                    <li><a href="index.php"><i class="fa fa-mortar-board"></i> <span style="margin-left:15px;">Student</span></a></li>
                    <li><a href="teachers.php"><i class="fa fa-institution"></i> <span style="margin-left:15px;"> Teacher/Tutor</span></a></li>
                    <li><a href="attendance.php"><i class="fa fa-check-square-o"></i> <span style="margin-left:15px;"> Attendance</span></a></li>
                    <li><a href="exams.php"><i class="fa fa-edit"></i> <span style="margin-left:15px;"> Exams</span></a></li>
                    <li><a href="events.php"><i class="fa fa-newspaper-o"></i> <span style="margin-left:15px;"> Events</span></a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span style="margin-left:15px;">Logout</span></a></li>'; 
                }else{
                    redirect_to('login.php');
                }
            ?>
            </ul>
        </nav>
        <div id="page-content">
            <nav class="navbar navbar-default hidden-xs">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a id="togglesidebar" class="navbar-brand">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                        
                        <?php if(student_login()){
                                $name = getStudentField($db,'first_name');
                                echo '
                                <li><a>Welcome <strong>
                                '.$name.'   
                                </strong></a></li>';
                            }else if(parent_login()){
                                $name = getParentField($db,'first_name');
                                echo '<li><a>Welcome<strong> '.$name.'</strong></a></li>';
                            }

                        ?> 
                            <!-- <li>
                                <a href=""><i class="fa fa-envelope"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-bell"></i></a>
                            </li>
                            <li>
                                <a><img src="images/profile-pic.jpg" alt="" class="img-responsive user-img"></a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>