<?php 
  require_once ('config/database.php');
  require_once ('includes/functions.php');

if(student_login()){
  $id = $_SESSION['student_id'];

  $week1 = weekAttendance($db,'1',$id);
  $week2 = weekAttendance($db,'2',$id);
  $week3 = weekAttendance($db,'3',$id);
  $week4 = weekAttendance($db,'4',$id);
  $week5 = weekAttendance($db,'5',$id);
  $week6 = weekAttendance($db,'6',$id);
  $week7 = weekAttendance($db,'7',$id);
  $week8 = weekAttendance($db,'8',$id);
  $week9 = weekAttendance($db,'9',$id);
  $week10 = weekAttendance($db,'10',$id);
  $week11 = weekAttendance($db,'11',$id);
  $week12 = weekAttendance($db,'12',$id);
  $percentage = overallAttendance($db,$id);

}else if(parent_login()){
  
  $id = $_SESSION['parent_id'];;
  $week1 = parentWeekAttendance($db,'1',$id);
  $week2 = parentWeekAttendance($db,'2',$id);
  $week3 = parentWeekAttendance($db,'3',$id);
  $week4 = parentWeekAttendance($db,'4',$id);
  $week5 = parentWeekAttendance($db,'5',$id);
  $week6 = parentWeekAttendance($db,'6',$id);
  $week7 = parentWeekAttendance($db,'7',$id);
  $week8 = parentWeekAttendance($db,'8',$id);
  $week9 = parentWeekAttendance($db,'9',$id);
  $week10 = parentWeekAttendance($db,'10',$id);
  $week11 = parentWeekAttendance($db,'11',$id);
  $week12 = parentWeekAttendance($db,'12',$id);
  $percentage = parentOverallAttendance($db,$id);
}else{
    redirect_to('login.php');
}


?>
<?php include ('includes/header.php'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2> <i class="fa fa-check-square-o animated zoomIn"></i> Attendance</h2>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><h4>Attendance in Week</h4></div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 1</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week1; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week1; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week1; ?>%"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 2</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week2; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week2; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week2; ?>%">
                                            <?= $week2; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 3</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week3; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week3; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week3; ?>%">
                                            <?= $week3; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 4</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week4; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week4; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week4; ?>%">
                                            <?= $week4; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 5</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week5; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week5; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week5; ?>%">
                                            <?= $week5; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 6</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week6; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week6; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week6; ?>%">
                                            <?= $week6; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><h4>Attendance in Week</h4></div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 7</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week7; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week7; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week7; ?>%">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 8</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week8; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week8; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week8; ?>%">
                                            <?= $week8; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 9</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week9; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week9; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week9; ?>%">
                                            <?= $week9; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 10</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week10; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week10; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week10; ?>%">
                                            <?= $week10; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 11</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week11; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week11; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week11; ?>%">
                                            <?= $week11; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-xs-4">
                                    <span><strong>Week 12</strong></span>
                                </div>
                                <div class="col-xs-2">
                                <span class="counter" data-count="<?= $week12; ?>">0</span>%
                                </div>
                                <div class="col-xs-6">
                                    <div class="progress">
                                        <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="<?= $week12; ?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width:<?= $week12; ?>%">
                                            <?= $week12; ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><h4>Student Attendance</h4></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span class="chart" data-percent="<?= $percentage; ?>">
                                                <span class="percent"></span>
                                </span>
                            <div><h4 >Overall Attendance</h4></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row  -->
    </div>
</div>


<?php include ('includes/footer.php'); ?>