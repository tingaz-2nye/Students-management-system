<?php 
  require_once ('config/database.php');
  require_once ('includes/functions.php');

  $class = $_SESSION['student_class'];
  $stmt  = $db->prepare("SELECT * FROM timetable WHERE class_code=? ORDER BY id Asc");
  $stmt->bindParam(1,$class);
  $stmt->execute();

?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2><i class="fa fa-calendar animated swing"></i> Class TimeTable</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>Your TimeTable</h4></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Day Of Week</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $row['day'];  ?></td>
                                                <td><?= $row['class_code'];  ?></td>
                                                <td><?= $row['subject_code'];  ?></td>
                                                <td><?= $row['time_start'];  ?></td>
                                                <td><?= $row['time_end'];  ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row  -->
        </div>
    </div>


<?php include ('includes/footer.php'); ?>