<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');

    $stmt = $db->prepare("SELECT * FROM class");
    $stmt->execute();
    $counter = 1;

    echo   '<table id="dataTable" class="classTable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Class Name</th>
                            <th>Class Level</th>
                            <th>Class Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        while($row = $stmt->fetch()){ ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td><?= $row['class_name']; ?></td>
                                <td><?= $row['class_level']; ?></td>
                                <td><?= $row['class_code']; ?></td>
                                <td>
                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editclass">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="deleteClass btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php $counter=$counter+1; } 
                  echo'  </tbody>
                </table>';
?>