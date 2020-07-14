<?php 
    
    require_once ('../config/database.php');
    require_once ('includes/functions.php');

    if(teacher_login()){
        $status = 0;
        $id = $_SESSION['teacher_id'];
        $stmt = update_onlineStatus($db,'teacher',$status,$id);
        
        session_destroy();

        redirect_to('login.php');    
        
    }else{
        session_destroy();

        redirect_to('login.php');
    }

    
?>