<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    // Add Subject
    if(isset($_POST['add_subject_name']) && isset($_POST['add_subject_code'])){
        $subject_name = $_POST['add_subject_name'];
        $subject_code = $_POST['add_subject_code'];

        $arr = array();

        if(!empty($subject_name) && !empty($subject_code)){
            try{
                $stmt = $db->prepare("SELECT * FROM class WHERE subject_name = ? and subject_code=?");
                $stmt->bindParam(1,$class_name);
                $stmt->bindParam(2,$class_code);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1] ='Subject already exists';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO subject(subject_name,subject_code) VALUES(?,?)");
                    $stmt->bindParam(1,$subject_name);
                    $stmt->bindParam(2,$subject_code);
                    $stmt->execute();

                    $arr[0] ='Subjct added successfully';
                }
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Retrive subject data
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);

        $arr = array();
        if(!empty($id)){
            $stmt = SimpleSelectWhereID($db,$id,'subject');

            while($row = $stmt->fetch()){
                $arr[0] = $row['id'];
                $arr[1] = $row['subject_name'];
                $arr[2] = $row['subject_code'];
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit Subject 
    if(isset($_POST['editSubject_name']) && isset($_POST['editSubject_code']) && isset($_POST['editSubject_id'])){
        
        $id = mysql_prep($_POST['editSubject_id']);
        $subject_name = mysql_prep($_POST['editSubject_name']);
        $subject_code = mysql_prep($_POST['editSubject_code']);

        $arr = array();

        if(!empty($id) && !empty($subject_name) && !empty($subject_code)){
            
            try{
                $stmt = $db->prepare("SELECT * FROM subject WHERE subject_name=? and subject_code=? and id != ?");
                $stmt->bindParam(1,$subject_name);
                $stmt->bindParam(2,$subject_code);
                $stmt->bindParam(3,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount < 1){
                    $stmt = $db->prepare("UPDATE subject SET subject_name=?, subject_code=? WHERE id=?");
                    $stmt->bindParam(1,$subject_name);
                    $stmt->bindParam(2,$subject_code);
                    $stmt->bindParam(3,$id);
                    $stmt->execute();

                    $arr[0] = 'Subject update successful';
                }else if($rowCount > 0){
                    $arr[1] = "Subject Already exists";
                }

            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
            }

        }

        echo json_encode($arr);
        exit();
    }

     // Delete Subject
     if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = $db->prepare("DELETE FROM subject WHERE id=?");
                $stmt->bindParam(1,$id);
                $stmt->execute();

                $arr[0] = 'Subject has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

?>