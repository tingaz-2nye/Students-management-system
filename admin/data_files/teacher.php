<?php 
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    // Assign Teacher to Class and Subject
    if(isset($_POST['assign_teacher_id']) && isset($_POST['assign_class_code']) && isset($_POST['assign_subject_id'])){
        $teacher = $_POST['assign_teacher_id'];
        $class = $_POST['assign_class_code'];
        $subject = $_POST['assign_subject_id'];

        $arr = array();

        if(!empty($teacher) && !empty($class) && !empty($subject)){
            try{
                $stmt = $db->prepare("SELECT * FROM teacher_to_class_and_subject WHERE teacher_id=? and class_code=? and subject_id=? or (class_code=? and subject_id=? and teacher_id!=? ) ");
                $stmt->bindParam(1,$teacher);
                $stmt->bindParam(2,$class);
                $stmt->bindParam(3,$subject);
                $stmt->bindParam(4,$class);
                $stmt->bindParam(5,$subject);
                $stmt->bindParam(6,$teacher);
                $stmt->execute();
                $rowCount = $stmt->rowCount();
                if($rowCount > 0){
                    $arr[1] = 'Teacher Already assigned to class and subject';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO  teacher_to_class_and_subject(teacher_id,class_code,subject_id) values(?,?,?)");
                    $stmt->bindParam(1,$teacher);
                    $stmt->bindParam(2,$class);
                    $stmt->bindParam(3,$subject);
                    $stmt->execute();

                    $arr[0] = 'Teacher assigned to class and subject';
                }

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }



    //Delete Assigned Teacher
    if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = $db->prepare("DELETE FROM teacher_to_class_and_subject WHERE assigned_id=?");
                $stmt->bindParam(1,$id);
                $stmt->execute();

                $arr[0] = 'Teacher has been successfully Removed from Class and Subject';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

    // Assign Teacher to Student
    if(isset($_POST['tutor_id']) && isset($_POST['student_id'])){
        $teacher_id = mysql_prep($_POST['tutor_id']);
        $student_id = mysql_prep($_POST['student_id']);
        

        $arr = array();

        if(!empty($teacher_id) && !empty($student_id)){
            try{
                $stmt = $db->prepare("SELECT * FROM teacher_assigned_to_student WHERE teacher_id=? and student_id=?");
                $stmt->bindParam(1,$teacher_id);
                $stmt->bindParam(2,$student_id);
            
                $stmt->execute();
                $rowCount = $stmt->rowCount();
                if($rowCount > 0){
                    $arr[1] = 'Teacher Already assigned to Student';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO  teacher_assigned_to_student(teacher_id,student_id) values(?,?)");
                    $stmt->bindParam(1,$teacher_id);
                    $stmt->bindParam(2,$student_id);
                    $stmt->execute();

                    $arr[0] = 'Teacher assigned to Student';
                }

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }


    //Delete Tutor
    if(isset($_POST['tutor_data_id'])){
        $id = mysql_prep($_POST['tutor_data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = $db->prepare("DELETE FROM teacher_assigned_to_student WHERE id=?");
                $stmt->bindParam(1,$id);
                $stmt->execute();

                $arr[0] = 'Teacher has been successfully Removed as Student Tutor';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }
    // Add New Teacher
    if(isset($_POST['add_teacher_id']) && isset($_POST['add_first_name']) && isset($_POST['add_last_name']) && 
    isset($_POST['add_email']) && isset($_POST['add_password'])){

        $teacher_id = mysql_prep($_POST['add_teacher_id']);
        $first_name = mysql_prep($_POST['add_first_name']);
        $last_name = mysql_prep($_POST['add_last_name']);
        $email = mysql_prep($_POST['add_email']);
        $pass = mysql_prep($_POST['add_password']);

        $password = md5($pass);
        $arr = array();

        if(!empty($teacher_id) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)){
            try{
                $stmt = $db->prepare("SELECT * FROM teacher WHERE teacher_id = ? or email=?");
                $stmt->bindParam(1,$teacher_id);
                $stmt->bindParam(2,$email);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1] = 'Teachers ID or Email already exists';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO teacher(teacher_id,first_name,last_name,email,password) VALUES(?,?,?,?,?)");
                    $stmt->bindParam(1,$teacher_id);
                    $stmt->bindParam(2,$first_name);
                    $stmt->bindParam(3,$last_name);
                    $stmt->bindParam(4,$email);
                    $stmt->bindParam(5,$password);
                    $stmt->execute();

                    $arr[0] = 'Teacher added successfully';
                }
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
    }

    // Retrive teacher data
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);

        $arr = array();
        if(!empty($id)){

            $stmt = SimpleSelectWhereID($db,$id,'teacher');

            while($row = $stmt->fetch()){
                $arr[0] = $row['teacher_id'];
                $arr[1] = $row['first_name'];
                $arr[2] = $row['last_name'];
                $arr[3] = $row['email'];
                $arr[4] = $row['id'];
                
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit Teacher
    if(isset($_POST['editPrimary_id']) && isset($_POST['editTeacher_id']) && isset($_POST['editFirst_name']) && isset($_POST['editLast_name']) && isset($_POST['editEmail'])){
        $id = mysql_prep($_POST['editPrimary_id']);
        $teacher_id = mysql_prep($_POST['editTeacher_id']);
        $first_name = mysql_prep($_POST['editFirst_name']);
        $last_name = mysql_prep($_POST['editLast_name']);
        $email = mysql_prep($_POST['editEmail']);

        $arr = array();
        if(!empty($id) && !empty($teacher_id) && !empty($first_name) && !empty($last_name) && !empty($email)){
            try{
                $stmt = $db->prepare("SELECT * FROM teacher WHERE teacher_id=? and email=? and id !=?");
                $stmt->bindParam(1,$teacher_id);
                $stmt->bindParam(2,$email);
                $stmt->bindParam(3,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1]='Teacher ID or Email are already in use by another user';
                }else if($rowCount < 1){
                    try{
                        $stmt = $db->prepare("UPDATE teacher SET teacher_id=?, email=?, first_name=?, last_name=? WHERE id=?");
                        $stmt->bindParam(1,$teacher_id);
                        $stmt->bindParam(2,$email);
                        $stmt->bindParam(3,$first_name);
                        $stmt->bindParam(4,$last_name);
                        $stmt->bindParam(5,$id);

                        $arr[0]='Teacher update successful';

                    }catch (PDOException $e){
                        $arr[1]= 'Error: '.$e->getMessage();
                    }
                }

            }catch (PDOException $e){
                $arr[1]='Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }


    // Delete Teacher
    if(isset($_POST['teacher_data_id'])){
        $id = mysql_prep($_POST['teacher_data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'teacher');

                $arr[0] = 'User has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

    // Email parent
    if(isset($_POST['email_email']) && isset($_POST['email_subject']) && isset($_POST['email_message'])){
    
        $email = mysql_prep($_POST['email_email']);
        $subject = mysql_prep($_POST['email_subject']);
        $message = mysql_prep($_POST['email_message']);
        $name = 'Admin';

        $school_email = 'school_email()';
        $arr = array();

        if(!empty($message) && !empty($email) && !empty($subject)){

            $EmailTo = $email;
            $Newsubject = "New Message Recieved From ";

            $Body="Subject: ";
            $Body.=$subject;
            $Body.="\n";
            $Body.="Name: ";
            $Body.=$name;
            $Body.="\n";
            $Body.="Email: ";
            $Body.=$email;
            $Body.="\n";
            $Body.="Message: ";
            $Body.=$message;
            $Body.="\n";

            $success = mail($EmailTo, $Newsubject, $Body, "From:".$school_email);

            if($success){
                $arr[0] = 'Email sent successfully';
            }else{
                $arr[1] = 'An Error occurred please try again';
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Assign Teacher to Student
    if(isset($_POST['teacher_id']) && isset($_POST['student_id']) ){
        $teacher_id = mysql_prep($_POST['teacher_id']);
        $student_id = mysql_prep($_POST['student_id']);

        $arr = array();

        if(!empty($student_id) && !empty($teacher_id)){
            try{
            $stmt4 = $db->prepare("iNSERT INTO teacher_to_student(,teacher_id,student_id) values(?,?)");
            $stmt4->bindParam(2,$teacher_id);
            $stmt4->bindParam(3,$student_id);
            $stmt4->execute();

            $arr[0] = ' Teacher Assigned to Student Successfully';

            }catch (PDOException $e){
                $arr[0] = 'Error: '.$e;
            }
        }



    }

?>