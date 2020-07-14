<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    $status = 'Present';

    if(isset($_POST['add_week']) && isset($_POST['add_day']) && isset($_POST['add_student_id']) 
    && isset($_POST['add_status']) && isset($_POST['add_class'])){
        $week = mysql_prep($_POST['add_week']);
        $day = mysql_prep($_POST['add_day']);
        $student_id = mysql_prep($_POST['add_student_id']);
        $status = mysql_prep($_POST['add_status']);
        $class = mysql_prep(strtoupper($_POST['add_class']));

        $arr = array();

        if(!empty($week) && !empty($day) && !empty($student_id) && !empty($status) && !empty($class)){
            try{
                $stmt = $db->prepare("SELECT * FROM attendance WHERE week =? and day=? and student_id =? and status=? and class_code=?");
                $stmt->bindParam(1,$week);
                $stmt->bindParam(2,$day);
                $stmt->bindParam(3,$student_id);
                $stmt->bindParam(4,$status);
                $stmt->bindParam(5,$class);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1]='Student already registered in attendance for today';
                }else if($rowCount < 1){
                    try{
                        $stmt = $db->prepare("INSERT INTO attendance(week,day,student_id,status,class_code) VALUES(?,?,?,?,?)");
                        $stmt->bindParam(1,$week);
                        $stmt->bindParam(2,$day);
                        $stmt->bindParam(3,$student_id);
                        $stmt->bindParam(4,$status);
                        $stmt->bindParam(5,$class);
                        $stmt->execute();

                        $arr[0] ='Student registered successfully';

                    }catch (PDOException $e){
                        $arr[1] ='Error: '.$e->getMessage();
                    }
                }
            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }

    if(isset($_POST['week']) && isset($_POST['day']) && isset($_POST['class'])){
        $week = mysql_prep($_POST['week']);
        $day = mysql_prep($_POST['day']);
        $class = mysql_prep($_POST['class']);
        $arr = array();

        if(!empty($week) && !empty($day) && !empty($class)){
            try{
                $stmt = $db->prepare("SELECT * FROM attendance WHERE week=? and day=? and class_code=?");
                $stmt->bindParam(1,$week);
                $stmt->bindParam(2,$day);
                $stmt->bindParam(3,$class);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    echo  ' <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Day of Week</th>
                                            <th>Student ID</th>
                                            <th>Class</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                    while($row = $stmt->fetch()){
                 ?>
                      <tr>
                        <td><?= $row['week']; ?></td>
                        <td><?= $row['day']; ?></td>
                      <td><?= $row['student_id']; ?></td>
                       <td><?= strtoupper($row['class_code']); ?></td>
                      <td><?= $row['date']; ?></td>
                        <td><span class="label <?= ($row['status']==$status)?'label-success':'label-danger' ; ?>"><?= $row['status']; ?></span></td>
                        </tr>
                 <?php   } 
                 echo '</tbody> ';
                }else if($rowCount < 1){
                    echo '<h3 class="text-muted text-center" >No record found </h3>';
                }

            }catch (PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
        // echo json_encode($arr);
    }

?>