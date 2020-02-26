<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Nutrition"; //Set the browser title
$highlight = "Nutrition"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

  <scrip type="text/javascript">
    <!-- Put Javascript Here -->
  </scrip>

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

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Nutrition Planner</h5>
              </div>
              <div class="card-body">
                <!-- Place page content here -->
                <h3><p>To determine a nutrition plan that will best work for you we need to gather some information about you</p></h3>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>My age(in years):</label>
                            <input type="text" class="form-control" placeholder="Enter your age here" required>
                            </div>
                           </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                           <label>My weigth(lbs):</label>
                              <input type="text" class="form-control" placeholder="Enter your weight here">
                             </div>
                          </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Target weigth (lbs):</label>
                            <input type="text" class="form-control" placeholder="Enter your target weight here">
                        </div>
                    </div>
                  </div>
                <div class="row">
                    <div class="col-sm-4">
                       <div class="form-group">
                         <label>Sex</label>
                          <select class="form-control">
                          <option>Male</option>
                          <option>Female</option>
                          </select>
                         </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                        <label>Desired outcome</label>
                        <select class="form-control">
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
                        <select class="form-control">
                        <option>No time line</option>
                        <option>Less than 2 months</option>
                        <option>2-4 months</option>
                        <option>4-6 months</option>
                        </select>
                      </div>
                </div>

                </div>
                <h3><p>Please select the body type that most resembles yours based on the graphic and description</p></h3>

                <div class="row">
                   <div class="col-md-4">
                      <div class="card">
                         <div class="card-header">
                              <h3 class="card-title">
                                 Ectomorph
                               </h3>
                         </div>
                              <!-- /.card-header -->
                              <div class="card-body" style="text-align:center;">
                                <div>
                                <img style='height: 60%; width: 60%; object-fit: contain' src="images/ectos.jpg">
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
                                 <img style='height: 60%; width: 60%; object-fit: contain' src="images/mesos.jpg">
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
                                <img style='height: 60%; width: 60%; object-fit: contain' src="images/Endos.jpg">
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
                                                <select class="form-control">
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
                            <img style='height: 50%; width: 50%; object-fit: contain' src="images/fatM.jpg">
                            <img style='height: 50%; width: 50%; object-fit: contain' src="images/fatF.jpg">
                           </div
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>My body fat percentage:</label>
                                <input type="text" class="form-control" placeholder="Enter your body fat % here" required>
                               </div>
                             </div>

                              <div class="col-sm-4">
                                <td>
                                 <button type="button" class="btn btn-block btn-primary">Calculate my nutrition plan</button>
                                </td>
                              </div>



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