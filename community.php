<?php 
    require_once ('config/database.php');
    require_once ('includes/functions.php');

	if(student_login()){ 
	
	$posts = get_posts($db);
	$single_post = (isset($_GET['id']) ? $_GET['id'] : 0);

	
	if(isset($_POST['reply'])){
		$reply_message = $_POST['reply_message'];
		$post_id = $_POST['post_id'];
		
		if(!empty($reply_message)){
		$stmt =$db->prepare("INSERT INTO post_reply(student_id,post_id,message) VALUES(?,?,?)");
		$stmt->bindParam(1,$_SESSION['stud_session_id']);
		$stmt->bindParam(2,$post_id);
		$stmt->bindParam(3,$reply_message);
		$stmt->execute();
		}
	}

	}else{
		redirect_to('login.php');
	}


?>
<?php include ('includes/header.php'); ?>

<div class="content">
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2><i class="fa fa-comments-o animated jello"></i> Community</h2>
			</div>
		</div>
	</div>
    <div class="row">
				<div class="col-md-4">
					<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"> Start topic </button><br><br>
					<h2>Topics:</h2><br>
				
					<?php 
					//  $rows = $posts->rowCount();
					// if($rows == 0){
					// 		echo '<p class=""> Currently there is no available Post <p>';
					// 	}
					?>
					<ul class="topic_post list-group">
						<?php while ($row = $posts->fetch()) {?>
							<li  class="list-group-item">
								<a href="?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
							</li>
						<?php } ?>
					</ul>
					
				</div>
				<div class="col-md-8">
					<!-- <div class="account-wall"> -->
						
								 
								<?php	
									$posts = get_posts($db); 
									require ('includes/single_post.php');
								?>
					

				   
					<!-- </div> -->
				</div>
				<!-- Modal --> 
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
						<div class="modal-dialog"> 
							<div class="modal-content"> 
								<div class="modal-header"> 
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> 
									<h4 class="modal-title">Add Topic</h4>
								</div> 
								<div class="modal-body">
									<form id="community_topic" action="community.php" method="post" id="topicfrom">
										<div class="form-group">
											<label>Title</label>
											<input type="text" name="title" id="title" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Message</label>
											<textarea class="form-control" id="message" name="message"></textarea>
											
										</div>
										<button class="btn btn-primary post_topic" type="submit" name="submit"> Post</button>
										
									</form>
								</div> 
							</div>
						</div><!-- /.modal-content --> 
					</div><!-- /.modal -->
          
      </div>
      <!-- End row  -->
    </div>
</div>


<?php include ('includes/footer.php'); ?>