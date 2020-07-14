<?php
    require_once ('../../config/database.php');
    require_once ('functions.php');
    
    $counter2=1;
    $stmt2=simpleSelect($db,'student_assignments');

 echo' <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Class</th>
            <th>Student ID</th>
            <th>Date and Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
        while($row = $stmt2->fetch()){?>
        <tr>
            <td><?= $counter2; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['description']; ?></td>
            <td><?= $row['class_code']; ?></td>
            <td><?= $row['student_id']; ?></td>
            <td><?= $row['post_time']; ?></td>
            <td>
                
                
                <a class="btn btn-xs btn-success" style="width:60px;" href="../<?= $row['file_path']; ?>" download="<?= $row['title']; ?>">
                    <i class="fa fa-download"></i>
                </a>
                
                
                <button class="deleteStudentAssign btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                    <i class="fa fa-trash-o"></i>
                </button>
                
            </td>
        </tr>
        <?php $counter2 = $counter2+1; } 
  echo' </tbody>';
?>