<?php
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    $counter=1;
    $counter2 = 1;
    $stmt= simpleSelect($db,'exam');
    $stmt2= simpleSelect($db,'subject');
    $stmt3= simpleSelect($db,'student');
    $stmt4 = simpleSelect($db,'exam');
    $stmt5 = simpleSelect($db,'class');
    $stmt6 = $db->prepare("SELECT * from mark m, exam e where e.id = m.exam_id");
    $stmt6->execute();
    
?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="page-header">
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Exams</h3>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Exam marks</div>
                        </div>
                        <div class="panel-body">
                            <form id="addGrade_form" action="" class="form-inline">
                                <div class="form-group">
                                    <label for="exam">Exam</label>
                                    <select name="exam" id="exam" class="form-control">
                                        <option value=""><-- Select Exam --></option>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <select name="subject" id="subject" class="form-control">
                                        <option value=""><-- Select Subject --></option>
                                        <?php while($row = $stmt2->fetch()){ ?>
                                            <option value="<?= $row['subject_code']; ?>"><?= $row['subject_code']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <select name="class" id="class" class="form-control">
                                        <option value=""><-- Select Exam --></option>
                                        <?php while($row = $stmt5->fetch()){ ?>
                                            <option value="<?= $row['class_code']; ?>"><?= $row['class_code']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student">Student</label>
                                    <select name="student" id="student" class="form-control">
                                        <option value=""><-- Select Student --></option>
                                        <?php while($row = $stmt3->fetch()){ ?>
                                            <option value="<?= $row['student_id']; ?>"><?= $row['student_id']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <div class="clearfix" style="margin-top:15px; margin-left:10px;"></div>
                                <div class="form-group">
                                    <label for="">Studnet Grades</label>
                                    <input type="text" name="grade" id="grade" class="form-control" placeholder="Enter Student Grade">
                                </div>
                                <div class="form-group">
                                    <label for="">Total Grades</label>
                                    <input type="text" name="total_grade" id="total_grade" class="form-control" placeholder="Enter Total Exam Grade">
                                </div>
                                <div class="form-group">
                                    <label for="">Comment</label>
                                    <input type="text" name="comment" id="comment" class="form-control" placeholder="Enter Comment">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Marks</button>
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
                            <div class="panel-title">Student Grades</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th>Student</th>
                                            <th>Grades</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt6->fetch()) {?>
                                        <tr>
                                            <td><?= $counter2; ?></td>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= $row['subject_code']; ?></td>
                                            <td><?= $row['class_code']; ?></td>
                                            <td><?= $row['student_id']; ?></td>
                                            <td><?= $row['mark']; ?></td>
                                            <td>
                                                <button class="btn btn-info btn-xs" data-id="<?= $row['mark_id']; ?>" data-toggle="modal" data-target="#editGrade"><i class="fa fa-pencil"></i></button>
                                                <button class="deletGrade btn btn-danger btn-xs" data-id="<?= $row['mark_id']; ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php $counter2 = $counter + 1; } ?>
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
                                <h4>All Exams
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addexam" ><i class="fa fa-plus-circle"> Add Exam</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable2" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam Name</th>
                                            <th>Date</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt4->fetch()){?>
                                            <tr>
                                                <td><?= $counter ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><?= $row['comment']; ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editexam">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="deleteExam btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
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
            <!-- Add Exam Modal -->
            <div id="addexam" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Exam
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="addExam_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="exam_name">Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="exam_name" placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="exam_date">Date:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="exam_date" placeholder="Enter Date" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="exam_comment">Comment:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="exam_comment" placeholder="Enter Class Code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Add Exam</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Add Exam Modal -->
            <!-- Edit Exam Modal -->
            <div id="editexam" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Exam
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="editExam_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_exam_name">Name:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_exam_name" placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_exam_date">Date:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_exam_date" placeholder="Enter Date" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="edit_exam_comment">Comment:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="edit_exam_comment" placeholder="Enter Comment" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="edit_exam_id" value="">
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
            <!-- End Edit Exam Modal -->
            <!-- Edit Exam Grade -->
            <div id="editGrade" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Grade
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="editGrade_form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="grade_exam_student">Student ID:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="grade_exam_student" placeholder="Enter Student ID" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="grade_exam_subject">Subject:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="grade_exam_subject" placeholder="Enter Subject" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="grade_exam_class">Class:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="grade_exam_class" placeholder="Enter Class" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="grade_exam_grade">Grade:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="grade_exam_grade" placeholder="Enter Grade" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="grade_exam_total">Total:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="grade_exam_total" placeholder="Enter Grade Total" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="grade_exam_comment">Comment:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="grade_exam_comment" placeholder="Enter Comment" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="grade_exam_id" value="">
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
            <!-- End Edit Exam Modal -->
        </div>
    </div>
<?php include ('includes/footer.php');