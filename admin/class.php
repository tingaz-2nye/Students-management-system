<?php 
    require_once ('../config/database.php');
    require_once ('includes/functions.php');
    
    if(admin_login()){
    $counter = 1;
    $stmt = simpleSelect($db,'class');

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
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Classes</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Classes
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addclass" ><i class="fa fa-plus-circle"> Add New Class</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="classTable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Class Level</th>
                                            <th>Class Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter; ?></td>
                                                <td><?= $row['class_name']; ?></td>
                                                <td><?= $row['class_level']; ?></td>
                                                <td><?= $row['class_code']; ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editclass">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="deleteClass btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
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
            <!-- Add Parent Modal -->
            <div id="addclass" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Class
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="addClass_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="class_name">Class Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="class_name" placeholder="Enter Class Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="class_level">Class Level:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="class_level" placeholder="Enter Class Level" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="class_code">Class Code:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="class_code" placeholder="Enter Class Code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Add Class</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End New Class Modal -->
            <!-- Edit Class Modal -->
            <div id="editclass" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Class
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="editClass_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_class_name">Class Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_class_name" placeholder="Enter Class Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_class_level">Class Level:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_class_level" placeholder="Enter Class Level" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_class_code">Class Code:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_class_code" placeholder="Enter Class Code" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="edit_class_id" value="">
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