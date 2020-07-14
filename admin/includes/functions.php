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
    
    function teacher_login(){
        if(isset($_SESSION['teacher_session_id']) && isset($_SESSION['teacher_id']) && !empty($_SESSION['teacher_session_id']) && !empty($_SESSION['teacher_id'])){
            return true;
        }else{
            return false;
        }
    }

    function admin_login(){
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])){
            return true;
        }else{
            return false;
        }
    }

    function getadminfield($db,$field){
        $id = $_SESSION['admin_id'];
        $stmt = $db->prepare("select * from admin where id=?");
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $row = $stmt->fetch();
        $output = $row["{$field}"];

        return $output;

    }

    function getTeacherfield($db,$field){

        $id = $_SESSION['teacher_session_id'];
        $stmt = $db->prepare("select * from teacher where id=?");
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $row = $stmt->fetch();
        $output = $row["{$field}"];

        return $output;

    }
    
    function update_onlineStatus($db,$table,$status,$id){
        $stmt =$db->prepare("UPDATE $table set online_status=? and id=?");
        $stmt->bindParam(1,$status);
        $stmt->bindParam(2,$id);
        $stmt->execute();

        return $stmt;
    }

    function simpleSelect($db , $table){
        $stmt=$db->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt;
    }
    function simpleWhereSelect($db,$table){
        $status = 1;
        $stmt = $db->prepare("SELECT * FROM $table WHERE online_status= ?");
        $stmt->bindParam(1,$status);
        $stmt->execute();

        return $stmt;
    }
    function SimpleSelectWhereID($db,$id,$table){
        $stmt = $db->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->bindParam(1,$id);
        $stmt->execute();

        return $stmt;
    }
    function simpleDelete($db,$id,$table){
        $stmt = $db->prepare("DELETE FROM $table WHERE id=?");
        $stmt->bindParam(1,$id);
        $stmt->execute();

        return $stmt;
    }

?>