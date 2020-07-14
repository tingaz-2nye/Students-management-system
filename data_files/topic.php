<?php 
    require_once ('../config/database.php');
    require_once ('../includes/functions.php');

if(isset($_POST['title']) && isset($_POST['message'])){
    $title = $_POST['title'];
    $message = $_POST['message'];
    
    $arr = array();

    if(!empty($title) && !empty($message)){
		$stmt = $db->prepare("INSERT INTO post (student_id,title,message) VALUES(?,?,?)");
        $stmt->bindParam(1,$_SESSION['stud_session_id']);
        $stmt->bindParam(2,$title);
        $stmt->bindParam(3,$message);
        $stmt->execute();
		
		if($stmt){
            $arr[0] = "You have succefully added a topic.";
            // $posts = get_posts($db);
		}
		
	}else{
        
    }
    
    echo json_encode($arr);
}

?>