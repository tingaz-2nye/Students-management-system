<?php
    require_once('../../config/database.php');
    require_once('../includes/functions.php');

    // Add Student
    if(isset($_POST['addfirst_name']) && isset($_POST['addlast_name']) && isset($_POST['add_age']) 
    && isset($_POST['addstudent_id']) && isset($_POST['add_email']) && isset($_POST['addclass_code']) 
    && isset($_POST['add_gender']) && isset($_POST['add_password']) && isset($_POST['addparent_id'])){
        
        $first_name = mysql_prep($_POST['addfirst_name']);
        $last_name = mysql_prep($_POST['addlast_name']);
        $age = mysql_prep($_POST['add_age']);
        $gender = mysql_prep($_POST['add_gender']);
        $student_id = mysql_prep($_POST['addstudent_id']);
        $email = mysql_prep($_POST['add_email']);
        $class = mysql_prep($_POST['addclass_code']);
        $pass = mysql_prep($_POST['add_password']);
        $parent_id = mysql_prep($_POST['addparent_id']);

        $password = md5($pass);
        $arr = array();

        if(!empty($first_name) && !empty($last_name) && !empty($email)
         && !empty($password) && !empty($parent_id) && !empty($class) && !empty($gender) && !empty($age) && !empty($student_id)){
            try{
                $stmt = $db->prepare("SELECT * FROM student WHERE email=? or student_id =?");
                $stmt->bindParam(1,$email);
                $stmt->bindParam(2,$student_id);
                $stmt->execute();
                $row_count = $stmt->rowCount();

                if($row_count > 0){
                    $arr[1] = 'Student ID or Email already in use';
                }else if($row_count < 1){
                    try{
                        $stmt = $db->prepare("INSERT INTO student(first_name,last_name,age,gender,email,password,student_id,class,parent_id) VALUES(?,?,?,?,?,?,?,?,?)");
                        $stmt->bindParam(1,$first_name);
                        $stmt->bindParam(2,$last_name);
                        $stmt->bindParam(3,$age);
                        $stmt->bindParam(4,$gender);
                        $stmt->bindParam(5,$email);
                        $stmt->bindParam(6,$password);
                        $stmt->bindParam(7,$student_id);
                        $stmt->bindParam(8,$class);
                        $stmt->bindParam(9,$parent_id);
                        $stmt->execute();

                        if($stmt){
                            $arr[0] ='Student registered';
                        }

                    }catch (PDOException $e){
                        $arr[1] = 'Error: '.$e->getMessage();
                    }  
                }
            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
            } 
        }
        echo json_encode($arr);
        exit();
    }

    // Retrive student data
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);

        $arr = array();
        if(!empty($id)){
            $stmt = SimpleSelectWhereID($db,$id,'student');

            while($row = $stmt->fetch()){
                $arr[0] = $row['id'];
                $arr[1] = $row['first_name'];
                $arr[2] = $row['last_name'];
                $arr[3] = $row['gender'];
                $arr[4] = $row['age'];
                $arr[5] = $row['email'];
                $arr[6] = $row['student_id'];
                $arr[7] = $row['class'];
            }
        }
        echo json_encode($arr);
        exit();
    }
    
    // Edit Student
    if(isset($_POST['edit_id']) && isset($_POST['editfirst_name']) && isset($_POST['editlast_name']) 
    && isset($_POST['edit_gender']) && isset($_POST['edit_age']) && isset($_POST['edit_email']) 
    && isset($_POST['editstudent_id']) && isset($_POST['editclass_code'])){
        $id = mysql_prep($_POST['edit_id']);
        $first_name = mysql_prep($_POST['editfirst_name']);
        $last_name = mysql_prep($_POST['editlast_name']);
        $gender = mysql_prep($_POST['edit_gender']);
        $age = mysql_prep($_POST['edit_age']);
        $email = mysql_prep($_POST['edit_email']);
        $student_id = mysql_prep($_POST['editstudent_id']);
        $class = mysql_prep($_POST['editclass_code']);

        $arr = array();

        if(!empty($first_name) && !empty($last_name) && !empty($email)
        && !empty($class) && !empty($gender) && !empty($age) && !empty($student_id)){ 
            try{
                $stmt = $db->prepare("SELECT * FROM student WHERE student_id=? and email=? and id !=?");
                $stmt->bindParam(1,$student_id);
                $stmt->bindParam(2,$email);
                $stmt->bindParam(3,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1]='Student ID or Email are already in use by another user';
                }else if($rowCount < 1){
                    try{
                        $stmt = $db->prepare("UPDATE student SET student_id=?, email=?, first_name=?, last_name=?, gender=?,age=? class? WHERE id=?");
                        $stmt->bindParam(1,$student_id);
                        $stmt->bindParam(2,$email);
                        $stmt->bindParam(3,$first_name);
                        $stmt->bindParam(4,$last_name);
                        $stmt->bindParam(5,$gender);
                        $stmt->bindParam(6,$age);
                        $stmt->bindParam(7,$class);
                        $stmt->bindParam(8,$id);

                        $arr[0]='Student update successful';
                    }catch (PDOException $e){
                        echo 'Error: '.$e->getMessage();
                    }
                }
            }catch (PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Delete Student
    if(isset($_POST['student_data_id'])){
        $id = mysql_prep($_POST['student_data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'student');

                $arr[0] = 'User has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

?>

