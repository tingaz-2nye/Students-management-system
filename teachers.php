<?php 
    require_once ('config/database.php');
    require_once ('includes/functions.php');

    $counter=1;
    $stmt = $db->prepare("SELECT te.id, te.teacher_id ,te.first_name,te.last_name FROM teacher te,student s, teacher_assigned_to_student t WHERE s.student_id = t.student_id and te.teacher_id = t.teacher_id and s.parent_id = ?");
    $stmt->bindParam(1,$_SESSION['parent_id']);
    $stmt->execute();


?>
<?php include ('includes/header.php'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2><i class="fa fa-institution animated bounceIn"></i> Student Teacher/Tutor</h2>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4> Student Assigned Teachers 
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
                                                <td>
                                                    <button class="btn btn-xs btn-success" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#emailteacher">
                                                        <i class="fa fa-envelope"></i>
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
</div>


<?php include ('includes/footer.php'); ?>