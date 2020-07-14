$(document).ready(function(){
    // Add Exam
    $('#addExam_form').on('submit', function(e){
        e.preventDefault();

        var exam_name = $('#exam_name').val();
        var exam_date = $('#exam_date').val();
        var exam_comment = $('#exam_comment').val();

        if(exam_name !='' && exam_date != '' && exam_comment !=''){
            $.ajax({
                url:'./data_files/exam.php',
                type:'post',
                dataType:'json',
                data:{add_exam_name:exam_name, add_exam_date:exam_date, add_exam_comment:exam_comment},
                success: function(result){
                    if(result[0]){
                        $('#addexam').modal('hide');
                        $('#addExam_form *').val('');
                        // setTimeout(refreshTable,10);
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

    // Retrive Exam data
    $('#editexam').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/exam.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#edit_exam_id').val(result[0]);
                modal.find('#edit_exam_name').val(result[1]);
                modal.find('#edit_exam_date').val(result[2]);
                modal.find('#edit_exam_comment').val(result[3]);
            }
        });
    });

    // Edit Exam
    $('#editExam_form').on('submit', function(e){
        e.preventDefault();

        var id = $('#edit_exam_id').val();
        var exam_name = $('#edit_exam_name').val();
        var exam_date = $('#edit_exam_date').val();
        var exam_comment = $('#edit_exam_comment').val();

        if(id !='' && exam_name !='' && exam_date != '' && exam_comment !=''){
            $.ajax({
                type:'POST',
                url:'./data_files/exam.php',
                dataType:'json',
                data:{editExam_id:id, editExam_name:exam_name, editExam_date:exam_date, editExam_comment:exam_comment},
                success: function(result){
                    if(result[0]){
                        $('#editexam').modal('hide');
                        // setTimeout(refreshTable,10);
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

     // Delete Exam 
     $(document).on('click','.deleteExam', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Exam', function()
        { 
            $.ajax({
                url:'./data_files/exam.php',
                type:'Post',
                data:{data_id:id},
                dataType:'json',
                success: function(result){
                    if(result[0]){
                        $tr.find('td').fadeOut(700,function(){
                            $tr.remove();
                        });
                        // setTimeout(refreshTable,10);
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

    // Add Grade
    $('#addGrade_form').on('submit',function(e){
        e.preventDefault();

        var exam = $('#exam').val();
        var subject = $('#subject').val();
        var class_code = $('#class').val();
        var student = $('#student').val();
        var grade = $('#grade').val();
        var total_grade = $('#total_grade').val();
        var comment = $('#comment').val();


        if(exam != '' && subject !='' && class_code !='' && student !='' && grade !='' && total_grade!='' && comment!=''){
            $.ajax({
                url:'./data_files/exam.php',
                type:'post',
                dataType:'json',
                data:{exam:exam,subject:subject,class:class_code,student:student,grade:grade,total_grade:total_grade,comment:comment},
                success: function(result){
                    if(result[0]){
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

    // Retrive Exam data
    $('#editGrade').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var dataString = 'retrive_grade_id='+id;
        $.ajax({
            type:'POST',
            url:'./data_files/exam.php',
            data:dataString,
            dataType:'json',
            success: function(result){
                console.log(result);
                modal.find('#grade_exam_id').val(result[0]);
                modal.find('#grade_exam_student').val(result[1]);
                modal.find('#grade_exam_subject').val(result[2]);
                modal.find('#grade_exam_class').val(result[3]);
                modal.find('#grade_exam_grade').val(result[4]);
                modal.find('#grade_exam_total').val(result[5]);
                modal.find('#grade_exam_comment').val(result[6]);
                
            }
        });
    });

    // Edit Grade
    $('#editGrade_form').on('submit',function(e){
        e.preventDefault();

        var grade_id = $('#grade_exam_id').val();
        var student_id = $('#grade_exam_student').val();
        var subject_code = $('#grade_exam_subject').val();
        var class_code = $('#grade_exam_class').val();
        var grade = $('#grade_exam_grade').val();
        var total = $('#grade_exam_total').val();
        var comment = $('#grade_exam_comment').val();

        if(grade_id!='' && student_id!='' && subject_code!='' && class_code!='' && grade!='' && total!='' && comment!=''){
            $.ajax({
                url:'./data_files/exam.php',
                type:'post',
                dataType:'json',
                data:{grade_id:grade_id,stud_id:student_id,sub_code:subject_code,class_code:class_code,grade:grade,total:total,grade_com:comment},
                success: function(result){
                    if(result[0]){
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

    // Delete Grade
    $(document).on('click','.deleteGrade', function(){
        var id =$(this).attr('data-id');
        var $tr = $(this).closest('tr');

        alertify.confirm('Confirm Delete','Are you sure you want to delete this Grade', function()
        { 
            $.ajax({
                url:'./data_files/exam.php',
                type:'Post',
                data:{delete_grade_id:id},
                dataType:'json',
                success: function(result){
                    if(result[0]){
                        $tr.find('td').fadeOut(700,function(){
                            $tr.remove();
                        });
                        // setTimeout(refreshTable,10);
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
        $('.examTable').load('./includes/examTable.php');
    }
});