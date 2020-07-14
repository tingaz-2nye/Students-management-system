<?php 
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    if(admin_login()){
    $counter = 1;
    $stmt = simpleSelect($db,'teacher');
    $stmt1 = simpleSelect($db,'class');
    $stmt2 = simpleSelect($db,'subject');
    $stmt4 = simpleSelect($db,'student');
    $stmt5 = simpleSelect($db,'teacher_assigned_to_student');
    $stmt3 = $db->prepare("SELECT * FROM teacher_to_class_and_subject t,subject s where t.subject_id=s.id");
    $stmt3->execute();
    $counter2=1;

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
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Teachers</h3>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4> All Assigned Teacher to Class and Subject </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                <div class="table-responsive">
                                <table id="dataTable" class="teacherTable1 table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher ID</th>
                                            <th>Class Code</th>
                                            <th>subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt3->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter2; ?></td>
                                                <td><?= $row['teacher_id']; ?></td>
                                                <td><?= $row['class_code']; ?></td>
                                                <td><?= $row['subject_name']; ?></td>
                                                <td>
                                                    <button class="deleteAssignedTeacher btn btn-xs btn-danger" data-id="<?= $row['assigned_id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $counter2=$counter2+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4> Assign Teacher to Class and Subject </h4>
                        </div>
                        <div class="panel-body">
                            <form id="assignTeacher_form" action="" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="assign_teacher_id" required="required" type="text" placeholder="Enter Teacher ID">     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <select class="form-control" name="" id="assign_class_code" required>
                                            <option value="">-- Select Class --</option>
                                            <?php while($row = $stmt1->fetch()){ ?>
                                                <option value="<?= $row['class_code']; ?>"><?= $row['class_code']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <select class="form-control" name="" id="assign_subject_id" required>
                                            <option value="">-- Select Subject --</option>
                                            <?php while($row = $stmt2->fetch()){ ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['subject_name']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button name="" class="btn btn-success" id="" type="submit">Assign Teacher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4> Assign Teacher to Class and Subject </h4>
                        </div>
                        <div class="panel-body">
                            <form id="assignTutor_form" action="" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="tutor_id" required type="text" placeholder="Enter Teacher ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <select class="form-control" name="" id="student_id" required>
                                            <option value="">-- Select Student --</option>
                                            <?php while($row = $stmt4->fetch()){ ?>
                                                <option value="<?= $row['student_id']; ?>"><?= $row['student_id']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button name="" class="btn btn-success" id="" type="submit">Assign Teacher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4> All Assigned Teachers to Students </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                <div class="table-responsive">
                                <table id="dataTable3" class="teacherTable3 table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher ID</th>
                                            <th>Student ID</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt5->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter2; ?></td>
                                                <td><?= $row['teacher_id']; ?></td>
                                                <td><?= $row['student_id']; ?></td>
                                                <td>
                                                    <button class="deleteTutor btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $counter2=$counter2+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4> Registered Teachers 
                            <span class="pull-right"><button type="submit" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addteacher"><i class="fa fa-plus-circle"></i>  Add New Teacher</button></span>
                           </h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable2" class="teacherTable2 table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter; ?></td>
                                                <td><?= $row['teacher_id']; ?></td>
                                                <td><?= $row['first_name']; ?></td>
                                                <td><?= $row['last_name']; ?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editTeacher">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-xs btn-success" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#emailteacher">
                                                        <i class="fa fa-envelope"></i>
                                                    </button>
                                                    <button class="deleteTeacher btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $counter=$counter+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->          
        </div>
        <!-- End container-fluid -->
        <!-- Add New teacher Modal -->
        <div id="addteacher" class="modal fade" role="dialog">
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
                                    <i class="fa fa-plus-circle"></i> Add Teacher
                                </div>
                            </div>
                            <hr>
                            <div class="panel-body">
                                <form id="addTeacher_form" action="" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="first_name">First Name:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="last_name">Last Name:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                                    <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="teacher_id">Teacher ID:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="teacher_id" placeholder="Enter Teacher ID" required>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Add New teacher Modal End -->
        <!-- Edit teacher Modal -->
        <div id="editTeacher" class="modal fade" role="dialog">
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
                                    <i class="fa fa-plus-circle"></i> Edit Teacher
                                </div>
                            </div>
                            <hr>
                            <div class="panel-body">
                                <form id="editTeacher_form" action="" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_first_name">First Name:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_first_name" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_last_name">Last Name:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_last_name" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_email">Email:</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="edit_email" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_teacher_id">Teacher ID:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_teacher_id" placeholder="Enter Teacher ID" required>
                                    </div>
                                </div>
                                <input type="hidden" id="primary_teacher_id">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Edit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Edit teacher Modal End -->
        <!-- Email teacher Modal -->
        <div id="emailteacher" class="modal fade" role="dialog">
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
                                    <i class="fa fa-plus-circle"></i> Email Teacher
                                </div>
                            </div>
                            <hr>
                            <div class="panel-body">
                                <form id="emailTeacher_form" action="" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="subject">Subject:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="subject" placeholder="Enter Subject" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="message">Message:</label>
                                    <div class="col-sm-10">
                                    <textarea type="text" rows="5" class="form-control" id="message" placeholder="Enter Last Name" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Send</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Email teacher Modal End -->
    </div>
<?php include ('includes/footer.php'); ?>