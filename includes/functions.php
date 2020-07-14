<?php
    ob_start();
    session_start();


    function mysql_prep( $value ) {
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
        if( $new_enough_php ) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if( $magic_quotes_active ) { $value = stripslashes( $value ); }
            $value = mysql_real_escape_string( $value );
        } else { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if( !$magic_quotes_active ) { $value = addslashes( $value ); }
            // if magic quotes are active, then the slashes already exist
        }
        return $value;
    }

    function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
    } 
    
    function student_login(){
        if(isset($_SESSION['stud_session_id'])){
            return true;
        }else{
            return false;
        }
    }

    function parent_login(){
        if(isset($_SESSION['parent_id'])){
            return true;
        }else{
            return false;
        }
    }

    function getStudentField($db,$field){
        $id = $_SESSION['stud_session_id'];
        $stmt = $db->prepare("select * from student where id=?");
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $row = $stmt->fetch();
        $output = $row["{$field}"];

        return $output;

    }

    function getParentField($db,$field){
        $id = $_SESSION['parent_id'];
        $stmt = $db->prepare("select * from parent where id=?");
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $row = $stmt->fetch();
        $output = $row["{$field}"];

        return $output;

    }

    function simpleSelect($db , $table){
        $stmt=$db->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt;
    }

    function update_onlineStatus($db,$table,$status,$id){
        $stmt =$db->prepare("UPDATE $table set online_status=? and id=?");
        $stmt->bindParam(1,$status);
        $stmt->bindParam(2,$id);
        $stmt->execute();

        return $stmt;
    }

    function weekAttendance($db,$week,$id){
        $status = 'Present';
        $stmt = $db->prepare("SELECT * FROM attendance WHERE week = ? and student_id = ? and status=?");
        $stmt->bindParam(1,$week);
        $stmt->bindParam(2,$id);
        $stmt->bindParam(3,$status);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $percentage = round(($rowCount / 5) * 100);

        return $percentage; 
    }
    function overallAttendance($db,$id){
        $status = 'Present';
        $stmt = $db->prepare("SELECT * FROM attendance WHERE student_id = ? and status=?");
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$status);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $percentage = round(($rowCount / 60) * 100);

        return $percentage;
    }

    function parentWeekAttendance($db,$week,$id){
        $status = 'Present';
        $stmt = $db->prepare("SELECT a.student_id FROM student s, attendance a WHERE s.student_id = a.student_id and a.week=? and a.status=? and s.parent_id = ? ");
        $stmt->bindParam(1,$week);
        $stmt->bindParam(2,$status);
        $stmt->bindParam(3,$id);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $percentage = round(($rowCount / 5) * 100);

        return $percentage;

    }

    function parentOverallAttendance($db,$id){
        $status = 'Present';
        $stmt = $db->prepare("SELECT a.student_id FROM student s, attendance a WHERE s.student_id = a.student_id and s.parent_id = ? and a.status=?");
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$status);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $percentage = round(($rowCount / 60) * 100);

        return $percentage;
    }


    function get_posts($db){
		$stmt = $db->prepare("SELECT * FROM post");
		if($stmt->execute()){
			return $stmt; 
		}
	}
	function get_replys($db,$field){
		$stmt =$db->prepare("SELECT * FROM post_reply WHERE post_id='$field'");
		$stmt->execute();
		if($stmt){	
           return $stmt;

		}
    }
    
    function studentAverageMarks($db){
        $stmt = $db->prepare("SELECT AVG(mark) AS avgMark FROM mark WHERE student_id=?");
        $stmt->bindParam(1,$_SESSION['student_id']);
        $stmt->execute();

        return $stmt;

    }

    function parentAverageMarks($db){
        $stmt = $db->prepare("SELECT AVG(m.mark) AS avgMark FROM mark m, student s WHERE s.student_id= m.student_id and s.parent_id=?");
        $stmt->bindParam(1,$_SESSION['parent_id']);
        $stmt->execute();

        return $stmt;
    }

    function SimpleSelectWhereID($db,$id,$table){
        $stmt = $db->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->bindParam(1,$id);
        $stmt->execute();

        return $stmt;
    }

?>