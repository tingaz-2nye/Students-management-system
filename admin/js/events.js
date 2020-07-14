$(document).ready(function(){
    // Adding Event to Database
    $('#AddEvent_Form').on('submit',function(e){
        e.preventDefault();
       
        var title = $('#event_title').val();
        var notice = $('#event_desc').val();
        var event_date = $('#event_date').val();

        if(title != '' && notice != '' && event_date!=''){
            $.ajax({

                url:'./data_files/noticeboard.php',
                type: 'post',
                dataType:'json',
                data:{notice_title_AddEvent:title, notice_AddEvent:notice, date_AddEvent:event_date},
                success: function(result){
                    $('#addevent').modal('hide');
                    setTimeout(refreshTable,10);
                    $('#AddEvent_Form input').val('');
                    $('#AddEvent_Form textarea').val('');
                    if(result[4]){
                        alertify.notify(result[4],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                    }else if(result[5]){	
                        alertify.notify(result[5+9],'custom_error',2,function(){
                            console.log('dismissed');
                        });
                    }


                }

            });
        }
        
    });

    // // Retriving data from database to show on modal
    $('#eventEdit').on('show.bs.modal',function(e){
        
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/noticeboard.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#event_id').val(result[0]);
                modal.find('#event_title').val(result[1]);
                modal.find('#event_desc').val(result[2]);
                modal.find('#event_date').val(result[3]);

            }
        });
    });

    // Editing Event data on modal
    $('#EditEvent_Form').on('submit',function(e){
        e.preventDefault();

        var modal = $(this);
        var id = modal.find('#event_id').val();
        var title = modal.find('#event_title').val();
        var notice = modal.find('#event_desc').val();
        var event_date = modal.find('#event_date').val();


        if(id != '' && title != '' && notice != '' && event_date!=''){
            $.ajax({

                url:'./data_files/noticeboard.php',
                type: 'post',
                dataType:'json',
                data:{id_EditEvent:id, notice_title_EditEvent:title, notice_EditEvent:notice, date_EditEvent:event_date},
                success: function(result){
                    $('#eventEdit').modal('hide');
                    setTimeout(refreshTable,10);
                    if(result[0]){
                        alertify.notify(result[0],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                    }else if(result[1]){	
                        alertify.notify(result[1],'custom_error',2,function(){
                            console.log('dismissed');
                        });
                    }
                    
                }

            });
        }
    });

    // Deleting Event
    $(document).on('click','.deleteEvent',function(){
        
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Event', function()
        { 
            $.ajax({
                url:'./data_files/noticeboard.php',
                type:'Post',
                data:{data_id:id},
                dataType:'json',
                success: function(result){
                    $tr.find('td').fadeOut(700,function(){
                        $tr.remove();
                    });
                    setTimeout(refreshTable,10);
                    if(result[0]){
                        alertify.notify(result[0],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                    }else if(result[1]){
                        alertify.notify(result[1],'custom_error',2,function(){
                            console.log('dismissed');
                        });
                    }
                }
            });
        }, 
        function(){ alertify.notify('Delete cancelled','custom_error',2,function(){ console.log('dismissed'); }); });

    });


    function refreshTable(){

        $('.EventsTable').load('./includes/eventTable.php');
    }


});