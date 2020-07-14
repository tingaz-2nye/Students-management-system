$(document).ready(function(){
    
    // Add parent 
    $('#addParent_form').on('submit', function(e){
        e.preventDefault();

        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        if(first_name!= '' && last_name !='' && email!='' && password!=''){
            $.ajax({
                url:'./data_files/parent.php',
                type:'Post',
                dataType:'json',
                data:{first_name:first_name, last_name:last_name, email:email, password:password},
                success: function(result){
                    if(result[0]){
                        $('#addparent').modal('hide');
                        $('#addParent_form *').val('');
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

    // Retrive Edit Parent data
    $('#editparent').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/parent.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#editParent_id').val(result[0]);
                modal.find('#first_name').val(result[1]);
                modal.find('#last_name').val(result[2]);
                modal.find('#email').val(result[3]);
            }
        });
    });


    //Edit parent
    $('#editParent_form').on('submit',function(e){
        e.preventDefault();

        var modal = $(this);
        var id = modal.find('#editParent_id').val();
        var firstname =modal.find('#first_name').val();
        var lastname =modal.find('#last_name').val();
        var email =modal.find('#email').val();

        if(firstname!= '' && lastname !='' && email!='' && id!=''){
            $.ajax({
                type:'POST',
                url:'./data_files/parent.php',
                dataType:'json',
                data:{editParent_id:id, editFirstname:firstname, editLastname:lastname, editEmail:email},
                success: function(result){
                    if(result[0]){
                        $('#editparent').modal('hide');
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

    // Retrive parent email
    $('#emailparent').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/parent.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#email').val(result[3]);
            }
        });
        
    });

    // send parent email
    $('#emailParent_form').on('submit', function(e){
        e.preventDefault();

        var modal = $(this);
        var email = modal.find('#email').val();
        var subject =modal.find('#subject').val();
        var message =modal.find('#message').val();

        if(email !='' && subject !='' && message !=''){
            $.ajax({
                url:'./data_files/parent.php',
                type:'post',
                dataType:'json',
                data:{email_email:email, email_subject:subject, email_message:message},
                success: function(result){
                    if(result[0]){
                        $('#emailparent').modal('hide');
                        $('#emailParent_form *').val('');
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


    // Delete Parent 
    $(document).on('click','.deleteParent', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Parent', function()
        { 
            $.ajax({
                url:'./data_files/parent.php',
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
        $('.parentsTable').load('./includes/parentTable.php');
    }


});