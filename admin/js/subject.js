$(document).ready(function(){
    // Add Subject
    $('#addSubject_form').on('submit', function(e){
        e.preventDefault();

        var subject_name = $('#subject_name').val();
        var subject_code = $('#subject_code').val();

        if(subject_name !='' && subject_code !=''){
            $.ajax({
                url:'./data_files/subject.php',
                type:'post',
                dataType:'json',
                data:{add_subject_name:subject_name, add_subject_code:subject_code},
                success: function(result){
                    if(result[0]){
                        $('#addsubject').modal('hide');
                        $('#addSubject_form *').val('');
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

    // Retrive Subject data
    $('#editsubject').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/subject.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#edit_subject_id').val(result[0]);
                modal.find('#edit_subject_name').val(result[1]);
                modal.find('#edit_subject_code').val(result[2]);
            }
        });
    });

    // Edit Subject
    $('#editSubject_form').on('submit', function(e){
        e.preventDefault();

        var id = $('#edit_subject_id').val();
        var subject_name = $('#edit_subject_name').val();
        var subject_code = $('#edit_subject_code').val();

        if(id !='' && subject_name !='' && subject_code !=''){
            $.ajax({
                type:'POST',
                url:'./data_files/subject.php',
                dataType:'json',
                data:{editSubject_id:id, editSubject_name:subject_name, editSubject_code:subject_code},
                success: function(result){
                    if(result[0]){
                        $('#editsubject').modal('hide');
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

     // Delete Subject 
     $(document).on('click','.deleteSubject', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Subject', function()
        { 
            $.ajax({
                url:'./data_files/subject.php',
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
        $('.subjectTable').load('./includes/subjectTable.php');
    }
});