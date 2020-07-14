<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');

    $stmt = $db->prepare("SELECT * FROM parent");
    $stmt->execute();
    $count = 1;

                             
                             echo'<table id="dataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> ';
                                    while($row = $stmt->fetch()){ ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                            <td><?= $row['first_name'] ?></td>
                                            <td><?= $row['last_name'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#editparent">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-xs btn-success" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#emailparent">
                                                    <i class="fa fa-envelope"></i>
                                                </button>
                                                <button class="deleteParent btn btn-xs btn-danger" data-id="<?= $row['id'] ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                       <?php $count = $count +1; } 
                             echo  '    </tbody>
                                </table>';
?>