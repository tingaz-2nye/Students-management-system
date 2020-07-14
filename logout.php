<?php 
    require_once ('config/database.php');
    require_once ('includes/functions.php');

    if(student_login()){
        $status = 0;
        $id = $_SESSION['student_id'];
        $stmt = update_onlineStatus($db,'student',$status,$id);
        
        session_destroy();

        redirect_to('login.php');    
        
    }else if(parent_login()){
        $status = 0;
        $id = $_SESSION['parent_id'];
        $stmt = update_onlineStatus($db,'parent',$status,$id);
    
        session_destroy();

        redirect_to('login.php');
    }

    
?>