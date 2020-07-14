$(document).ready(function(){

    //Add Timetable
    $('#timetable_form').on('submit', function(e){
        e.preventDefault();

        var day = $('#day').val();
        var class_code = $('#class_code').val();
        var subject_code = $('#subject_code').val();
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();

        if(day!=' ' && class_code!=' ' && subject_code!=' ' && start_time!=' ' && end_time!=' '){
            $.ajax({
                url:'./data_files/timetable.php',
                type: 'POST',
                dataType:'json',
                data:{add_day:day, add_class_code:class_code, add_subject_code:subject_code, add_time_start:start_time, add_time_end:end_time},
                success: function(result){
                    if(result[0]){
                        $('#addTimetable').modal('hide');
                        $('#timetable_form *').val('');
                        setTimeout(refreshTable,10);
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

    //Retrive timetable data
    $('#editTimetable').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/timetable.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#timetable_id').val(result[0]);
                modal.find('#day').val(result[1]);
                modal.find('#class_code').val(result[2]);
                modal.find('#subject_code').val(result[3]);
                modal.find('#start_time').val(result[4]);
                modal.find('#end_time').val(result[5]);
            }
        });
    });

    //Edit Timetable
    $('#edit_timetable_form').on('submit', function(e){
        e.preventDefault();

        var modal = $(this);
        var id = modal.find('#timetable_id').val();
        var day =modal.find('#day').val();
        var class_code =modal.find('#class_code').val();
        var subject_code =modal.find('#subject_code').val();
        var start_time =modal.find('#start_time').val();
        var end_time =modal.find('#end_time').val();

        if(day!='' && class_code!='' && subject_code!='' && start_time!='' && end_time!='' && id!=''){
           $.ajax({
                type:'POST',
                url:'./data_files/timetable.php',
                dataType:'json',
                data:{timetable_id:id, edit_day:day, edit_class_code:class_code, edit_subject_code:subject_code, edit_start_time:start_time, edit_end_time:end_time},
                success: function(result){
                    if(result[0]){
                        $('#editTimetable').modal('hide');
                        setTimeout(refreshTable,10);
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

    // Delete TimeTable
    $(document).on('click','.timetable_delete', function(e){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this TimeTable', function()
        { 
            $.ajax({
                url:'./data_files/timetable.php',
                type:'Post',
                data:{data_id:id},
                dataType:'json',
                success: function(result){
                    if(result[0]){
                        $tr.find('td').fadeOut(700,function(){
                            $tr.remove();
                        });
                        setTimeout(refreshTable,10);
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

        $('.timeTable').load('./includes/timetable.php');
    }

});