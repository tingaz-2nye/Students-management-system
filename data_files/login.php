<?php
    require_once ('../config/database.php');
    require_once ('../includes/functions.php');

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_role'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user_role = $_POST['user_role'];

    $password = md5($pass);
    $arr = array();

    if($user_role == 'student'){
        if(!empty($email) && !empty($password)){
            $stmt = $db->prepare("SELECT* FROM student WHERE email = ? and password =?");
            $stmt->bindParam(1,$email);
            $stmt->bindParam(2,$password);
            $stmt->execute();
            $row = $stmt->fetch();
            $id = $row['id'];
            $stud_id = $row['student_id'];
            $user_email = $row['email'];
            $pass = $row['password'];
            $class = $row['class'];
            $status = 1;

            if($email == $user_email && $password == $pass){
                $stmt = update_onlineStatus($db,'student',$status,$id);
                if($stmt){
                    $_SESSION['stud_session_id'] = $id;
                    $_SESSION['student_id'] = $stud_id;
                    $_SESSION['student_class'] = $class;

                    $arr[0] = 'Logged in as Student';
                }

            }else{
                $arr[1] = 'Wrong email or password';
            }

        }else{
            $arr[1] = 'Enter email and password please';
        }
    }else if($user_role == 'parent'){
        if(!empty($email) && !empty($password)){
            $stmt = $db->prepare("SELECT * FROM parent WHERE email = ? and password =?");
            $stmt->bindParam(1,$email);
            $stmt->bindParam(2,$password);
            $stmt->execute();
            $row = $stmt->fetch();
            $id = $row['id'];
            $user_email = $row['email'];
            $pass = $row['password'];
            $status = 1;

            if($email == $user_email && $password == $pass){
                $stmt = update_onlineStatus($db,'parent',$status,$id);
                if($stmt){
                    $_SESSION['parent_id'] = $id;

                    $arr[0] = 'Logged in as Parent';
                }

            }else{
                $arr[1] = 'Wrong email or password';
            }

        }
    }
    echo json_encode($arr);
}

// Change Student Password
if(isset($_POST['password']) && isset($_POST['newPass'])){
    $password = $_POST['password'];
    $newPassword = $_POST['newPass'];

    $pass = md5($password);
    $newPass = md5($newPassword);
    $arr = array();

    if(!empty($pass) && !empty($newPass)){
        $stmt=$db->prepare('SELECT password FROM student WHERE id=? and password=?');
        $stmt->bindParam(1,$_SESSION['stud_session_id']);
        $stmt->bindParam(2,$pass);
        $stmt->execute();
        $row = $stmt->fetch();
        $password = $row['password'];

        if($pass == $password){
            try{
            $stmt = $db->prepare("UPDATE student SET password=? WHERE id=?");
            $stmt->bindParam(1,$newPass);
            $stmt->bindParam(2,$_SESSION['stud_session_id']);
            $stmt->execute();

            $arr[0] = 'Password change successful';
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }else{
            $arr[1] = 'wrong password ';
        }
    }

    echo json_encode($arr);
}

// Change parent Password
if(isset($_POST['Ppassword']) && isset($_POST['PnewPass'])){
    $password = $_POST['Ppassword'];
    $newPassword = $_POST['PnewPass'];

    $pass = md5($password);
    $newPass = md5($newPassword);
    
    $arr = array();

    if(!empty($pass) && !empty($newPass)){
        $stmt=$db->prepare('SELECT password FROM parent WHERE id=? and password=?');
        $stmt->bindParam(1,$_SESSION['parent_id']);
        $stmt->bindParam(2,$pass);
        $stmt->execute();
        $row = $stmt->fetch();
        $password = $row['password'];

        if($pass == $password){
            try{
            $stmt = $db->prepare("UPDATE parent SET password=? WHERE id=?");
            $stmt->bindParam(1,$newPass);
            $stmt->bindParam(2,$_SESSION['parent_id']);
            $stmt->execute();

            $arr[0] = 'Password change successful';
            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }else{
            $arr[1] = 'wrong password';
        }
    }

    echo json_encode($arr);
}

?>