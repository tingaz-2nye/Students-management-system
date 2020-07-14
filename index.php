<?php 
  require_once ('config/database.php');
  require_once ('includes/functions.php');
  
  if(student_login()){
  $first_name = getStudentField($db,'first_name');
  $last_name = getStudentField($db,'last_name');
  $class = getStudentField($db,'class');
  $email = getStudentField($db,'email');

  $id = $_SESSION['student_id'];
  $percentage = overallAttendance($db,$id);

  $row =studentAverageMarks($db)->fetch();
  $grade = $row['avgMark'];

  }else if (parent_login()){
    $stmt = $db->prepare("SELECT * FROM student WHERE parent_id=?");
    $stmt->bindParam(1,$_SESSION['parent_id']);
    $stmt->execute();
    $row = $stmt->fetch();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $class = $row['class'];
    $id = $row['student_id'];

    $parent_id = $_SESSION['parent_id'];
    $percentage = parentOverallAttendance($db,$parent_id);

    $row =parentAverageMarks($db)->fetch();
    $grade = $row['avgMark'];


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
          <h2><i class="fa fa-mortar-board animated flipInX"></i> Student Overview</h2>
        </div>
      </div>
    </div>
      <div class="row">
        <div class="col-md-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                <h4>
                  Student Mini Profile
                </h4>
              </div>
            </div>
            <div class="panel-body">
              <dl>
                <dt>
                  <strong>Student Name</strong>
                </dt>
                <dd><?= $first_name.' '.$last_name; ?></dd>
                <dt>
                  <strong>Student ID</strong>
                </dt> 
                <dd><?= $id; ?></dd>
                <dt>
                  <strong>Student Class</strong>
                </dt> 
                <dd><?= $class; ?></dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default ">
            <div class="panel-heading">
              <div class="panel-title">
                <h4>Student Average Perfomance</h4>
              </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 text-center">
                  <span class="chart" data-percent="<?= $grade; ?>">
                                  <span class="percent"></span>
                  </span>
                  <div><h4 >Average Exam Grade</h4></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title"><h4>Class Attendance</h4></div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 text-center">
                  <span class="chart" data-percent="<?= $percentage; ?>">
                                  <span class="percent"></span>
                  </span>
                  <div><h4 >Overall Attendance</h4></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End row  -->
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">Change Password</div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                <form id="<?php if(student_login()){echo 'passwordChange';}else if(parent_login()){ echo 'Parent_passwordChange';} ?>" action="" method="post" class="form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="cpassword">Password:</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="cpassword" placeholder="Enter password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="cpwd">New Password:</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="cpwd" placeholder="Enter New password">
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
      <!-- End row -->
    </div>
  </div>


<?php include ('includes/footer.php'); ?>