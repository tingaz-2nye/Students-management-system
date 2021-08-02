$(document).ready(function () {
  $('#login_form').on('submit', function (e) {
    e.preventDefault();
    console.log('clicked');
    var email = $('#email').val();
    var password = $('#password').val();
    var user_role = $('#user_role').val();

    if (email != '' && password != '' && user_role != '') {
      $.ajax({
        url: './data_files/login.php',
        type: 'post',
        dataType: 'json',
        data: { email: email, password: password, user_role: user_role },
        success: function (result) {
          console.log(result);
          if (result[0]) {
            alertify.notify(result[0], 'custom_success', 2, function () {
              console.log('dismissed');
            });
            setTimeout(function () {
              window.location.href = './index.php';
            }, 200);
          } else if (result[1]) {
            alertify.notify(result[1], 'custom_error', 2, function () {
              console.log('dismissed');
            });
          }
        },
      });
    }
  });

  $('#passwordChange').on('submit', function (e) {
    e.preventDefault();

    var oldpassword = $('#cpassword').val();
    var newPass = $('#cpwd').val();

    if (oldpassword != '' && newPass != '') {
      $.ajax({
        url: './data_files/login.php',
        type: 'post',
        dataType: 'json',
        data: { password: oldpassword, newPass: newPass },
        success: function (result) {
          if (result[0]) {
            $('#passwordChange input').val('');
            alertify.notify(result[0], 'custom_success', 2, function () {
              console.log('dismissed');
            });
          } else if (result[1]) {
            alertify.notify(result[1], 'custom_error', 2, function () {
              console.log('dismissed');
            });
          }
        },
      });
    }
  });

  $('#Parent_passwordChange').on('submit', function (e) {
    e.preventDefault();

    var oldpassword = $('#cpassword').val();
    var newPass = $('#cpwd').val();

    if (oldpassword != '' && newPass != '') {
      $.ajax({
        url: './data_files/login.php',
        type: 'post',
        dataType: 'json',
        data: { Ppassword: oldpassword, PnewPass: newPass },
        success: function (result) {
          if (result[0]) {
            $('#Parent_passwordChange input').val('');
            alertify.notify(result[0], 'custom_success', 2, function () {
              console.log('dismissed');
            });
          } else if (result[1]) {
            alertify.notify(result[1], 'custom_error', 2, function () {
              console.log('dismissed');
            });
          }
        },
      });
    }
  });
});
