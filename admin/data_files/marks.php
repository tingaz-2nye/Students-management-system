<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    if(isset($_POST['submit'])){
        $student_id = mysql_prep($_POST['student_id']);
        $class_code = mysql_prep($_POST['class_code']);
        $subject_code = mysql_prep($_POST['subject_code']);
        $exam_id = mysql_prep($_POST['exam_id']);
        $marks = mysql_prep($_POST['marks']);
        $mark_total = mysql_prep($_POST['mark_total']);
        $comments = mysql_prep($_POST['comments']);

        if(!empty($student_id) && !empty($class_code) && !empty($subject_code) && !empty($exam_id) && !empty($marks) && !empty($mark_total) && !empty($comments)){
            $stmt = $db->prepare("INSERT INTO mark (student_id,class_code,subject_code,exam_id,mark,mark_total,comment) VALUES(?,?,?,?,?,?,?)");
            $stmt->bindParam(1,$student_id);
            $stmt->bindParam(2,$class_code);
            $stmt->bindParam(3,$subject_code);
            $stmt->bindParam(4,$exam_id);
            $stmt->bindParam(5,$marks);
            $stmt->bindParam(6,$mark_total);
            $stmt->bindParam(7,$comments);
            $stmt->execute();
        }
    }

?>