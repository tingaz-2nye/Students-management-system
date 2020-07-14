<?php
    require_once ('config/database.php');
    require_once ('includes/functions.php');

    
    $counter=1;
    $counter1=1;
    $stmt= simpleSelect($db,'exam');
    
    if(student_login()){
    
    $stmt1 = $db->prepare("SELECT * FROM mark m, exam e WHERE m.exam_id = e.id and student_id =?");
    $stmt1->bindParam(1,$_SESSION['student_id']);
    $stmt1->execute();
    
    }else if(parent_login()){
    
    $stmt1 = $db->prepare("SELECT * FROM mark m, exam e,student s WHERE s.student_id = m.student_id and  m.exam_id = e.id and s.parent_id =?");
    $stmt1->bindParam(1,$_SESSION['parent_id']);
    $stmt1->execute();
    
    }else{
        redirect_to('login.php');
    }

    $row =studentAverageMarks($db)->fetch();
    $grade = $row['avgMark'];
    
?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3> <i class="fa fa-edit animated jackInTheBox"></i> Exams</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Exam Grades</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam Name</th>
                                            <th>Student ID</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Obtained Grade</th>
                                            <th>Out Of</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt1->fetch()){?>
                                            <tr>
                                                <td><?= $counter ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td><?= $row['student_id']; ?></td>
                                                <td><?= $row['class_code']; ?></td>
                                                <td><?= $row['subject_code']; ?></td>
                                                <td><?= $row['mark']; ?></td>
                                                <td><?= $row['total_mark']; ?></td>
                                                <td><?= $row['comment']; ?></td>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Exams</h4>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){?>
                                            <tr>
                                                <td><?= $counter1 ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><?= $row['comment']; ?></td>
                                            </tr>
                                        <?php $counter1=$counter1+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
    </div>
    <?php include ('includes/footer.php'); ?>
