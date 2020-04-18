<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Counseling"; //Set the browser title
$highlight = "counseling"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

<html style="height: auto;"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script type="text/javascript">
        function deleteRequest($apt_id){
            Swal.fire({
                title: 'Delete Request',
                text: "Are you sure you want to delete this counseling request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        data: {
                            apt_id: $apt_id
                        },
                        url: 'api/coaching/delete_counseling_request.php',
                        success: function(data, status){
                            if(data == "success"){

                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data
                                });
                            }
                        }
                    });

                    var table = $('#counseling').DataTable();
                    table.row('#'+$apt_id.toString()).remove().draw();

                    Swal.fire(
                        'Deleted!',
                        'The request has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
</head>
<body>
<div class="wrapper">

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
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="counseling" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Date Requested</th>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Goal</th>
                                    <th>Meeting Topic</th>
                                    <th>Contact Info</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <?php
                                $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                                $stmt = $con->prepare("SELECT * FROM appointments");
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                $stmt->execute();

                                ?>
                                <tbody>
                                <?php while($row = $stmt->fetch()) {
                                    $user_id = $row["user_id"];
                                    $apt_id = $row["appointment_id"];
                                    $sql = $con->prepare("SELECT * FROM users WHERE user_id = ?");
                                    $sql->setFetchMode(PDO::FETCH_ASSOC);
                                    $sql->execute([$user_id]);
                                    $result = $sql->fetch();

                                    switch ($row["preferred_contact"]){
                                        case 'EMAIL':
                                            $contact = $result["email"];
                                            break;
                                        case 'PHONE':
                                            $contact = $result["phone_number"];
                                            break;
                                    }

                                    echo "<tr id=$apt_id>
                                            <td>" . $row["request_date"] . "</td>
                                            <td>" . $result["first_name"] . " " . $result["last_name"]. "</td>
                                            <td>" . $result["sex"] . "</td>
                                            <td>" . $result["desired_outcome"] . "</td>
                                            <td>" . $row["meeting_topic"] . "</td>
                                            <td>" . $contact . "</td>
                                            <td><button type=\"submit\" class=\"btn btn-default\"><i onclick=\"deleteRequest($apt_id)\" class=\"fas fa-calendar-times\"></i></button></td>
                                          </tr>";
                                };
                                ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
    $(function () {
        $("#counseling").DataTable({
            "lengthChange": false,
            "paging": false,
        });
    });
</script>
</body>
</html>

<?php include('structure/bottom.php'); ?>
