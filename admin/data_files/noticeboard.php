<?php
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    // Add Event 
    if(isset($_POST['notice_title_AddEvent']) && isset($_POST['notice_AddEvent'])  && isset($_POST['date_AddEvent'])  ){

        
        $notice_title = mysql_prep($_POST['notice_title_AddEvent']);
        $notice = mysql_prep($_POST['notice_AddEvent']);
        $date = mysql_prep($_POST['date_AddEvent']);
        $arr = array();

        if(!empty($notice_title) && !empty($notice) && !empty($date)){
            try{ 
                $stmt1 = $db->prepare("SELECT * FROM noticeboard WHERE notice_title=? and notice=? and date=? ");
                $stmt1->bindParam(1,$notice_title);
                $stmt1->bindParam(2,$notice);
                $stmt1->bindParam(3,$date);
                $row = $stmt1->fetch();
                $new_notice_title = $row['notice_title'];
                $new_notice =$row['notice'];
                $new_date = $row['date'];

                if($new_notice_title != $notice_title && $new_notice != $notice && $new_date != $date){
                    try{
                        $stmt = $db->prepare("INSERT INTO noticeboard(notice_title,notice,date) VALUES(?,?,?)");
                        $stmt->bindParam(1,$notice_title);
                        $stmt->bindParam(2,$notice);
                        $stmt->bindParam(3,$date);
                        $stmt->execute();
                                            
                        $arr[4] = 'Event added successfully';
                    }catch(PDOException $e){
                        $arr[5] = 'Error '.$e->getMessage();
                    }

                }else{
                    $arr[5] = 'Event Already Exists';
                }
            }catch (PDOException $e){
                $arr[5] = 'Error '.$e->getMessage();
            }
        }
        echo json_encode($arr);
        exit();
    }

    // Edit Event
    if(isset($_POST['notice_title_EditEvent']) && isset($_POST['notice_EditEvent']) && isset($_POST['date_EditEvent'])  ){
        $notice_title = mysql_prep($_POST['notice_title_EditEvent']);
        $notice = mysql_prep($_POST['notice_EditEvent']);
        $date = mysql_prep($_POST['date_EditEvent']);
        $id = mysql_prep($_POST['id_EditEvent']);

        $arr = array();

        if(!empty($notice_title) && !empty($notice) && !empty($date) && !empty($id)){
            try{    
                $stmt = $db->prepare("UPDATE noticeboard SET notice_title=?, notice=?, date=? WHERE id=?");
                $stmt->bindParam(1,$notice_title);
                $stmt->bindParam(2,$notice);
                $stmt->bindParam(3,$date);
                $stmt->bindParam(4,$id);
                $stmt->execute();

                $message = 'Event has been Successfully Edited';
                $arr[0] = $message;

            }catch(PDOException $e){
                $arr[1] = 'Error '.$e->getMessage();
            }
        }else{
            $message = 'Make sure all fields are filled';
            $arr[1] = $message;
        }

        echo json_encode($arr);
        exit();
    }

    // Retrive Event
    if(isset($_POST['id'])){
        $id = mysql_prep($_POST['id']);
        $arr = array();

        if(!empty($id)){
            try{
                $stmt = SimpleSelectWhereID($db,$id,'noticeboard');
                
                while($row = $stmt->fetch()){ 
                    $arr[0] = $row['id'];
                    $arr[1] = $row['notice_title'];
                    $arr[2] = $row['notice'];
                    $arr[3] = $row['date'];

                }

            }catch(PDOException $e){
                echo 'Error '.$e->getMessage();
            }
        }
        
    echo json_encode($arr);
    exit();
    
    }

    // Delete Event
    if(isset($_POST['data_id'])){
        $id = mysql_prep($_POST['data_id']);
        $arr = array();

        if(!empty($id)){
            try{
                $stmt = simpleDelete($db,$id,'noticeboard');

                $arr[0] = "Event deleted";
            }catch (PDOException $e){
                $arr[1] = "Error: ".$e->getMessage();
            }
        }

        echo json_encode($arr);
        exit();
    }
?>