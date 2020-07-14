<?php 
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    if(admin_login()){
    $counter = 1;
    $stmt = simpleSelect($db,'subject');
 
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
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Subject</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Subject
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addsubject" ><i class="fa fa-plus-circle"> Add New Subject</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="subjectTable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject Name</th>
                                            <th>Subject Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter; ?></td>
                                                <td><?= $row['subject_name']; ?></td>
                                                <td><?= $row['subject_code']; ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editsubject">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="deleteSubject btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
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
            <!-- Add Subject Modal -->
            <div id="addsubject" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Subject
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="addSubject_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="subject_name">Subject Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="subject_name" placeholder="Enter Subject Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="subject_code">Subject Code:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="subject_code" placeholder="Enter Subject Code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Add Subject</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End New Subject Modal -->
            <!-- Edit Subject Modal -->
            <div id="editsubject" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Subject
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="editSubject_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_subject_name">Subject Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_subject_name" placeholder="Enter Subject Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_subject_code">Subject Code:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_subject_code" placeholder="Enter Subject Code" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="edit_subject_id" value="">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Edit Class Modal -->
        </div>
    </div>
<?php include ('includes/footer.php');