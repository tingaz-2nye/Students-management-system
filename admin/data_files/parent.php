<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    // Register Parent 
    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])){
        $email = mysql_prep($_POST['email']);
        $pass = mysql_prep($_POST['password']);
        $first_name = mysql_prep($_POST['first_name']);
        $last_name = mysql_prep($_POST['last_name']);

        $password = md5($pass);

        $arr = array();

        if(!empty($email) && !empty($password) && !empty($first_name) && !empty($last_name)){
            try{
                $stmt = $db->prepare("SELECT * FROM parent WHERE email= ?");
                $stmt->bindParam(1,$email);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount > 0){
                    $arr[1] = ' User Email already in use';
                }else if($rowCount < 1){
                    $stmt = $db->prepare("INSERT INTO parent(email,password,first_name,last_name) VALUES(?,?,?,?)");
                    $stmt->bindParam(1,$email);
                    $stmt->bindParam(2,$password);
                    $stmt->bindParam(3,$first_name);
                    $stmt->bindParam(4,$last_name);
                    $stmt->execute();

                    $arr[0] = 'User registered successfully';
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
            $stmt = SimpleSelectWhereID($db,$id,'parent');

            while($row = $stmt->fetch()){
                $arr[0] = $row['id'];
                $arr[1] = $row['first_name'];
                $arr[2] = $row['last_name'];
                $arr[3] = $row['email'];
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit parents details
    if(isset($_POST['editParent_id']) && isset($_POST['editFirstname']) && isset($_POST['editLastname']) && isset($_POST['editEmail'])){
        $id = mysql_prep($_POST['editParent_id']);
        $first_name = mysql_prep($_POST['editFirstname']);
        $last_name = mysql_prep($_POST['editLastname']);
        $email = mysql_prep($_POST['editEmail']);

        $arr = array();

        if(!empty($id) && !empty($first_name) && !empty($last_name) && !empty($email)){
            try{
                $stmt = $db->prepare("SELECT * FROM parent WHERE email=? and id != ?");
                $stmt->bindParam(1,$email);
                $stmt->bindParam(2,$id);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if($rowCount < 1){
                    $stmt = $db->prepare("UPDATE parent SET first_name=?, last_name=?, email=? WHERE id=?");
                    $stmt->bindParam(1,$first_name);
                    $stmt->bindParam(2,$last_name);
                    $stmt->bindParam(3,$email);
                    $stmt->bindParam(4,$id);
                    $stmt->execute();

                    $arr[0] = 'User update successful';
                }else if($rowCount > 0){
                    $arr[1] = "Can't change email as it is already used by another user";
                }

            }catch (PDOException $e){
                $arr[1] ='Error: '.$e->getMessage();
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

    // Delete Parent
    if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'parent');

                $arr[0] = 'User has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

?>