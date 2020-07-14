<?php
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    if(admin_login()){
    $count = 1;
    $stmt = simpleSelect($db,'noticeboard');
     
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
                        <h3> <i class="fa fa-cog animated rollIn"></i> Manage Events</h3>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>All Events
                                    <span class="pull-right"><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addevent"><i class="fa fa-plus-circle"> Add New Event</i></button></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="EventsTable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Notice</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="eventTable_body">
                                        <?php
                                            while( $row = $stmt->fetch()){?>
                                            <tr>
                                                <td><?= htmlentities($count); ?></td>
                                                <td><?= htmlentities($row['notice_title']); ?></td>
                                                <td><?= htmlentities($row['notice']); ?></td>
                                                <td><?= htmlentities($row['date']); ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>"  data-toggle="modal" data-target="#eventEdit">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="deleteEvent btn btn-xs btn-danger" id="deleteEvent" data-id="<?= $row['id']; ?>" >
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $count = $count+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <!-- Add Event Modal -->
            <div id="addevent" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Add Event
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form id="AddEvent_Form" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="event_title">Event Title:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="event_title" placeholder="Enter Event Title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="event_desc">Event Description:</label>
                                            <div class="col-sm-10">
                                            <textarea type="text" class="form-control" rows="5" id="event_desc" placeholder="Enter Event Description" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="event_date">Event Date:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="date-picker form-control" id="event_date" placeholder="Enter Event Date" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default">Add Event</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End New Event Modal -->
            <!-- Edit Event Modal -->
            <div id="eventEdit" class="modal fade" role="dialog">
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
                                        <i class="fa fa-plus-circle"></i> Edit Event
                                    </div>
                                </div>
                                <hr>
                                <div id="event_form" class="panel-body">
                                     <form id="EditEvent_Form" action="" class="form-horizontal">
                                       <div class="form-group">
                                            <label class="control-label col-sm-2" for="event_title">Event Title:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="event_title" placeholder="Enter Event Title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="event_desc">Event Description:</label>
                                            <div class="col-sm-10">
                                            <textarea type="text" class="form-control" rows="5" id="event_desc" placeholder="Enter Event Description" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="event_date">Event Date:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="date-picker form-control" id="event_date" placeholder="Enter Event Date" required>
                                            </div>
                                        </div>
                                        <input type="hidden" id="event_id" value="">
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
            <!-- End Edit Event Modal -->
        </div>
    </div>
<?php include ('includes/footer.php');