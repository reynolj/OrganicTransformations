<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OT | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script type="text/javascript">
    function process(){
      //Check if all the required fields are filled out
      if( $('#username').val().length < 5 || $('#username').val().length > 50){
        $('#statusMsg').html("That username is invalid.");
        return;
      }
      
      //Check the password length
      if( $('#password').val().length < 5 || $('#password').val().length > 50){
        $('#statusMsg').html("That password is too short or too long.");
        return;
      }

      //Disable the login button
      $('#loginBtn').prop('disabled', true);

      //Send the form data
      $.ajax({
        type: "POST",
        dataType: 'text',
        url: 'api/auth/login.php',
        data: {
          username: $('#username').val(),
          password: $('#password').val()
        },
        success: function(data, status){
          if(data == "created"){
            window.location.replace("login.php?register_success");
          }else{
            $('#statusMsg').html(data);
            $('#loginBtn').prop('disabled', false);
          }
        }
      });
    }

  </script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Organic</b>Transformations
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg" id="statusMsg">Create a new account.</p>

      <div class="input-group mb-3">
        <input id="first_name" type="text" class="form-control" placeholder="First Name">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="last_name" type="text" class="form-control" placeholder="Last Name">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="email" type="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="username" type="text" class="form-control" placeholder="Username">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="password" type="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="phone_number" type="tel" class="form-control" placeholder="Phone Number">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-phone"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="birthdate" type="date" class="form-control" placeholder="Date of Birth">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-calendar"></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="terms_agreed" value="" required>
            <label for="terms_agreed">
             I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button id="loginBtn" onclick="register()" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
      </div>

      <a href="login.php" class="text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE/dist/js/adminlte.min.js"></script>
</body>
</html>
