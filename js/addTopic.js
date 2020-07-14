$(document).ready(function(){
    $('#community_topic').on('submit',function(e){
        e.preventDefault();

        var title = $('#title').val();
        var message = $('#message').val();

        if(title!='' && message!=''){
            $.ajax({
                url:'./data_files/topic.php',
                type:'post',
                dataType:'json',
                data:{title:title,message:message},
                success: function(result){
                    if(result[0]){

                        alertify.notify(result[0],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                        setTimeout(refreshList,10);
                        $('#myModal').modal('hide');
                        $('#community_topic *').val('');    
                        
                    }else if(result[1]){
                        alertify.notify(result[1],'custom_error',2,function(){
                            console.log('dismissed');
                        });
                        
                    }
                }
            });
        }
    });

    function refreshList(){
        $('.topic_post').load('./includes/topicList.php');
    }

});