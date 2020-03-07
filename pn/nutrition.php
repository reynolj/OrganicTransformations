<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Nutrition"; //Set the browser title
$highlight = "nutrition"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

  <script type="text/javascript">
    function calculate(){
    //Check if all the required fields are filled out
          if($('#blood_type :selected').text() == ""
            || $('#body_type :selected').text() == ""
            || $('#current_weight').val() == ""
            || $('#target_fat').val() == ""
            || $('#sex :selected').text() == ""
            || $('#desired_outcome :selected').text() == ""
            || $('#current_fat').val() == ""
            ){
            $('#statusMsg').html("Make sure to fill out every field.");
            return;
          }
          //Check the username length
          if( $('#current_weight').val() < 1 || $('#current_weight').val() > 1000){
            $('#statusMsg').html("PLease enter a valid weight");
            return;
          }

          if( $('#target_fat').val() < 1 || $('#current_fat').val() > 100){
          $('#statusMsg').html("Please enter a valid target fat level");
          return;
          }

          //Disable the login button
          $('#calcBtn').prop('disabled', true);

          //Send the form data
          $.ajax({
            type: "POST",
            dataType: 'text',
            url: 'api/auth/register.php',
            data: {
              blood_type: $('#blood_type :selected').text(),
              body_type: $('#body_type :selected').text(),
              current_weight: $('#current_weight').val(),
              target_fat: $('#target_fat').val(),
              sex: $('#sex :selected'),
              desired_outcome: $('#desired_outcome :selected').text() == ""
              current_fat: $('#current_fat').val()
            },
            success: function(data, status){
              if(data == "success"){
                window.location.replace("login.php?register_success");
              }else{
                $('#statusMsg').html(data);
                $('#loginBtn').prop('disabled', false);
              }
            }
          });
        }
  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Nutrition</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


             <div class="card-body">
                <!-- Place page content here -->
                <h3><p>To determine a nutrition plan that will best work for you we need to gather some information about you</p></h3>
              <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                          <label>Select your blood type.</label>
                           <select id="blood_type" class="form-control">
                               <option>I don&apos;t know my blood type</option>
                               <option>A-</option>
                               <option>A+</option>
                               <option>B-</option>
                               <option>B+</option>
                               <option>AB-</option>
                               <option>AB+</option>
                               <option>O-</option>
                               <option>O+</option>
                           </select>
                    </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>My weigth(lbs):</label>
                       <input id = "current_weight" type="number" class="form-control" placeholder="Enter your weight here">
                    </div>
                  </div>
                <div class="col-sm-4">
                  <div class="form-group">
                       <label>Target body fat:</label>
                           <input id="target_fat" type="number" class="form-control" placeholder="Enter your target body fat percentage here">
                  </div>
                </div>
              </div><!-- /row -->
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                         <label>Sex</label>
                           <select id="sex" class="form-control">
                           <option>Male</option>
                           <option>Female</option>
                         </select>
                  </div>
                </div>
                <div class="col-sm-4">
                   <div class="form-group">
                        <label>Desired outcome</label>
                        <select id="desired_outcome" class="form-control">
                         <option>Burn fat/lose weight</option>
                         <option>Build muscle/bulk up</option>
                         <option>Get shredded (below 8% body fat)</option>
                         <option>Increase performance/athleticism</option>
                        </select>
                   </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>I want to accomplish my goal in:</label>
                        <select id="timeline" class="form-control">
                        <option>No time line</option>
                        <option>Less than 2 months</option>
                        <option>2-4 months</option>
                        <option>4-6 months</option>
                        </select>
                    </div>
                </div>

              </div><!-- /.row -->
                <h3><p>Please select the body type that most resembles yours based on the graphic and description</p></h3>

                <div class="row">
                   <div class="col-md-4">
                      <div class="card">
                         <div class="card-header">
                              <h3 class="card-title">Ectomorph</h3>
                         </div><!-- /.card-header -->
                              <div class="card-body" style="text-align:center;">
                                <div>
                                   <img style='height: 60%; width: 60%; object-fit: contain' src="dist/img/ectos.jpg">
                                </div>
                                <ul style="display: inline-block; text-align: left;">
                                  <li>Skinny</li>
                                  <li>Small joints/bones</li>
                                  <li>Small shoulders</li>
                                  <li>Lightly muscled</li>
                                  <li>Small chest and buttocks</li>
                                  <li>Low body fat</li>
                                  <li>Can eat anything without gaining weight</li>
                                  <li>Fast metabolism</li>
                                  <li>Difficult to gain weight/muscle</li>
                                  </ul>
                              </div>
                              <!-- /.card-body -->
                      </div>
                       <!-- /.card -->
                   </div>
                     <!-- ./col -->
                          <div class="col-md-4">
                            <div class="card">
                              <div class="card-header">
                                  <h3 class="card-title">
                                     Mesomorph
                                    </h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body" style="text-align:center;">
                                 <div>
                                 <img style='height: 60%; width: 60%; object-fit: contain' src="dist/img/mesos.jpg">
                                 </div>
                                  <ul style="display: inline-block; text-align: left;">
                                  <li>Naturally Lean</li>
                                  <li>Naturally muscular</li>
                                  <li>Naturally strong</li>
                                  <li>Medium size joints/bones</li>
                                  <li>Wider at the shoulders than the hips</li>
                                  <li>Broad/ square shoulders</li>
                                  <li>Efficient metabolism</li>
                                  <li>Gain muscle/lose fat with little effort</li>
                                  <li>Responds quickly to exercise</li>
                                  </ul>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                          <!-- ./col -->
                          <div class="col-md-4">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">
                                  Endomorph
                                </h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body" style="text-align:center;">
                                <div>
                                <img style='height: 60%; width: 60%; object-fit: contain' src="dist/img/Endos.jpg">
                                </div>
                                <ul style="display: inline-block; text-align: left;">
                                <li>Soft, round body</li>
                                <li>Short, stocky limbs</li>
                                <li>Big joints/bones</li>
                                <li>Fitted jeans are snug around the hips and glutes</li>
                                <li>Slow metabolism</li>
                                <li>Difficulty losing fat</li>
                                <li>Gain fat and muscle at average rate</li>
                                <li>Lack of muscle definition</li>
                                <li>Large appetite</li>
                                </ul>
                              </div>
                              <!-- /.card-body -->
                            </div>

                      <!-- /.card -->
                   </div>
                          <!-- ./col -->
                </div>

                         <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>My body type is:</label>
                                                <select id="body_type"class="form-control">
                                                <option> </option>
                                                <option>Ectomorph</option>
                                                <option>Mesomorph</option>
                                                <option>Endomorph</option>
                                                </select>
                                              </div>
                                        </div>
                          <div>
                             <h3>
                            <p>Next we have to know your body fat percentage. It is best to go get this tested for a
                            more precise measure, but you can reference these pictures to get a rough estimate</p>
                             </h3>
                            <img style='height: 50%; width: 50%; object-fit: contain' src="dist/img/fatM.jpg">
                            <img style='height: 50%; width: 50%; object-fit: contain' src="dist/img/fatF.jpg">
                          </div>
                          <label>My body fat percentage:</label>
                         <div class="row">
                           <div class="col-sm-4">
                             <div class="form-group">

                                <input id="current_fat" type="number" class="form-control" placeholder="Enter your body fat % here" required>
                             </div>
                           </div>



                            <div class="col-sm-4">
                                <td>
                                 <button id="calcBtn" onclick="calculate()" type="button" class="btn btn-block btn-primary">Calculate my nutrition plan</button>
                                </td>
                            </div>
                         </div>

             </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('structure/bottom.php'); ?>