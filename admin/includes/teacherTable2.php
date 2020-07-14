<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');

    $counter = 1;
    $stmt = simpleSelect($db,'teacher');

    echo'<table id="dataTable2" class="teacherTable2 table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Teacher ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    while($row = $stmt->fetch()){ ?>
            <tr>
                <td><?= $counter; ?></td>
                <td><?= $row['teacher_id']; ?></td>
                <td><?= $row['first_name']; ?></td>
                <td><?= $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editTeacher">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-xs btn-success" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#emailteacher">
                        <i class="fa fa-envelope"></i>
                    </button>
                    <button class="deleteTeacher btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        <?php $counter=$counter+1; } 
   echo' </tbody>
</table>';

?>