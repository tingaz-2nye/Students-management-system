$(document).ready(function(){
    $('#assginUpload_form').on('submit',function(e){
        e.preventDefault();

        var formdata = new FormData(this);
        

        if(formdata != ''){
            $.ajax({
                url:'./data_files/assignment.php',
                type:'post',
                data: formdata,
				mimeTypes:"multipart/form-data",
				contentType: false,
				cache: false,
                processData: false,
                dataType:'json',
                success: function(result){

                    if(result[0]){
                        $('#assignment').modal('hide');
                        $('#assginUpload_form *').val('');
                        setTimeout(refreshTable,10);
                        alertify.notify(result[0],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                     }else if (result[1]){
                         alertify.notify(result[1],'custom_error',2,function(){
                             console.log('dismissed');
                         });
                     }
                }
            });
        }

    });

     // Delete Assignment 
     $(document).on('click','.deleteAssign', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Assignment', function()
        { 
            $.ajax({
                url:'./data_files/assignment.php',
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

    // Delete Student Assignment 
    $(document).on('click','.deleteStudentAssign', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Assignment', function()
        { 
            $.ajax({
                url:'./data_files/assignment.php',
                type:'Post',
                data:{stdData_id:id},
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
        $('.assignmentTable1').load('./includes/assignmentTable1.php');
    }

    function refreshTable2(){
        $('.assignmentTable2').load('./includes/assignmentTable2.php');
    }

});