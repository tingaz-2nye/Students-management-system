<?php
    require_once ('../config/database.php');
    require_once ('includes/functions.php');
    
    $counter=1;
    $counter2=1;
    $stmt=simpleSelect($db,'assignments');
    $stmt2=simpleSelect($db,'student_assignments');
    $stmt1=simpleSelect($db,'class');

?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Assigments</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Teacher Assignments
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#assignment" ><i class="fa fa-plus-circle"> Add New Assignment</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="assignmentTable1 table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Class</th>
                                            <th>Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){?>
                                        <tr>
                                            <td><?= $counter; ?></td>
                                            <td><?= $row['title']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?= $row['class_code']; ?></td>
                                            <td><?= $row['post_time']; ?></td>
                                            <td>
                                                
                                                
                                                <a class="btn btn-xs btn-success" style="width:60px;" href="../<?= $row['file_path']; ?>" download="<?= $row['title']; ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                
                                                
                                                <button class="deleteAssign btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                                
                                            </td>
                                        </tr>
                                        <?php $counter = $counter+1; } ?>
                                    </tbody>
                                </table>
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
                            <div class="panel-title">
                                <h4>All Student Uploaded Assignments
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable2" class="assignmentTable2 table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Class</th>
                                            <th>Student ID</th>
                                            <th>Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt2->fetch()){?>
                                        <tr>
                                            <td><?= $counter2; ?></td>
                                            <td><?= $row['title']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?= $row['class_code']; ?></td>
                                            <td><?= $row['student_id']; ?></td>
                                            <td><?= $row['post_time']; ?></td>
                                            <td>
                                                
                                                
                                                <a class="btn btn-xs btn-success" style="width:60px;" href="../<?= $row['file_path']; ?>" download="<?= $row['title']; ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                
                                                
                                                <button class="deleteStudentAssign btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                                
                                            </td>
                                        </tr>
                                        <?php $counter2 = $counter2+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <!-- Add Assignment Modal -->
            <div id="assignment" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Assignment
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="assginUpload_form" action="" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="title">Title:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="description">Description:</label>
                                            <div class="col-sm-10">
                                            <textarea type="text" rows="5" class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="class_code">Class:</label>
                                            <div class="col-sm-10">
                                            <select type="text" class="form-control" name="class_code" id="class_code" placeholder="Enter Class Code" required>
                                                <option value=""><-- Select Class --></option>
                                                <?php while($row = $stmt1->fetch()){?>
                                                    <option value="<?= $row['class_code']; ?>"><?= $row['class_code']; ?></option>
                                                <?php } ?>
                                            </select>    
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="file">File Upload:</label>
                                            <div class="col-sm-10">
                                            <input type="file" class="" name="file" id="file" required>
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
            <!-- End Add Assignment Modal -->
        </div>
    </div>
<?php include ('includes/footer.php');