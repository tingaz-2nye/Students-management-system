$(document).ready(function(){
    $('#addStudent_form').on('submit',function(e){
        e.preventDefault();

        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var gender = $('#gender').val();
        var age = $('#age').val();
        var email = $('#email').val();
        var pwd = $('#pwd').val();
        var student_id = $('#student_id').val();
        var parent_id = $('#parent_id').val();
        var class_code = $('#class_code').val();

        if(first_name !='' && last_name !='' && gender !='' && age !='' && email !='' && pwd !='' 
        && student_id !='' && parent_id !='' && class_code !=''){
            $.ajax({
                url:'./data_files/student.php',
                type:'post',
                dataType:'json',
                data:{addfirst_name:first_name,addlast_name:last_name,add_gender:gender,add_age:age,add_email:email,add_password:pwd,addstudent_id:student_id,addparent_id:parent_id,addclass_code:class_code},
                success: function(result){
                    if(result[0]){
                        $('#addstudent').modal('hide');
                        $('#addStudent_form *').val('');
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


    $('#editstudent').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/student.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#primary_student_id').val(result[0]);
                modal.find('#edit_first_name').val(result[1]);
                modal.find('#edit_last_name').val(result[2]);
                modal.find('#edit_gender').val(result[3]);
                modal.find('#edit_age').val(result[4]);
                modal.find('#edit_email').val(result[5]);
                modal.find('#edit_student_id').val(result[6]);
                modal.find('#edit_class_code').val(result[7]);
            }
        });
    });

    $('#editStudent_form').on('submit',function(e){
        e.preventDefault();

        var id = $('#primary_student_id').val();
        var first_name = $('#edit_first_name').val();
        var last_name = $('#edit_last_name').val();
        var gender = $('#edit_gender').val();
        var age = $('#edit_age').val();
        var email = $('#edit_email').val();
        var student_id = $('#edit_student_id').val();
        var class_code = $('#edit_class_code').val();

        if(id!='' && first_name!='' && last_name!='' && gender!='' && age!='' && email!='' && student_id!='' && class_code!=''){
            $.ajax({
                url:'./data_files/student.php',
                type:'post',
                dataType:'json',
                data:{edit_id:id,editfirst_name:first_name,editlast_name:last_name,edit_gender:gender,edit_age:age,edit_email:email,editstudent_id:student_id,editclass_code:class_code},
                success: function(result){
                    if(result[0]){
                        $('#editstudent').modal('hide');
                        $('#editStudent_form *').val('');
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

    // Delete Student 
    $(document).on('click','.deleteStudent', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Student', function()
        { 
            $.ajax({
                url:'./data_files/student.php',
                type:'Post',
                data:{student_data_id:id},
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


    function refreshTable(){
        $('.studentTable').load('./includes/studentTable.php');
    }
});