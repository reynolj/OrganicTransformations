<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Home"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
//require("TwitterAPIExchange.php");


?>
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

          <!-- Announcements -->
          <!-- Connecting to twitter may prove difficult, there's a lot more stuff needed than initially thought -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Announcements</h3>
              </div>
              <div class="card-body p-0">
                  <ul class="products-list product-list-in-card">
                      <li class="item">
                          <div class="row product-info ml-3 mr-3">
                              <div class="pl-0 pr-0 col-10">
                                  <div class="product-description">Hello, this is an annoucement!.</div>
                              </div>
                              <div class="text-right pl-0 pr-0 col-2">
                                  <div class="product-description">Added 100 days ago</div>
                              </div>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>

          <!-- Goals -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">My Goals</h3>
              </div>
              <ul class="todo-list">
                  <li class="item">Do the things.</li>
                  <li class="item">Work on stuff.</li>
              </ul>
          </div>

          <!-- Body -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">My Body</h3>
              </div>
          </div>

          <!-- Highlighted For You -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Highlighted For You</h3>
              </div>
          </div>

          <!-- Nutrition Favorites -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Nutrition Favorites</h3>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-4 col-md-6 col-sm-12">
                          <div class="ribbon-wrapper ribbon">
                              <div class="ribbon bg-primary">
                                  PLUS
                              </div>
                          </div>
                          <div class="small-box">
                              <div class="inner">
                                  <img src="https://i.ytimg.com/vi/xGAxmOUk0Hc/maxresdefault.jpg" alt="" width="100%" height="100%">
                              </div>
                              <a class="small-box-footer">
                                  <div class="row pl-1 pr-1">
                                      <div class="text-left col-9">Test</div>
                                      <div class="text-right col-3">MM/DD/YYYY</div>
                                  </div>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Exercise Favorites -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Exercise Favorites</h3>
              </div>
          </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('structure/bottom.php'); ?>