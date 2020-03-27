<?php
if($title == ""){
	$title = "Organic Transformations";
}

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $title ?></title>

  <!-- Favicons -->
  <link href="AdminLTE/dist/img/favicon.png" rel="icon">
  <link href="AdminLTE/dist/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Organic Transformations style -->
  <link rel="stylesheet" href="dist/css/organic-transformations.css">
  <!-- jQuery -->
  <script src="AdminLTE/plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link" style="background-color: #fff;">
      <img src="AdminLTE/dist/img/logo.png" alt="Organic Transformations Logo" class="brand-image" //Removed: img-circle elevation-1
           style="opacity: .9">
      <span class="brand-text font-weight-bold" style="color: #333; font-size: 1.05rem;">Organic</span>
      <span class="brand-text" style="color: #333; font-size: 1.05rem;">Transformations</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="AdminLTE/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="account_settings.php" class="d-block">First Last</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
              <a href="my_plan.php" class="nav-link <?php if($highlight == "my_plan"){ echo "active";} ?>">
                  <i class="nav-icon fas fa-dollar-sign"></i>
                  <p>
                      My Plan
                  </p>
              </a>
          </li>

          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($highlight == "index"){ echo "active";} ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="nutrition.php" class="nav-link <?php if($highlight == "nutrition"){ echo "active";} ?>">
              <i class="nav-icon fas fa-leaf"></i>
              <p>
                Nutrition
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="exercise.php" class="nav-link <?php if($highlight == "exercise"){ echo "active";} ?>">
              <i class="nav-icon fas fa-dumbbell"></i>
              <p>
                Exercise
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="guides.php" class="nav-link <?php if($highlight == "guides"){ echo "active";} ?>">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Guides
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="private_coaching.php" class="nav-link <?php if($highlight == "private_coaching"){ echo "active";} ?>">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p>
                Private Coaching
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="help.php" class="nav-link <?php if($highlight == "help"){ echo "active";} ?>">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Help
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

            <!-- Owner Panel-->
          <?php if($_SESSION['is_admin'] == 1 ){ ?>
            <li class="nav-header">
               OWNER PANELS
            </li>

            <li class="nav-item">
                <a href="" class="nav-link <?php if($highlight == ""){ echo "active";} ?>">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Guides
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link <?php if($highlight == ""){ echo "active";} ?>">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Counseling
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link <?php if($highlight == ""){ echo "active";} ?>">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Members
                    </p>
                </a>
            </li>
            <?php;} ?>

            <div id="owner-panels"></div>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>