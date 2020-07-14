<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = mysql_prep($_POST['email']);
    $pass = mysql_prep($_POST['password']);
    $user_role = mysql_prep($_POST['user_role']);

    $password = md5($pass);
    $arr = array();

    if($user_role == 'teacher'){
        if(!empty($email) && !empty($password)){
            
            $stmt = $db->prepare("SELECT * FROM teacher WHERE email = ? and password =?");
            $stmt->bindParam(1,$email);
            $stmt->bindParam(2,$password);
            $stmt->execute();
            $row = $stmt->fetch();
            $id = $row['id'];
            $teacher_id = ['teacher_id'];
            $user_email = $row['email'];
            $pass2 = $row['password'];

            if($email == $user_email && $password == $pass2){
                $stmt =$db->prepare("update teacher set online_status=1 where id =?");
                $stmt->bindParam(1,$id);
                $stmt->execute();

                $_SESSION['teacher_session_id'] = $id;
                $_SESSION['teacher_id'] = $teacher_id;

                $arr[2] ='Logged in as Teacher';

            }else{
                $arr[1]='Wrong email or password';
            }

        }else{
            $arr[1]='Enter email and password please';
        }
    }else if($user_role == 'admin'){
        if(!empty($email) && !empty($password)){
            $stmt = $db->prepare("SELECT * FROM admin WHERE email = ? and password =?");
            $stmt->bindParam(1,$email);
            $stmt->bindParam(2,$password);
            $stmt->execute();
            $row = $stmt->fetch();
            $id = $row['id'];
            $user_email = $row['email'];
            $pass2 = $row['password'];

            if($email == $user_email && $password == $pass2){
                $_SESSION['admin_id']= $id;
                $arr[0] ='Logged in as Admin';
            }else{
                $arr[1]='Wrong email or password';
            }

        }else{
            $arr[1]='Enter email and password please';
        }
    }
    echo json_encode($arr);
}

?>