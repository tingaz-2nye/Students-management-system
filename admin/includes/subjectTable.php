<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');

    $stmt = $db->prepare("SELECT * FROM subject");
    $stmt->execute();
    $counter = 1;

    echo '<table id="dataTable" class="subjectTable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject Name</th>
                                            <th>Subject Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        while($row = $stmt->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter; ?></td>
                                                <td><?= $row['subject_name']; ?></td>
                                                <td><?= $row['subject_code']; ?></td>
                                                <td>
                                                    <button class="btn btn-xs btn-info" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#editsubject">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="deleteSubject btn btn-xs btn-danger" data-id="<?= $row['id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $counter=$counter+1; } 
                                   echo' </tbody>
                                </table>';

?>