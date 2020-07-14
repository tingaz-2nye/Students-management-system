$(document).ready(function(){
    // Assign Teacher to class and subject
    $('#assignTeacher_form').on('submit', function(e){
        e.preventDefault();

        var teacher_id = $('#assign_teacher_id').val();
        var class_code = $('#assign_class_code').val();
        var subject_id = $('#assign_subject_id').val();

        if(teacher_id !='' && class_code!='' && subject_id!=''){
            $.ajax({
                url:'./data_files/teacher.php',
                type:'post',
                dataType:'json',
                data:{assign_teacher_id:teacher_id, assign_class_code:class_code, assign_subject_id:subject_id},
                success: function(result){
                    if(result[0]){
                        setTimeout(refreshTable1,10);
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
    // Assign Teacher to student
    $('#assignTutor_form').on('submit', function(e){
        e.preventDefault();

        var tutor_id = $('#tutor_id').val();
        var student_id = $('#student_id').val();

        if(teacher_id !='' && student_id!=''){
            $.ajax({
                url:'./data_files/teacher.php',
                type:'post',
                dataType:'json',
                data:{tutor_id:tutor_id, student_id:student_id},
                success: function(result){
                    if(result[0]){
                        setTimeout(refreshTable3,10);
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
    // Delete Assigned Teacher to class and subject
    $(document).on('click','.deleteAssignedTeacher', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to Remove Teacher from Class and Subject', function()
        { 
            $.ajax({
                url:'./data_files/teacher.php',
                type:'Post',
                data:{data_id:id},
                dataType:'json',
                success: function(result){
                    if(result[0]){
                        $tr.find('td').fadeOut(700,function(){
                            $tr.remove();
                        });
                        setTimeout(refreshTable1,10);
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
    // Delete Assigned Tutor
    $(document).on('click','.deleteTutor', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to Remove Teacher from Student', function()
        { 
            $.ajax({
                url:'./data_files/teacher.php',
                type:'Post',
                data:{tutor_data_id:id},
                dataType:'json',
                success: function(result){
                    if(result[0]){
                        $tr.find('td').fadeOut(700,function(){
                            $tr.remove();
                        });
                        setTimeout(refreshTable3,10);
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

    // Add Teacher 
    $('#addTeacher_form').on('submit',function(e){
        e.preventDefault();
        
        var teacher_id = $('#teacher_id').val();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var password = $('#pwd').val();

        if(teacher_id !='' && first_name!='' && last_name !='' && email !='' && password!=''){
            $.ajax({
                url:'./data_files/teacher.php',
                type:'post',
                dataType:'json',
                data:{add_teacher_id:teacher_id, add_first_name:first_name, add_last_name:last_name, add_email:email, add_password:password},
                success: function(result){
                    if(result[0]){
                        $('#addteacher').modal('hide');
                        $('#addTeacher_form *').val('');
                        setTimeout(refreshTable2,10);
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

    // Retrive Subject data
    $('#editTeacher').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/teacher.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#edit_teacher_id').val(result[0]);
                modal.find('#edit_first_name').val(result[1]);
                modal.find('#edit_last_name ').val(result[2]);
                modal.find('#edit_email').val(result[3]);
                modal.find('#primary_teacher_id').val(result[4]);

            }
        });
    });

    // Edit Teacher Details
    $('#editTeacher_form').on('submit',function(e){
        e.preventDefault();

        var id = $('#primary_teacher_id').val();
        var teacher_id = $('#edit_teacher_id').val();
        var first_name = $('#edit_first_name').val();
        var last_name = $('#edit_last_name').val();
        var email = $('#edit_email').val();
        
        if(id !='' && teacher_id!='' && first_name!='' && last_name!='' && email!=''){
            $.ajax({
                url:'./data_files/teacher.php',
                type:'post',
                dataType:'json',
                data:{editPrimary_id:id, editTeacher_id:teacher_id, editFirst_name:first_name, editLast_name:last_name, editEmail:email},
                success: function(result){
                    if(result[0]){
                        $('#editTeacher').modal('hide');
                        $('#editTeacher_form *').val('');
                        setTimeout(refreshTable2,10);
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

    // Delete Teacher 
    $(document).on('click','.deleteTeacher', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Teacher', function()
        { 
            $.ajax({
                url:'./data_files/teacher.php',
                type:'Post',
                data:{teacher_data_id:id},
                dataType:'json',
                success: function(result){
                    if(result[0]){
                        $tr.find('td').fadeOut(700,function(){
                            $tr.remove();
                        });
                        setTimeout(refreshTable2,10);
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



    // Retrive teacher email
    $('#emailteacher').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/teacher.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#email').val(result[3]);
            }
        });
        
    });

    // send teacher email
    $('#emailTeacher_form').on('submit', function(e){
        e.preventDefault();

        var modal = $(this);
        var email = modal.find('#email').val();
        var subject =modal.find('#subject').val();
        var message =modal.find('#message').val();

        if(email !='' && subject !='' && message !=''){
            $.ajax({
                url:'./data_files/teacher.php',
                type:'post',
                dataType:'json',
                data:{email_email:email, email_subject:subject, email_message:message},
                success: function(result){
                    if(result[0]){
                        $('#emailteacher').modal('hide');
                        $('#emailTeacher_form *').val('');
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

    
    
    function refreshTable1(){
        $('.teacherTable1').load('./includes/teacherTable1.php');
    }
    function refreshTable2(){
        $('.teacherTable2').load('./includes/teacherTable2.php');
    }
    function refreshTable3(){
        $('.teacherTable3').load('./includes/teacherTable3.php');
    }
});