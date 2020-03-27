<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Members"; //Set the browser title
$highlight = "members"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Members Panel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Members Panel</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div> <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Members</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Member Since</th>
                                        <th>Goal</th>
                                        <th>Plan</th>
                                        <th>Email Address</th>
                                        <th>Billing Cycle Ends</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Male</td>
                                        <td>03/27/2020</td>
                                        <td>Lose 10 lb every 4 months</td>
                                        <td>Beginner</td>
                                        <td>johndoe@email.com</td>
                                        <td>04/27/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Alexander Pierce</td>
                                        <td>Male</td>
                                        <td>03/17/2019</td>
                                        <td>Lose weight</td>
                                        <td>Intermediate</td>
                                        <td>alexanderpierce@email.com</td>
                                        <td>04/17/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Jane Doe</td>
                                        <td>Female</td>
                                        <td>10/07/2018</td>
                                        <td>Get more muscle</td>
                                        <td>Personal</td>
                                        <td>janedoe@email.com</td>
                                        <td>04/07/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Mike Doe</td>
                                        <td>Male</td>
                                        <td>05/01/2017</td>
                                        <td>Bulk up for championship</td>
                                        <td>Advanced</td>
                                        <td>mikedoe@email.com</td>
                                        <td>04/01/2020</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


            </div> <!-- /.container-fluid -->
        </div> <!-- /.content -->
    </div> <!-- /.content-wrapper -->


<?php include('structure/bottom.php'); ?>
