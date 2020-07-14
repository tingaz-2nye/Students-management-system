<?php 

require_once ('../../config/database.php');
require_once ('functions.php');

    $stmt = $db->prepare("SELECT * FROM noticeboard");
    $stmt->execute();
    $count = 1;

  echo'  
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
<tbody id="eventTable_body">';
 
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
                <button class="deleteEvent btn btn-xs btn-danger" id="" data-id="<?= $row['id']; ?>" >
                    <i class="fa fa-trash-o"></i>
                </button>
            </td>
        </tr>
    <?php $count = $count+1; } 
echo '</tbody>

</table>';
?>
                                   