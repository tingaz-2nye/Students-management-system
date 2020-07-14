<?php
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    $counter= 1;
    $stmt = simpleSelect($db,'student');
    $stmt1 = simpleSelect($db,'class');
    $stmt2 = simpleSelect($db,'parent');


?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Students</h3>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                            <h4> Registered Student 
                                <span class="pull-right">
                                    <?php
                                        if(admin_login()){
                                            echo '
                                            <button type="submit" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addstudent">
                                            <i class="fa fa-plus-circle"></i>  Add New Student</button> ';
                                        }
                                    ?>
                                </span>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="studentTable table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Class</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter ?></td>
                                                <td><?= $row['student_id']; ?></td>
                                                <td><?= $row['first_name']; ?></td>
                                                <td><?= $row['last_name']; ?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td><?= $row['class']; ?></td>
                                                <td>
                                                <?php
                                                    if(admin_login()){
                                                        ?>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editstudent">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="deleteStudent btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>';
                                                    <?php }
                                                ?>
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
        <!-- End Container-fluid -->
         <!-- Add New Student Modal -->
         <div id="addstudent" class="modal fade" role="dialog">
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
                                    <i class="fa fa-plus-circle"></i> Add Student
                                </div>
                            </div>
                            <hr>
                            <div class="panel-body">
                                <form id="addStudent_form" action="" class="form-horizontal">
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
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-4" for="gender">Gender:</label>
                                        <div class="col-sm-8">
                                        <select class="form-control" name="" id="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-4" for="age">Age:</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="age" placeholder="Enter Age" required>
                                        </div>
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
                                    <label class="control-label col-sm-2" for="student_id">Student ID:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="student_id" placeholder="Enter Student ID" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="parent_id">Parent:</label>
                                    <div class="col-sm-10">
                                    <select class="form-control " name="" id="parent_id" required>
                                        <option value=""><-- Select Parent  --></option>
                                        <?php while($row = $stmt2->fetch()){ ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['first_name'].' '.$row['last_name']; ?></option>
                                        <?php }?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="class_code">Class:</label>
                                    <div class="col-sm-10">
                                    <select class="form-control" name="" id="class_code" required>
                                    <option value=""><-- Select Parent  --></option>
                                        <?php while($row3 = $stmt1->fetch()){ ?>
                                            <option value="<?= $row3['class_code']; ?>"><?= $row3['class_code']; ?></option>
                                        <?php }?>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Add New student Modal End -->
        <!-- Edit Student Modal -->
        <div id="editstudent" class="modal fade" role="dialog">
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
                                    <i class="fa fa-plus-circle"></i> Edit Student
                                </div>
                            </div>
                            <hr>
                            <div class="panel-body">
                                <form id="editStudent_form" action="" class="form-horizontal">
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
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-4" for="edit_gender">Gender:</label>
                                        <div class="col-sm-8">
                                        <select class="form-control" name="" id="edit_gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-4" for="edit_age">Age:</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_age" placeholder="Enter Age" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_email">Email:</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="edit_email" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_student_id">Student ID:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_student_id" placeholder="Enter Student ID" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="edit_class_code">Class:</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="" id="edit_class_code" required>
                                    </div>
                                </div>
                                <input type="hidden" id="primary_student_id" value="">
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
        <!-- Edit student Modal End -->
    </div>
<?php include ('includes/footer.php'); ?>