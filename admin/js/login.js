$(document).ready(function(){

    $('#login_form').on('submit',function(e){
        e.preventDefault();
        var email =$('#email').val();
        var password = $('#password').val();
        var user_role = $('#user_role').val();

        if(email != '' && password!=''){
            $.ajax({
                type:'POST',
                url:'./data_files/login.php',
                dataType:'json',
                data:{email:email,password:password, user_role:user_role },
                success: function(result){
            
                    if(result[0]){

                        alertify.notify(result[0],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                        setTimeout(function() {
                            window.location.href ='./index.php';
                        }, 200);
                        
                    }else if(result[2]){
                        alertify.notify(result[2],'custom_success',2,function(){
                            console.log('dismissed');
                        });
                        setTimeout(function() {
                            window.location.href ='./students.php';
                        }, 200);
                    }else if(result[1]){
                        alertify.notify(result[1],'custom_error',2,function(){
                            console.log('dismissed');
                        });
                        
                    }
                    
                    
                }
            });
        }else{
            $('#email_error').val('Please enter email');
            $('#password_error').val('Please enter password');
        }
    });
});