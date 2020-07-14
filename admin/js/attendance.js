$(document).ready(function(){
    $('#manage_attendance_form').on('submit', function(e){
        e.preventDefault();

        var week = $('#week').val();
        var day = $('#day').val();
        var class_code = $('#class').val();

        if(week!='' && day!='' && class_code!=''){
            $.ajax({
                url:'./data_files/attendance.php',
                type:'post',
                dataType:'html',
                data:{week:week,day:day,class:class_code},
                success: function(result){
                    $('#attendance-mute').hide();
                    $('#table_data').html(result);
                }
            });
        }

    });

    $('#classAttendance_form').on('submit',function(e){
        e.preventDefault();

        var week = $('#add_week').val();
        var day = $('#add_day').val();
        var class_code = $('#add_class').val();
        var student_id = $('#add_student_id').val();
        var status = $('#add_status').val();

        if(week!='' && day!='' && class_code!='' && student_id!='' && status!=''){
            $.ajax({
                url:'./data_files/attendance.php',
                type:'post',
                dataType:'json',
                data:{add_week:week, add_day:day, add_class:class_code, add_student_id:student_id, add_status:status},
                success: function(result){
                    if(result[0]){
                        $('#attendance').modal('hide');
                        $('#classAttendance_form *').val('');
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
    })
});