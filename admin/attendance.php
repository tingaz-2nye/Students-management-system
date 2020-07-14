<?php
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    $stmt=simpleSelect($db,'class');
?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Attendance</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Manage Class Attendance</div>
                        </div>
                        <div class="panel-body">
                            <form id="manage_attendance_form" class="form-inline">
                            <div class="form-group">
                                <label for="week">Week:</label>
                                <select type="text" class="form-control" id="week" required>
                                    <option value=""><-- Select Week --></option>
                                    <option value="1">Week One</option>
                                    <option value="2">Week Two</option>
                                    <option value="3">Week Three</option>
                                    <option value="4">Week Four</option>
                                    <option value="5">Week Five</option>
                                    <option value="6">Week Six</option>
                                    <option value="7">Week Seven</option>
                                    <option value="8">Week Eight</option>
                                    <option value="9">Week Nine</option>
                                    <option value="10">Week Ten</option>
                                    <option value="11">Week Eleven</option>
                                    <option value="12">Week Twelve</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="day">day:</label>
                                <select type="txt" class="form-control" id="day" required>
                                    <option value=""><-- Select Day of Week --></option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>
                            <div class="form-group"><label for=""></label>
                                <select id="class" class="form-control" required>
                                    <option value=""><-- Select Class --></option>
                                    <?php while($row = $stmt->fetch()){?>
                                        <option value="<?= $row['class_code']; ?>"><?= $row['class_code']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">View</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Attendance Table
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#attendance" ><i class="fa fa-plus-circle"> Perform Today's student attendance</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p id="attendance-mute" class="text-muted text-center">Choose Week, Day of Week and Class to show attendance</p>
                            <div id="" class="table-responsive">
                                <table id="table_data" class="table table-striped table-bordered">
                                        
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <!-- Add Class attendance Modal -->
            <div id="attendance" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">College</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <i class="fa fa-plus-circle"></i> Class Attendance
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="classAttendance_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="add_week">Week:</label>
                                            <div class="col-sm-10">
                                            <select type="text" class="form-control" id="add_week">
                                                <option value=""><-- Select Week --></option>
                                                <option value="1">Week One</option>
                                                <option value="2">Week Two</option>
                                                <option value="3">Week Three</option>
                                                <option value="4">Week Four</option>
                                                <option value="5">Week Five</option>
                                                <option value="6">Week Six</option>
                                                <option value="7">Week Seven</option>
                                                <option value="8">Week Eight</option>
                                                <option value="9">Week Nine</option>
                                                <option value="10">Week Ten</option>
                                                <option value="11">Week Eleven</option>
                                                <option value="12">Week Twelve</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="add_day">Day of Week:</label>
                                            <div class="col-sm-10">
                                            <select type="txt" class="form-control" id="add_day">
                                                <option value=""><-- Select Day of Week --></option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="add_class">Class Code:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="add_class" placeholder="Enter Class Code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="add_student_id">Student ID:</label>
                                            <div class="col-sm-10">
                                            <input type="student" id="add_student_id" class="form-control" placeholder="Enter Student ID">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="add_status">Status:</label>
                                            <div class="col-sm-10">
                                            <select type="student" id="add_status" class="form-control">
                                                <option value="Present">Present</option>
                                                <option value="Absent">Absent</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Class attendance Modal -->
        </div>
    </div>
<?php include ('includes/footer.php');