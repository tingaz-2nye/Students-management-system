<?php 
    require_once ('includes/functions.php');

    if(student_login()){
        redirect_to('index.php');
    }else if(parent_login()){
        redirect_to('index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School Management</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/default.css">
</head>
<body>
    <div id="particles-js">
        <div class="landing-login">
            <div class="login-overlay">
                <div id="login-wrapper">
                    <h1 class="login-header text-center">Welcome to our Login Panel </h1>
                    <div class="login-content text-center">
                        
                        <form id="login_form" action="" method="post">
                            <h1>Login Form</h1>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <span id="password_error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <!-- <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1"
                                            value="admin" checked> Admin
                                        </label>
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2"
                                            value="teacher">
                                            Teacher
                                        </label>
                                    </div> -->
                                   <select name="user_role" id="user_role" class="form-control" style="color:#001119; margin-top:0px;">
                                        <option value="student">Student</option>
                                        <option value="parent">Parent</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-default btn-sm">Login <span class="fa fa-unlock"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="alertifyjs/alertify.js"></script>
    <script src="js/login.js"></script>
    <script src="js/particles.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
