<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');


    // add timetable 
    if(isset($_POST['add_day']) && isset($_POST['add_class_code']) && isset($_POST['add_subject_code']) && isset($_POST['add_time_start']) && isset($_POST['add_time_end'])){

        $day = $_POST['add_day'];
        $class_code = $_POST['add_class_code'];
        $subject_code = $_POST['add_subject_code'];
        $time_start = $_POST['add_time_start'];
        $time_end = $_POST['add_time_end'];

        $arr = array();

        if(!empty($day) && !empty($class_code) && !empty($subject_code) && !empty($time_start) && !empty($time_end)){
            try{
                $stmt = $db->prepare("INSERT INTO timetable(day,class_code,subject_code,time_start,time_end) values(?,?,?,?,?)");
                $stmt->bindParam(1,$day);
                $stmt->bindParam(2,$class_code);
                $stmt->bindParam(3,$subject_code);
                $stmt->bindParam(4,$time_start);
                $stmt->bindParam(5,$time_end);
                $stmt->execute();

                $arr[0]= 'Added Successfully';
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

    // retrive timetable data
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);
        $arr = array();

        if(!empty($id)){
            try{
                $stmt = SimpleSelectWhereID($db,$id,'timetable');

                while($row = $stmt->fetch()){
                    $arr[0] = $row['id'];
                    $arr[1] = $row['day'];
                    $arr[2] = $row['class_code'];
                    $arr[3] = $row['subject_code'];
                    $arr[4] = $row['time_start'];
                    $arr[5] = $row['time_end'];
                }
            }catch (PDOException $e){
                $arr[6] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

    // edit timetable
    if(isset($_POST['timetable_id']) && isset($_POST['edit_day']) && isset($_POST['edit_class_code']) && isset($_POST['edit_subject_code']) && isset($_POST['edit_start_time']) && isset($_POST['edit_end_time'])){
                
        $id = $_POST['timetable_id'];
        $day = $_POST['edit_day'];
        $class_code = $_POST['edit_class_code'];
        $subject_code = $_POST['edit_subject_code'];
        $time_start = $_POST['edit_start_time'];
        $time_end = $_POST['edit_end_time'];

        

        if(!empty($id) && !empty($day) && !empty($class_code) && !empty($subject_code) && !empty($time_start) && !empty($time_end)){
            
            try{
                $stmt = $db->prepare("UPDATE timetable set day=?, class_code=?, subject_code=?, time_start=?, time_end=? WHERE id=?");
                $stmt->bindParam(1,$day);
                $stmt->bindParam(2,$class_code);
                $stmt->bindParam(3,$subject_code);
                $stmt->bindParam(4,$time_start);
                $stmt->bindParam(5,$time_end);
                $stmt->bindParam(6,$id);
                $stmt->execute();

                $arr[0] = 'Timetable update successful ';
                

            }catch (PDOException $e){
                $arr[1]= 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

    // delete from timetable
    if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);
        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'timetable');
                $arr[0] = "Deleted successfully";
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }


?>
