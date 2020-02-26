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

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="AdminLTE/plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">
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
      <img src="AdminLTE/dist/img/svg/logo.svg" alt="Organic Transformations Logo" class="brand-image" //Removed: img-circle elevation-1
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
          <a href="#" class="d-block"><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="nutrition.php" class="nav-link">
              <i class="nav-icon fas fa-leaf"></i>
              <p>
                Nutrition
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index2.php" class="nav-link">
              <i class="nav-icon fas fa-dumbbell"></i>
              <p>
                Exercises
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index2.php" class="nav-link">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Guides
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index2.php" class="nav-link">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p>
                Private Coaching
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index2.php" class="nav-link">
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

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>