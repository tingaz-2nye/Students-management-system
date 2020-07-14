<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    // Add Exam
    if(isset($_POST['add_exam_name']) && isset($_POST['add_exam_date']) && isset($_POST['add_exam_comment'])){
        $name = mysql_prep($_POST['add_exam_name']);
        $date = mysql_prep($_POST['add_exam_date']);
        $comment = mysql_prep($_POST['add_exam_comment']);

        $arr = array();

        if(!empty($name) && !empty($date) && !empty($comment)){
            try{
                $stmt = $db->prepare("SELECT * FROM exam WHERE name = ? and date = ? and comment=?");
                $stmt->bindParam(1,$name);
                $stmt->bindParam(2,$date);
                $stmt->bindParam(3,$comment);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1] ='Exam already exists';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO exam(name,date,comment) VALUES(?,?,?)");
                    $stmt->bindParam(1,$name);
                    $stmt->bindParam(2,$date);
                    $stmt->bindParam(3,$comment);
                    $stmt->execute();

                    $arr[0] ='Exam added successfully';
                }
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Retrive exam data
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);

        $arr = array();
        if(!empty($id)){
            $stmt = SimpleSelectWhereID($db,$id,'exam');

            while($row = $stmt->fetch()){
                $arr[0] = $row['id'];
                $arr[1] = $row['name'];
                $arr[2] = $row['date'];
                $arr[3] = $row['comment'];
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit Exam 
    if(isset($_POST['editExam_id']) && isset($_POST['editExam_name']) && isset($_POST['editExam_date']) && isset($_POST['editExam_comment'])){
        
        $id = mysql_prep($_POST['editExam_id']);
        $name = mysql_prep($_POST['editExam_name']);
        $date = mysql_prep($_POST['editExam_date']);
        $comment = mysql_prep($_POST['editExam_comment']);

        $arr = array();

        if(!empty($id) && !empty($name) && !empty($date) && !empty($comment)){
            
            try{
                $stmt = $db->prepare("SELECT * FROM exam WHERE name=? and date=? and comment=? and id != ?");
                $stmt->bindParam(1,$name);
                $stmt->bindParam(2,$date);
                $stmt->bindParam(3,$comment);
                $stmt->bindParam(4,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount < 1){
                    $stmt = $db->prepare("UPDATE exam SET name=?, date=?, comment=? WHERE id=?");
                    $stmt->bindParam(1,$name);
                    $stmt->bindParam(2,$date);
                    $stmt->bindParam(3,$comment);
                    $stmt->bindParam(4,$id);
                    $stmt->execute();

                    $arr[0] = 'Exam update successful';
                }else if($rowCount > 0){
                    $arr[1] = "Exam Already exists";
                }

            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
            }

        }

        echo json_encode($arr);
        exit();
    }

     // Delete Exam
     if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'exam');

                $arr[0] = 'Exam has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }


    // Add Grades
    if(isset($_POST['exam']) && isset($_POST['subject']) && isset($_POST['class']) && isset($_POST['student']) 
    && isset($_POST['grade']) && isset($_POST['total_grade']) && isset($_POST['comment'])){
        $exam = mysql_prep($_POST['exam']);
        $subject = mysql_prep($_POST['subject']);
        $class = mysql_prep($_POST['class']);
        $student = mysql_prep($_POST['student']);
        $grade = mysql_prep($_POST['grade']);
        $totalGrade = mysql_prep($_POST['total_grade']);
        $comment = mysql_prep($_POST['comment']);

        $arr = array();

        if(!empty($exam) && !empty($subject) && !empty($class) && !empty($student) && !empty($grade) && !empty($totalGrade) && !empty($comment)){
            try{
                $stmt = $db->prepare("SELECT * FROM mark where exam_id = ? and subject_code=? and class_code=? and student_id= ?");
                $stmt->bindParam(1,$exam);
                $stmt->bindParam(2,$subject);
                $stmt->bindParam(3,$class);
                $stmt->bindParam(4,$student);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1] = 'Grade for Student, Subject and Exam already exist';
                }else if ($rowCount < 1 ){
                    $stmt = $db->prepare("INSERT INTO mark(exam_id,subject_code,class_code,student_id,mark,total_mark,comment) VALUES(?,?,?,?,?,?,?)");
                    $stmt->bindParam(1,$exam);
                    $stmt->bindParam(2,$subject);
                    $stmt->bindParam(3,$class);
                    $stmt->bindParam(4,$student);
                    $stmt->bindParam(5,$grade);
                    $stmt->bindParam(6,$totalGrade);
                    $stmt->bindParam(7,$comment);
                    $stmt->execute();

                    $arr[0]='Grades insertion was successful';
                }

            }catch(PDOException $e){
                $arr[1]='Error: '.$e->getMessage();
            }
        }
        echo json_encode($arr);
    }


    // Retrive grade data
    if(isset($_POST['retrive_grade_id'])){
        $id = mysql_prep($_POST['retrive_grade_id']);

        $arr = array();
        if(!empty($id)){
            $stmt = $db->prepare("SELECT * FROM mark WHERE mark_id=?");
            $stmt->bindParam(1,$id);
            $stmt->execute();

            while($row = $stmt->fetch()){
                $arr[0] = $row['mark_id'];
                $arr[1] = $row['student_id'];
                $arr[2] = $row['subject_code'];
                $arr[3] = $row['class_code'];
                $arr[4] = $row['mark'];
                $arr[5] = $row['total_mark'];
                $arr[6] = $row['comment'];
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit Grade
    if(isset($_POST['grade_id']) && isset($_POST['stud_id']) && isset($_POST['sub_code']) && isset($_POST['class_code'])
     && isset($_POST['grade']) && isset($_POST['total']) && isset($_POST['grade_com'])){
        
        $id = mysql_prep($_POST['grade_id']);
        $stud_id = mysql_prep($_POST['stud_id']);
        $sub_code = mysql_prep($_POST['sub_code']);
        $class = mysql_prep($_POST['class_code']);
        $grade = mysql_prep($_POST['grade']);
        $total = mysql_prep($_POST['total']);
        $comment = mysql_prep($_POST['grade_com']);

        $arr = array();

        if(!empty($id) && !empty($stud_id) && !empty($sub_code) && !empty($class) && !empty($grade) && !empty($total) && !empty($comment)){
            try{
                $stmt = $db->prepare("SELECT * FROM mark WHERE subject_code=? and class_code=? and student_id=? and mark_id!= ?");
                $stmt->bindParam(1,$sub_code);
                $stmt->bindParam(2,$class);
                $stmt->bindParam(3,$stud_id);
                $stmt->bindParam(4,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();


                if($rowCount < 1){
                    $stmt = $db->prepare("UPDATE mark SET subject_code=?, class_code=?, student_id=?, mark=?, total_mark=?, comment=? WHERE mark_id=?");
                    $stmt->bindParam(1,$sub_code);
                    $stmt->bindParam(2,$class);
                    $stmt->bindParam(3,$stud_id);
                    $stmt->bindParam(4,$grade);
                    $stmt->bindParam(5,$total);
                    $stmt->bindParam(6,$comment);
                    $stmt->bindParam(7,$id);
                    $stmt->execute();

                    $arr[0] = 'Grade Update was successful';
                }else if($rowCount > 0){
                    $arr[1] = "Grade of this student already exists";
                }

            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
    }

    // Delete Exam
    if(isset($_POST['delete_grade_id'])){
        $id = mysql_prep($_POST['delete_grade_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = $db->prepare("DELETE FROM mark WHERE mark_id =?");
                $stmt->execute();

                $arr[0] = 'Grade successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

?>