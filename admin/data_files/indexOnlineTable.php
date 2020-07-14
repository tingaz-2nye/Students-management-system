<?php 
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');


    $status= 1;
    $stmt = $db->prepare('SELECT * FROM teacher');
    $stmt->execute();

    while($row = $stmt->fetch()){ ?>

    <li class="list-group-item"><?=$row['first_name'].' '.$row['last_name']; ?>
    <span class=<?= ($row['online_status']==$status)?'"pull-right label label-success">online':'"pull-right label label-danger">Offline'; ?></span></li>

  <?php  } 

        

?>