<?php
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    if(admin_login()){
    $count = 1;
    $stmt = simpleSelect($db,'timetable');
    $stmt1 = simpleSelect($db,'class');
    $stmt2 = simpleSelect($db,'subject');

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
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Timetable</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Classes
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addTimetable" ><i class="fa fa-plus-circle"> Add New Timetable</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="timeTable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Day of Week</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        while($row = $stmt->fetch()){
                                        
                                        ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= $row['day']; ?></td>
                                            <td><?= $row['class_code']; ?></td>
                                            <td><?= $row['subject_code']; ?></td>
                                            <td><?= $row['time_start']; ?></td>
                                            <td><?= $row['time_end']; ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editTimetable">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="timetable_delete btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $count = $count+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <!-- Add Timetable Modal -->
            <div id="addTimetable" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Timetable
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="timetable_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="day">Day of Week:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="day" placeholder="Enter Day of The Week" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="class_code">Class Code:</label>
                                            <div class="col-sm-10">
                                            <select type="text" class="form-control" id="class_code" placeholder="Enter Class Code" required>
                                                <option value=""><-- Choose Class--></option>
                                                <?php while($row = $stmt1->fetch()){ ?>
                                                        <option value="<?= $row['class_code']; ?>"><?= $row['class_code']; ?></option>
                                                    <?php }?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="subject_code">Subject Code:</label>
                                            <div class="col-sm-10">
                                            <select type="text" class="form-control" id="subject_code" placeholder="Enter Subject Code" required>
                                            <option value=""><-- Choose Subject--></option>
                                                <?php while($row = $stmt2->fetch()){ ?>
                                                        <option value="<?= $row['subject_code']; ?>"><?= $row['subject_code']; ?></option>
                                                    <?php }?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="start_time">Starting Time:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="start_time" placeholder="Enter Subject Starting Time" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="end_time">Ending Start:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="end_time" placeholder="Enter Subject End Time" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Add Time</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Add Timetable Modal -->
            <!-- Edit Timetable Modal -->
            <div id="editTimetable" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Timetable
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="edit_timetable_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="day">Day of Week:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="day" placeholder="Enter Day of The Week" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="class_code">Class Code:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="class_code" placeholder="Enter Class Code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="subject_code">Subject Code:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="subject_code" placeholder="Enter Subject Code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="start_time">Starting Time:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="start_time" placeholder="Enter Subject Starting Time" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="end_time">Ending Start:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="end_time" placeholder="Enter Subject End Time" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="timetable_id" value="">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Edit Time</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Edit Timetable Modal -->
        </div>
    </div>
<?php include ('includes/footer.php');