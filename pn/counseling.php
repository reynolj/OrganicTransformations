<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Counseling"; //Set the browser title
$highlight = "counseling"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Counseling Panel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Counseling Panel</li>
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
                                <h3 class="card-title">Counseling Requests</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input id="search-input" type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button id="search-submit" type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="counseling-table" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Date Requested</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Member Since</th>
                                        <th>Goal</th>
                                        <th>Plan</th>
                                        <th>Billing Cycle Ends</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>03/27/2020</td>
                                        <td>John Doe</td>
                                        <td>Male</td>
                                        <td>03/27/2020</td>
                                        <td>Lose 10 lb every 4 months</td>
                                        <td>Beginner</td>
                                        <td>04/27/2020</td>
                                        <td><button type="submit" class="btn btn-default"><i class="fas fa-calendar-times"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>03/17/2020</td>
                                        <td>Alexander Pierce</td>
                                        <td>Male</td>
                                        <td>03/17/2019</td>
                                        <td>Lose weight</td>
                                        <td>Intermediate</td>
                                        <td>04/17/2020</td>
                                        <td><button type="submit" class="btn btn-default"><i class="fas fa-calendar-times"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>03/07/2020</td>
                                        <td>Jane Doe</td>
                                        <td>Female</td>
                                        <td>10/07/2018</td>
                                        <td>Get more muscle</td>
                                        <td>Personal</td>
                                        <td>04/07/2020</td>
                                        <td><button type="submit" class="btn btn-default"><i class="fas fa-calendar-times"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>03/01/2020</td>
                                        <td>Mike Doe</td>
                                        <td>Male</td>
                                        <td>05/01/2017</td>
                                        <td>Bulk up for championship</td>
                                        <td>Advanced</td>
                                        <td>04/01/2020</td>
                                        <td><button type="submit" class="btn btn-default"><i class="fas fa-calendar-times"></i></button></td>
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
