<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');


    $stmt3 = $db->prepare("SELECT * FROM teacher_to_class_and_subject t,subject s where t.subject_id=s.id");
    $stmt3->execute();
    $counter2=1;


        echo'        <table id="dataTable" class="teacherTable1 table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher ID</th>
                                            <th>Class Code</th>
                                            <th>subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     while($row = $stmt3->fetch()){ ?>
                                            <tr>
                                                <td><?= $counter2; ?></td>
                                                <td><?= $row['teacher_id']; ?></td>
                                                <td><?= $row['class_code']; ?></td>
                                                <td><?= $row['subject_name']; ?></td>
                                                <td>
                                                    <button class="deleteAssignedTeacher btn btn-xs btn-danger" data-id="<?= $row['assigned_id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php $counter2=$counter2+1; }
                               echo'     </tbody>
                                </table>';
?>