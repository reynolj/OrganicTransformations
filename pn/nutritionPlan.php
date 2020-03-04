<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Home"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

  <script type="text/javascript">
    <!-- Put Javascript Here -->
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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                <h5 class="m-0">Card Header Here</h5>
              </div>
              <!-- Place page content here -->
              <div class="card-body">
                   <div class="row">
                            <div class="col-5 col-sm-3">
                              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-plan-tab" data-toggle="pill" href="#vert-tabs-plan" role="tab" aria-controls="vert-tabs-plan" aria-selected="true">My meal plan</a>
                                <a class="nav-link" id="vert-tabs-protein-tab" data-toggle="pill" href="#vert-tabs-protein" role="tab" aria-controls="vert-tabs-protein" aria-selected="false">Protein</a>
                                <a class="nav-link" id="vert-tabs-starch-tab" data-toggle="pill" href="#vert-tabs-starch" role="tab" aria-controls="vert-tabs-starch" aria-selected="false">Starches</a>
                                <a class="nav-link" id="vert-tabs-fruit-tab" data-toggle="pill" href="#vert-tabs-fruit" role="tab" aria-controls="vert-tabs-fruit" aria-selected="false">Fruits</a>
                                <a class="nav-link" id="vert-tabs-fat-tab" data-toggle="pill" href="#vert-tabs-fat" role="tab" aria-controls="vert-tabs-fat" aria-selected="false">Fats</a>
                              </div>
                            </div>
                            <div class="col-7 col-sm-9">
                              <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" id="vert-tabs-plan" role="tabpanel" aria-labelledby="vert-tabs-plan-tab">
                                                                               <div class="card">
                                                                                 <div class="card-header">
                                                                                   <h3 class="card-title">Daily Meals</h3>
                                                                                 </div>
                                                                                 <!-- /.card-header -->
                                                                                 <div class="card-body">
                                                                                   <table class="table table-bordered">
                                                                                     <thead>
                                                                                       <tr>
                                                                                         <th>Meal#</th>
                                                                                         <th>Protein</th>
                                                                                         <th>Starch</th>
                                                                                         <th>Vegetables</th>
                                                                                         <th>Fruits</th>
                                                                                         <th>Fats</th>
                                                                                       </tr>
                                                                                     </thead>
                                                                                     <tbody>
                                                                                       <tr>
                                                                                         <td>1.</td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                         <td>2.</td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                         <td>3.</td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                         <td>4.</td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                         <td></td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                        <td>5.</td>
                                                                                          <td></td>
                                                                                          <td></td>
                                                                                          <td></td>
                                                                                          <td></td>
                                                                                          <td></td>
                                                                                       </tr>
                                                                                     </tbody>
                                                                                   </table>
                                                                                 </div>
                                                                                </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-protein" role="tabpanel" aria-labelledby="vert-tabs-protein-tab">
                                                                       <div class="card">
                                                                                 <div class="card-header">
                                                                                    <h3 class="card-title">Protein</h3>
                                                                                 </div>
                                                                                 <!-- /.card-header -->
                                                                            <div class="card-body">
                                                                                 <table class="table table-bordered">
                                                                                     <thead>
                                                                                          <tr>
                                                                                          <th>Protein</th>
                                                                                          <th>30g</th>
                                                                                          <th>25g</th>
                                                                                          <th>20g</th>
                                                                                          <th>15g</th>
                                                                                          </tr>
                                                                                     </thead>
                                                                                     <tbody>
                                                                                       <tr>
                                                                                          <td>Ground Beef</td>
                                                                                          <td>125g</td>
                                                                                          <td>104g</td>
                                                                                          <td>83g</td>
                                                                                          <td>63g</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td>Steak</td>
                                                                                          <td>114g</td>
                                                                                          <td>95g</td>
                                                                                          <td>76g</td>
                                                                                          <td>57g</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td>Eggs(whole)</td>
                                                                                          <td>5ct</td>
                                                                                          <td>4ct</td>
                                                                                          <td>3ct</td>
                                                                                          <td>3ct</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td>Egg whites</td>
                                                                                          <td>270g</td>
                                                                                          <td>225g</td>
                                                                                          <td>180g</td>
                                                                                          <td>135g</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td>Chicken Breast</td>
                                                                                          <td>100g</td>
                                                                                          <td>83g</td>
                                                                                          <td>67g</td>
                                                                                          <td>50g</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td>Chicken Thighs</td>
                                                                                          <td>116g</td>
                                                                                          <td>95g</td>
                                                                                          <td>78g</td>
                                                                                          <td>59g</td>
                                                                                        </tr>
                                														<tr>
                                                                                          <td>Cod</td>
                                                                                          <td>132g</td>
                                                                                          <td>110g</td>
                                                                                          <td>88g</td>
                                                                                          <td>66g</td>
                                                                                        </tr>
                                														<tr>
                                                                                          <td>Turkey</td>
                                                                                          <td>102g</td>
                                                                                          <td>95g</td>
                                                                                          <td>68g</td>
                                                                                          <td>51g</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                            </div>
                                                                             <!-- /.card-body -->
                                                                       </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-starch" role="tabpanel" aria-labelledby="vert-tabs-starch-tab">
                                                                            <div class="card">
                                                                                 <div class="card-header">
                                                                                     <h3 class="card-title">Starches</h3>
                                                                                 </div>
                                                                                   <!-- /.card-header -->
                                                                                    <div class="card-body">
                                                                                      <table class="table table-bordered">
                                                                                      <thead>
                                                                                         <tr>
                                                                                         <th>Starch</th>
                                                                                         <th>30g</th>
                                                                                         <th>25g</th>
                                                                                         <th>20g</th>
                                                                                         <th>15g</th>
                                                                                         </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                         <tr>
                                                                                          <td>Rice</td>
                                                                                          <td>107g</td>
                                                                                          <td>90g</td>
                                                                                          <td>72g</td>
                                                                                          <td>54g</td>
                                                                                         </tr>
                                                                                         <tr>
                                                                                           <td>Potatoes</td>
                                                                                           <td>145g</td>
                                                                                           <td>120g</td>
                                                                                           <td>96g</td>
                                                                                           <td>72g</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                           <td>Quinoa</td>
                                                                                           <td>141g</td>
                                                                                           <td>118g</td>
                                                                                           <td>3ct</td>
                                                                                           <td>3ct</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                           <td>Turkey</td>
                                                                                           <td>102g</td>
                                                                                           <td>95g</td>
                                                                                           <td>68g</td>
                                                                                           <td>51g</td>
                                                                                           </tr>
                                                                                           </tbody>
                                                                                  </table>
                                                                              </div>
                                                                               <!-- /.card-body -->
                                                                            </div>
                                  </div>
                                  <div class="tab-pane fade" id="vert-tabs-fruit" role="tabpanel" aria-labelledby="vert-tabs-fruit-tab">
                                   <div class="card">
                                      <div class="card-header">
                                          <h3 class="card-title">Starches</h3>
                                      </div>
                                      <!-- /.card-header -->
                                                                                                                      <div class="card-body">
                                                                                                                        <table class="table table-bordered">
                                                                                                                        <thead>
                                                                                                                           <tr>
                                                                                                                           <th>Fruit</th>
                                                                                                                           <th>15g</th>
                                                                                                                           <th>10g</th>
                                                                                                                           </tr>
                                                                                                                          </thead>
                                                                                                                          <tbody>
                                                                                                                           <tr>
                                                                                                                            <td>Watermelon</td>
                                                                                                                            <td>199g</td>
                                                                                                                            <td>132g</td>
                                                                                                                           </tr>
                                                                                                                           <tr>
                                                                                                                             <td>Strawberries</td>
                                                                                                                             <td>195g</td>
                                                                                                                             <td>130g</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                             <td>Apples</td>
                                                                                                                             <td>100g</td>
                                                                                                                             <td>73g</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                             <td>Bananas</td>
                                                                                                                             <td>66g</td>
                                                                                                                             <td>45g</td>
                                                                                                                             </tr>
                                                                                                                             </tbody>
                                                                                                                    </table>
                                                                                                                </div>
                                                                                                                 <!-- /.card-body -->
                                                                                                              </div>
                                  </div>
                                <div class="tab-pane fade" id="vert-tabs-fat" role="tabpanel" aria-labelledby="vert-tabs-fat-tab">
                                fats
                               </div>
                              </div>
                            </div>
                          </div>
                        </div>
               </div><!-- /.container-fluid -->
             </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('structure/bottom.php'); ?>