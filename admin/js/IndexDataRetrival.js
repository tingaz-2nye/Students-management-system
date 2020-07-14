$(document).ready(function(){
    
    setInterval(retreiveOnlineNum,200);

    setInterval(retriveTable,200);



    function retriveTable(){
        $.ajax({
            type:'post',
            url:'./data_files/indexOnlineTable.php',
            async:false,
            dataType:'html',
            success: function(result){
                $('#teacher_online_list').html(result);  
            }
        });
    }

    function retreiveOnlineNum(){
        $.ajax({
            type:'post',
            url:'./data_files/indexDataRetrival.php',
            async:false,
            dataType:'json',
            success: function(result){
                if(result[0]){
                    $('#student_online_count').text(result[0]);
                }else if(result[0] == 0){
                    $('#student_online_count').text('0');
                }
                if(result[1]){
                    $('#parent_online_count').text(result[1]);
                }else if(result[1] == 0){
                    $('#parent_online_count').text('0');
                }
                if(result[2]){
                    $('#teacher_online_count').text(result[2]);
                }else if(result[2] == 0){
                    $('#teacher_online_count').text('0');
                }
                
            }
        });

    }

});