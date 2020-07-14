<?php while ($post = $posts->fetch()){
    if($post['id'] == $single_post){
		$post_id = $post['id'];
        $replys = get_replys($db,$post_id);
        $post_owner = getStudentField($db,$post['student_id']);
  ?>
<div class="row" id="chat_window_1">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar" >
                    <div class="col-md-12 col-xs-12" style="border-bottom:1px dotted #AEBDC8; margin-bottom:25px;">
                        <p class="panel-title">Topic: <?php echo $post['title']; ?></p>
                        <p style="padding: 0 10px;"><?php echo $post['message']; ?></p>
                        <h6><?php echo $post_owner; ?> • <?php echo date('jS, F Y, g:i a', strtotime($post['post_time'])); ?> </h6>
                    </div>
                    <!-- <span class="glyphicon glyphicon-comment"> -->
                </div>
                <?php if(!empty($replys)){ ?>
                <div class="panel-body msg_container_base">
                    <?php 
                    $i = 1; 
                    while ($reply = $replys->fetch()) 
                    {
                         $user = getStudentField($db,$post['student_id']); ?>


                    <div class="row">


                        <ul class="recent-posts">
                        <li>
                            <div class="user-thumb"> </div>
                            <div class="article-post"> <span class="user-info"> By: <?php echo $user;?> / Date: <?php echo date('jS, F Y', strtotime($reply['reply_time'])); ?> / Time:<?php echo date(' g:i a', strtotime($reply['reply_time'])); ?> </span>
                            <p><a href="#"><?php echo $reply['message'];?></a> </p>
                            </div>
                        </li>
                        </ul>



                    </div>
                    <?php $i++;}?>
                </div>
                 <?php }?>
                <div class="panel-footer" style="margin-top:-17px;">
                    <form action="community.php?id=<?php echo $post['id'];?>" method="post" id="replyForm">
                    <input type="hidden" id="post_id" name="post_id" value="<?php echo $post['id']; ?>" />
                        <div class="form-group">
                            <input type="text" id="reply_message" name="reply_message" class="form-control" placeholder="Write your reply here..." />

                        </div>
                         <button class="btn btn-primary reply_btn " id="btn-chat" type="submit" name="reply">Reply</button>
                    </form>
                </div>
    		</div>
        </div>
    </div>


<?php }} ?>
