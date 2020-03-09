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
                            <!-- Place page content here -->
                 <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                       <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" id="custom-tabs-two-plan-tab" data-toggle="pill" href="#custom-tabs-two-plan" role="tab" aria-controls="custom-tabs-plan-home" aria-selected="true">My meal plan</a>
                                              </li>
                          <li class="nav-item">
                               <a class="nav-link" id="custom-tabs-two-protein-tab" data-toggle="pill" href="#custom-tabs-two-protein" role="tab" aria-controls="custom-tabs-two-protein" aria-selected="false">Protein</a>
                          </li>
                          <li class="nav-item">
                               <a class="nav-link" id="custom-tabs-two-starch-tab" data-toggle="pill" href="#custom-tabs-two-starch" role="tab" aria-controls="custom-tabs-two-starch" aria-selected="false">Starches</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-two-fruit-tab" data-toggle="pill" href="#custom-tabs-two-fruit" role="tab" aria-controls="custom-tabs-two-fruit" aria-selected="false">Fruits</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-two-fats-tab" data-toggle="pill" href="#custom-tabs-two-fats" role="tab" aria-controls="custom-tabs-two-fats" aria-selected="false">Fats</a>
                          </li>
                       </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                           <div class="tab-pane fade active show" id="custom-tabs-two-plan" role="tabpanel" aria-labelledby="custom-tabs-two-plan-tab">
                                <div class="card-body p-0">
                                    <table class="table">
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
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                           </tr>
                                           <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                           </tr>
                                           <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                           </tr>
                                           <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                           </tr>
                                           <tr>
                                             <td></td>
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

                           <div class="tab-pane fade" id="custom-tabs-two-protein" role="tabpanel" aria-labelledby="custom-tabs-two-protein-tab">
                                 <div class="card-body p-0">
                                     <table class="table">
                                          <thead>
                                              <tr>
                                                 <th>Protein</th>
                                                 <th>30g</th>
                                                 <th>25g</th>
                                                 <th>20g</th>
                                                 <th>15g</th>
                                                 <th>1g</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 <td>Ground Beef</td>
                                                 <td>125g</td>
                                                 <td>104g</td>
                                                 <td>83g</td>
                                                 <td>63g</td>
                                                 <td>4.2g</td>
                                              </tr>
                                              <tr>
                                                <td>Steak</td>
                                                <td>114g</td>
                                                <td>95g</td>
                                                <td>76g</td>
                                                <td>57g</td>
                                                <td>3.8g</td>
                                              </tr>
                                              <tr>
                                                 <td>Eggs(whole)</td>
                                                 <td>5ct</td>
                                                 <td>4ct</td>
                                                 <td>3ct</td>
                                                 <td>3ct</td>
                                                 <td>1egg/6g</td>
                                              </tr>
                                              <tr>
                                                 <td>Egg whites</td>
                                                 <td>270g</td>
                                                 <td>225g</td>
                                                 <td>180g</td>
                                                 <td>135g</td>
                                                 <td>9g</td>
                                              </tr>
                                              <tr>
                                                 <td>Chicken Breast</td>
                                                 <td>100g</td>
                                                 <td>83g</td>
                                                 <td>67g</td>
                                                 <td>50g</td>
                                                 <td>3.3</td>
                                              </tr>
                                              <tr>
                                                 <td>Chicken Thighs</td>
                                                 <td>116g</td>
                                                 <td>95g</td>
                                                 <td>78g</td>
                                                 <td>59g</td>
                                                 <td>3.9g</td>
                                              </tr>
                                              <tr>
                                                 <td>Cod</td>
                                                 <td>132g</td>
                                                 <td>110g</td>
                                                 <td>88g</td>
                                                 <td>66g</td>
                                                 <td>4.4g</td>
                                              </tr>
                                              <tr>
                                                 <td>Turkey</td>
                                                 <td>102g</td>
                                                 <td>95g</td>
                                                 <td>68g</td>
                                                 <td>51g</td>
                                                 <td>3.4g</td>
                                              </tr>
                                          </tbody>
                                     </table>
                                 </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-two-starch" role="tabpanel" aria-labelledby="custom-tabs-two-starch-tab">
                                <div class="card-body p-0">
                                   <table class="table">
                                     <thead>
                                        <tr>
                                          <th>Starch</th>
                                          <th>30g</th>
                                          <th>25g</th>
                                          <th>20g</th>
                                          <th>15g</th>
                                          <th>1g</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        <tr>
                                          <td>Rice</td>
                                          <td>107g</td>
                                          <td>90g</td>
                                          <td>72g</td>
                                          <td>54g</td>
                                          <td>3.6g</td>
                                        </tr>
                                        <tr>
                                          <td>Potatoes</td>
                                          <td>145g</td>
                                          <td>120g</td>
                                          <td>96g</td>
                                          <td>72g</td>
                                          <td>4.8g</td>
                                        </tr>
                                        <tr>
                                          <td>Quinoa</td>
                                          <td>141g</td>
                                          <td>118g</td>
                                          <td>3ct</td>
                                          <td>3ct</td>
                                          <td>4.7g</td>
                                        </tr>
                                     </tbody>
                                   </table>
                                </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-two-fruit" role="tabpanel" aria-labelledby="custom-tabs-two-fruit-tab">
                                <div class="card-body p-0">
                                   <table class="table">
                                       <thead>
                                          <tr>
                                            <th>Fruit</th>
                                            <th>15</th>
                                            <th>10</th>
                                            <th>5</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                            <td>Watermelon</td>
                                            <td>199g</td>
                                            <td>132g</td>
                                            <td>66g</td>
                                          </tr>
                                          <tr>
                                            <td>Strawberries</td>
                                            <td>195g</td>
                                            <td>130g</td>
                                            <td>65g</td>
                                          </tr>
                                          <tr>
                                            <td>Apples</td>
                                            <td>100g</td>
                                            <td>73g</td>
                                            <td>37g</td>
                                          </tr>
                                          <tr>
                                            <td>Bananas</td>
                                            <td>66g</td>
                                            <td>45g</td>
                                            <td>33g</td>
                                          </tr>
                                          <tr>
                                            <td>Berries</td>
                                            <td>125g</td>
                                            <td>83g</td>
                                            <td>42g</td>
                                          </tr>
                                          <tr>
                                            <td>Cantaloupe</td>
                                            <td>171g</td>
                                            <td>114g</td>
                                            <td>57g</td>
                                          </tr>
                                          <tr>
                                            <td>Mango</td>
                                            <td>66g</td>
                                            <td>44g</td>
                                            <td>22g</td>
                                          </tr>
                                          <tr>
                                            <td>Pineapple</td>
                                            <td>114g</td>
                                            <td>76g</td>
                                            <td>38g</td>
                                          </tr>
                                       </tbody>
                                   </table>
                                </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-two-fats" role="tabpanel" aria-labelledby="custom-tabs-two-fats-tab">
                               <div class="card-body p-0">
                                  <table class="table">
                                     <thead>
                                       <th>Fats</th>
                                     </thead>
                                     <tbody>
                                     </tbody>
                                  </table>
                               </div>
                           </div>
                        </div>
                    </div>
                    <!-- /.card -->
                 </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('structure/bottom.php'); ?>