<?php
    require_once ('../../config/database.php');
    require_once ('functions.php');

    $counter= 1;
    $stmt = simpleSelect($db,'student');    
    echo'<thead>
        <tr>
            <th>#</th>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
        while($row = $stmt->fetch()){ ?>
            <tr>
                <td><?= $counter ?></td>
                <td><?= $row['student_id']; ?></td>
                <td><?= $row['first_name']; ?></td>
                <td><?= $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['class']; ?></td>
                <td>
                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editstudent">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="deleteStudent btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        <?php $counter=$counter+1; } 
   echo' </tbody>;'
?>