<?php 
  require_once ('config/database.php');
  require_once ('includes/functions.php');

  $counter =1;
  $stmt  = $db->prepare("SELECT * FROM noticeboard");
  $stmt->execute();

?>
<?php include ('includes/header.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2><i class="fa fa-newspaper-o animated tada"></i> NoticeBoard</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title"><h4>All upcoming Events</h4></div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Notice</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter;  ?></td>
                                                <td><?= $row['notice_title'];  ?></td>
                                                <td><?= $row['notice'];  ?></td>
                                                <td><?= $row['date'];  ?></td>
                                            </tr>
                                        <?php $counter++; } ?>
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