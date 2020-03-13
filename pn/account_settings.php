<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Account Settings"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

<head>

  <!-- SweetAlert -->
  <link rel="stylesheet" href="AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>


  <script type="text/javascript">
    $( document ).ready(function() {
      refresh();
    });


    function refresh(){
      $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: 'api/account_settings/get_settings.php',
        success: function(data, status){
          if(data != "ERROR"){
            $('#first_name').val(data['first_name']);
            $('#last_name').val(data['last_name']);
            $('#email').val(data['email']);
            //TODO : Format phone_number
            $('#phone_number').val(data['phone_number']);
            if(data['sex'] == "male" || data['sex'] == "female"){
              $('#sex').val(data['sex']);
            }
            $('#birthdate').val(data['birthdate']);
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'This page failed to load properly.. Please try again later.'
            });
          }
        }
      });
    }


    function changePassword(){
      var old_password = $('#password').val();
      if($('#new_password1').val() != $('#new_password2').val()){
        //Passwords do not match
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Those passwords do not match!'
        });
        return;
      }
      var new_password = $('#new_password1').val();
      $('#changePasswordBtn').attr("disabled", true);
      $.ajax({
        type: "POST",
        data: {
          old_password: old_password,
          new_password: new_password
        },
        url: 'api/auth/change_password.php',
        success: function(data, status){
          $('#changePasswordBtn').attr("disabled", false);
          if(data == "success"){
            $('#old_password').val("");
            $('#new_password1').val("");
            $('#new_password2').val("");
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Your password has been updated.'
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data
            });
          }
        }
      });      
    }


    function saveSettings(){
      $('#saveSettingsBtn').attr("disabled", true);
      $.ajax({
        type: "POST",
        data: {
          first_name: $("#first_name").val(),
          last_name: $("#last_name").val(),
          email: $("#email").val(),
          phone_number: $("#phone_number").val(),
          sex: $("#sex").val(),
          birthdate: $("#birthdate").val()
        },
        url: 'api/account_settings/set_settings.php',
        success: function(data, status){
          $('#saveSettingsBtn').attr("disabled", false);
          if(data == "success"){
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Your account settings have been updated.'
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data
            });
          }
        }
      });      
    }

  </script>

  <style>
    ul {
      margin: 15px;
      padding: 0px;
    }
  </style>
</head>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Account Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Account Settings</a></li>
              <li class="breadcrumb-item active">Account Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary card-outline"> <!--card-secondary for grey format-->
                  <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                  </div> <!-- /.card-header -->
                  <div class="card-body">
                    <div class="form-group">
                      <label for="first_name last_name">Name</label>
                      <input type="text" class="form-control" id="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control" id="phone_number" data-inputmask='mask": "(999) 999-9999"' data-mask="" im-insert="true" placeholder="(___) ___-____">
                    </div>

                    <div class="form-group">
                      <label>Gender</label>
                      <select class="custom-select" id="sex">
                        <option value="unknown">----</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Birthdate</label>
                      <div class="input-group mb-3">
                        <input id="birthdate" type="date" class="form-control" placeholder="Date of Birth" />
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div> <!-- /.card-body -->
                  <div class="card-footer">
                    <button class="btn btn-primary" id="saveSettingsBtn" onclick="saveSettings()">Save Settings</button>
                  </div> <!-- /.card-footer -->
              </div> <!-- /.card-primary -->
            </div> <!-- /.col-md-6 -->

            <div class="col-md-6">
              <div class="card card-primary card-outline"> <!--card-secondary for grey format-->
                  <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                  </div> <!-- /.card-header -->
                  <div class="card-body">
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="new_password1" placeholder="New Password">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="new_password2" placeholder="Confirm New Password">
                    </div>
                  </div> <!-- /.card-body -->

                  <div class="card-footer">
                    <button onclick="changePassword()" id="changePasswordBtn" class="btn btn-primary">Submit</button>
                  </div> <!-- /.card-footer -->
              </div> <!-- /.card-primary -->


            </div> <!-- /.col-md-6 -->
          </div> <!-- /.row -->

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">My Plan</h5>
            </div> <!-- /.card-header -->
            <div class="card-body">
              <!-- Place page content here -->
			  <p>Note: Upgrades will take effect immediately, stopping any future recurring payments under the previous plan. Meanwhile, downgrades will take effect at the end of the billing cycle. Payments cannot be refunded.</p>
              <hr noshade></hr noshade>
              <p>If you would like to cancel your current plan, please <a href="#">click here</a> to confirm with email.</p>
              <div class="row">
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Free!</button>
                        </br><center><h5><b>$0/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li>Access to our free content</li>
                            <li>Free muscle training videos</li>
                            <li>Free nutritional training videos</li>
                            <li>Free guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Beginner</button>
                        </br><center><h5><b>$4/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Free</i></b> plan +</li>
                            <li>Beginner muscle training videos</li>
                            <li>Beginner nutritional training videos</li>
                            <li>Beginner level guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Intermediate</button>
                        </br><center><h5><b>$8/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Beginner</i></b> plan +</li>
                            <li>Intermediate muscle training videos</li>
                            <li>Intermediate nutritional training videos</li>
                            <li>Intermediate level guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Advanced</button>
                        </br><center><h5><b>$12/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Intermediate</i></b> plan +</li>
                            <li>Advanced muscle training videos</li>
                            <li>Advanced nutritional training videos</li>
                            <li>Advanced level guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Personal</button>
                        </br><center><h5><b>$15/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Advanced</i></b> plan +</li>
                            <li>Access to premium content</li>
                            <li>Monthly private coaching with trainers!</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
              </div> <!-- /.row -->
            </div> <!-- /.card-body -->
          </div> <!-- /.card-primary -->

      </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
  </div> <!-- /.content-wrapper -->


  <script src="AdminLTE/plugins/moment/moment.min.js"></script>
  <script src="AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script>
  $(function () {

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()


  });
</script>

<!-- ChartJS -->
<script src="AdminLTE/plugins/chart.js/Chart.min.js"></script>


<?php include('structure/bottom.php'); ?>