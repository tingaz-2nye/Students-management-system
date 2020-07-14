$(document).ready(function(){
    // Add class
    $('#addClass_form').on('submit', function(e){
        e.preventDefault();

        var class_name = $('#class_name').val();
        var class_level = $('#class_level').val();
        var class_code = $('#class_code').val();

        if(class_name !='' && class_level != '' && class_code !=''){
            $.ajax({
                url:'./data_files/class.php',
                type:'post',
                dataType:'json',
                data:{add_class_name:class_name, add_class_level:class_level, add_class_code:class_code},
                success: function(result){
                    if(result[0]){
                        $('#addclass').modal('hide');
                        $('#addClass_form *').val('');
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

    // Retrive class data
    $('#editclass').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/class.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#edit_class_id').val(result[0]);
                modal.find('#edit_class_name').val(result[1]);
                modal.find('#edit_class_level').val(result[2]);
                modal.find('#edit_class_code').val(result[3]);
            }
        });
    });

    // Edit class
    $('#editClass_form').on('submit', function(e){
        e.preventDefault();

        var id = $('#edit_class_id').val();
        var class_name = $('#edit_class_name').val();
        var class_level = $('#edit_class_level').val();
        var class_code = $('#edit_class_code').val();

        if(id !='' && class_name !='' && class_level != '' && class_code !=''){
            $.ajax({
                type:'POST',
                url:'./data_files/class.php',
                dataType:'json',
                data:{editClass_id:id, editClass_name:class_name, editClass_level:class_level, editClass_code:class_code},
                success: function(result){
                    if(result[0]){
                        $('#editclass').modal('hide');
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

     // Delete Class 
     $(document).on('click','.deleteClass', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Class', function()
        { 
            $.ajax({
                url:'./data_files/class.php',
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
        $('.classTable').load('./includes/classTable.php');
    }
});