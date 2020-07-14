// Retrive teacher email
$('#emailteacher').on('show.bs.modal',function(e){
    var button = $(e.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    var dataString = 'id='+id;
    $.ajax({
        type:'POST',
        url:'./data_files/email.php',
        data:dataString,
        dataType:'json',
        success: function(result){
            console.log(result);
            modal.find('#email').val(result[0]);
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
            url:'./data_files/email.php',
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