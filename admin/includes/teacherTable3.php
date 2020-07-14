<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');
        
 $counter2=1;
 $stmt5 = simpleSelect($db,'teacher_assigned_to_student'); 

   echo'<thead>
            <tr>
                <th>#</th>
                <th>Teacher ID</th>
                <th>Student ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
            while($row = $stmt5->fetch()){ ?>
                <tr>
                    <td><?= $counter2; ?></td>
                    <td><?= $row['teacher_id']; ?></td>
                    <td><?= $row['student_id']; ?></td>
                    <td>
                        <button class="deleteTutor btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
            <?php $counter2=$counter2+1; }
      echo'  </tbody>';
?>