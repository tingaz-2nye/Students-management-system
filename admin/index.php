<?php 
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    if(admin_login()){

    $stmt1=$db->prepare("SELECT AVG(mark) AS avgMark FROM mark");
    $stmt1->execute();
    $row = $stmt1->fetch();
    $grade = $row['avgMark'];

    $stmt2 = $db->prepare("SELECT * FROM attendance");
    $stmt2->execute();
    $rowCount = $stmt2->rowCount();

    $stmt3 = $db->prepare("SELECT * FROM attendance WHERE status ='Absent'");
    $stmt3->execute();
    $row = $stmt3->rowCount();
    $absents = $row;
    
        if($rowCount == 0){
            $absentPercentage = 0;
        }else{
            $absentPercentage = ($absents / $rowCount) * 100;
        }

    $stmt4 = $db->prepare("SELECT * FROM attendance WHERE status ='Present'");
    $stmt4->execute();
    $row = $stmt4->rowCount();
    $present = $row;
    
        if($row == 0){
            $percentage = 0;
        }else{
            $percentage = ($present/$rowCount) * 100;
        }
    
    }else{
        redirect_to('login.php');
    }
?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header"><h2><i class="fa fa-dashboard animated lightSpeedIn"></i> Dashboard</h2></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div>
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="text-box pull-right">
                                   <p id="student_online_count" class="main-text pull-right"></p>
                                   <div class="clearfix"></div>
                                   <p class="secondary-text">Students Online </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div>
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="text-box pull-right">
                                   <p id="parent_online_count" class="main-text pull-right"></p>
                                   <div class="clearfix"></div>
                                   <p class="secondary-text">Parents Online </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div>
                                    <i class="fa fa-male fa-5x"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="text-box pull-right">
                                   <p id="teacher_online_count" class="main-text pull-right"></p>
                                   <div class="clearfix"></div>
                                   <p class="secondary-text">Teachers Online </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title"><h3>Students Perfomance Overview</h3></div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4 text-center">
                                <span class="chart" data-percent="<?= $percentage; ?>">
                                                <span class="percent"></span>
                                </span>
                                <div><h4 >Overall Attendance</h4></div>
                            </div>
                            <div class="col-md-4 text-center">
                                <span class="chart" data-percent="<?= $absentPercentage; ?>">
                                                <span class="percent"></span>
                                </span>
                                <div><h4 >Overall Absentises</h4></div>
                            </div>
                            <div class="col-md-4 text-center">
                                <span class="chart" data-percent="<?= $grade; ?>">
                                                <span class="percent"></span>
                                </span>
                                <div><h4 >Average Student Grade</h4></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title"> <h3>Teacher Online List</h3></div>
                        </div>
                        <div class="panel-body">
                            <div class="fixed-height">
                                <ul id="teacher_online_list" class="list-group">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include ('includes/footer.php'); ?>