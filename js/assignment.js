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

});