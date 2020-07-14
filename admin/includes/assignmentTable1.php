<?php
    require_once ('../../config/database.php');
    require_once ('functions.php');
    
    $counter=1;
    $stmt=simpleSelect($db,'assignments');
    
 echo'<thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Class</th>
            <th>Date and Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
        while($row = $stmt->fetch()){?>
        <tr>
            <td><?= $counter; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['description']; ?></td>
            <td><?= $row['class_code']; ?></td>
            <td><?= $row['post_time']; ?></td>
            <td>
                
                
                <a class="btn btn-xs btn-success" style="width:60px;" href="../<?= $row['file_path']; ?>" download="<?= $row['title']; ?>">
                    <i class="fa fa-download"></i>
                </a>
                
                
                <button class="deleteAssign btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                    <i class="fa fa-trash-o"></i>
                </button>
                
            </td>
        </tr>
        <?php $counter = $counter+1; } 
  echo' </tbody>';
?>