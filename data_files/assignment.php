<?php
    require_once('../config/database.php');
    require_once('../includes/functions.php');

    // upload Student Assignment
    if(isset($_FILES['file']['name']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['class_code']) && isset($_POST['student_id'])){
        $title = mysql_prep($_POST['title']);
        $desc = mysql_prep($_POST['description']);
        $class = mysql_prep($_POST['class_code']);
        $student_id = mysql_prep($_POST['student_id']);

        $arr = array();

        $folder="../uploads/";
        $path = "uploads/";
        $temp = explode(".",$_FILES['file']['name']);
        $newfilename = round(microtime(true)).'.'.end($temp);
        $db_path = "$path".$newfilename;

        $listtype = array('.doc'=>'application/msword',
        '.docx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        '.rtf'=>'application/rtf',
        '.pdf'=>'application/pdf',);

        if($key = array_search($_FILES['file']['type'],$listtype)){
            if(move_uploaded_file($_FILES['file']['tmp_name'],"$folder".$newfilename)){
                $stmt = $db->prepare("INSERT INTO student_assignments(file_path,title,description,class_code,student_id) VALUES(?,?,?,?,?)");
                $stmt->bindParam(1,$db_path);
                $stmt->bindParam(2,$title);
                $stmt->bindParam(3,$desc);
                $stmt->bindParam(4,$class);
                $stmt->bindParam(5,$student_id);
                $stmt->execute();

                $arr[0]=' File uploaded';
            }
        }else{
            $arr[1] = "File type should be .Docx, Pdf, Rtf or Doc";
        }

        echo json_encode($arr);
    }


    // Delete Teacher Assignment
    if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);

        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'assignments');

                $arr[0] = 'Assignment has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

    // Delete Student Assignment
    if(isset($_POST['stdData_id'])){
        $id = mysql_prep($_POST['stdData_id']);

        $arr = array();

        if(!empty($id)){
            try{
                
                $stmt = simpleDelete($db,$id,'student_assignments');

                $arr[0] = 'Assignment has been successfully deleted';

            }catch (PDOException $e){
                $arr[1] = 'Error: '.$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }

?>
