<?php
// require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | My Plan"; //Set the browser title
$highlight = "my_plan"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

    <head>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">My Plan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">My Plan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div> <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

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
                                        <button type="button" class="btn btn-block plan-welcome-bg elevation-1 font-weight-bold">Welcome</button>
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
                                        <button type="button" class="btn btn-block plan-beginner-bg elevation-1 font-weight-bold">Beginner</button>
                                        </br><center><h5><b>$4/month</b></h5></center>
                                        <hr noshade></hr noshade>
                                        <ul>
                                            <li><b><i>Welcome</i></b> plan +</li>
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
                                        <button type="button" class="btn btn-block plan-intermediate-bg elevation-1 font-weight-bold">Intermediate</button>
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
                                        <button type="button" class="btn btn-block plan-advanced-bg elevation-1 font-weight-bold">Advanced</button>
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
                                        <button type="button" class="btn btn-block plan-personal-bg elevation-1 font-weight-bold">Personal</button>
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

<?php include('structure/bottom.php'); ?>