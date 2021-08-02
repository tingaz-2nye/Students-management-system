<?php 

        require_once ('../config/database.php');
        require_once ('../includes/functions.php');


    
    // Retrive teacher data
    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $arr = array();
        if(!empty($id)){

            $stmt = SimpleSelectWhereID($db,$id,'teacher');

            while($row = $stmt->fetch()){
                $arr[0] = $row['email'];                
            }
        }
        echo json_encode($arr);
        exit();
    }
    
    
    // Email teacher
    if(isset($_POST['email_email']) && isset($_POST['email_subject']) && isset($_POST['email_message'])){
        
        $email = $_POST['email_email'];
        $subject = $_POST['email_subject'];
        $message = $_POST['email_message'];
        

        

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



?>