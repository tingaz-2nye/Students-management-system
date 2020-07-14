<?php 
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    $count = 1;
    $stmt = simpleSelect($db,'parent');
 
?>

<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Parents</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Registered Parents
                                <?php
                                    if(admin_login()){
                                        ?> 
                                        <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addparent" ><i class="fa fa-plus-circle"> Add New Parent</i></button></span>
                                    <?php } ?>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="parentsTable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while($row = $stmt->fetch()){ ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                            <td><?= $row['first_name'] ?></td>
                                            <td><?= $row['last_name'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td>
                                            <?php
                                                    if(admin_login()){
                                                        ?>
                                                <button class="btn btn-xs btn-info" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#editparent">
                                                    <i class="fa fa-pencil"></i>
                                                </button> 
                                             <?php   } ?>
                                                <button class="btn btn-xs btn-success" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#emailparent">
                                                    <i class="fa fa-envelope"></i>
                                                </button>
                                            <?php
                                                if(admin_login()){
                                                    ?>
                                                <button class="deleteParent btn btn-xs btn-danger" data-id="<?= $row['id'] ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                                <?php   } ?>
                                            </td>
                                        </tr>
                                       <?php $count = $count +1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <!-- Add Parent Modal -->
            <div id="addparent" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Parent
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="addParent_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="first_name">First Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="lasat_name">last Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Email:</label>
                                            <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="password">Password:</label>
                                            <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" placeholder="Enter Password" required>
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
            <!-- End New Parent Modal -->
            <!-- Edit Parent Modal -->
            <div id="editparent" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Parent
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="editParent_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="first_name">First Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="lasat_name">last Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Email:</label>
                                            <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="editParent_id" value="">
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
            <!-- End Edit Parent Modal -->
            <!-- Email Parent Modal -->
            <div id="emailparent" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Email Parent
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="emailParent_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Email:</label>
                                            <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email" disabled>
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
                                            <textarea type="text" rows="5" class="form-control" id="message" placeholder="Enter Message" required></textarea>
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
                    </div>
                </div>
            </div>
            <!-- End Email Parent Modal -->
        </div>
    </div>
<?php include ('includes/footer.php'); ?>