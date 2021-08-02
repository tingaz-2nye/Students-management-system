<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    if(isset($_POST['add_class_name']) && isset($_POST['add_class_level']) && isset($_POST['add_class_code'])){
        $class_name = $_POST['add_class_name'];
        $class_level = $_POST['add_class_level'];
        $class_code = $_POST['add_class_code'];

        $arr = array();

        if(!empty($class_name) && !empty($class_level) && !empty($class_code)){
            try{
                $stmt = $db->prepare("SELECT * FROM class WHERE class_name = ? and class_level = ? and class_code=?");
                $stmt->bindParam(1,$class_name);
                $stmt->bindParam(2,$class_level);
                $stmt->bindParam(3,$class_code);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1] ='Class already exists';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO class(class_name,class_level,class_code) VALUES(?,?,?)");
                    $stmt->bindParam(1,$class_name);
                    $stmt->bindParam(2,$class_level);
                    $stmt->bindParam(3,$class_code);
                    $stmt->execute();

                    $arr[0] ='Class added successfully';
                }
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Retrive parent data
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);

        $arr = array();
        if(!empty($id)){
            $stmt = SimpleSelectWhereID($db,$id,'class');

            while($row = $stmt->fetch()){
                $arr[0] = $row['id'];
                $arr[1] = $row['class_name'];
                $arr[2] = $row['class_level'];
                $arr[3] = $row['class_code'];
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit class 
    if(isset($_POST['editClass_name']) && isset($_POST['editClass_level']) && isset($_POST['editClass_code']) && isset($_POST['editClass_id'])){
        
        $id = mysql_prep($_POST['editClass_id']);
        $class_name = mysql_prep($_POST['editClass_name']);
        $class_level = mysql_prep($_POST['editClass_level']);
        $class_code = mysql_prep($_POST['editClass_code']);

        $arr = array();

        if(!empty($id) && !empty($class_name) && !empty($class_level) && !empty($class_code)){
            
            try{
                $stmt = $db->prepare("SELECT * FROM class WHERE class_name=? and class_level=? and class_code=? and id != ?");
                $stmt->bindParam(1,$class_name);
                $stmt->bindParam(2,$class_level);
                $stmt->bindParam(3,$class_code);
                $stmt->bindParam(4,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount < 1){
                    $stmt = $db->prepare("UPDATE class SET class_name=?, class_level=?, class_code=? WHERE id=?");
                    $stmt->bindParam(1,$class_name);
                    $stmt->bindParam(2,$class_level);
                    $stmt->bindParam(3,$class_code);
                    $stmt->bindParam(4,$id);
                    $stmt->execute();

                    $arr[0] = 'Class update successful';
                }else if($rowCount > 0){
                    $arr[1] = "Class Already exists";
                }

            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
            }

        }

        echo json_encode($arr);
        exit();
    }

     // Delete Class
     if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'class');

                $arr[0] = 'Class has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

?>