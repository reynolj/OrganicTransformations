<?php
// require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | My Plan"; //Set the browser title
$highlight = "my_plan"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

        <!-- User redirected to my_plan -->
        <script type="text/javascript">
            $( document ).ready(function() {
                let required_plan = '<?php echo isset($_GET['required_plan']) ? $_GET['required_plan'] : ""; ?>';
                let current_plan  = '<?php echo isset($_GET['user_plan']) ? $_GET['user_plan'] : ""; ?>';
                console.log(required_plan);
                if ( required_plan != "" && current_plan!=""){
                    Swal.fire({
                        title: "You cannot access this content",
                        html: `<p>Your current plan is <b>${current_plan}</b>. <br> <br> Upgrade your plan to <b>${required_plan}</b> to access this content.<p>`
                    });
                }

                //Temporary Debug
                $('#testing-btn').on('click', function () {
                    $.ajax({
                        type: 'POST',
                        url: 'api/plans/get_subscription_details.php',
                        success: function (data) {
                            console.log("command sent and returned");
                            console.log(data);
                        },
                        error: function () {
                            console.log("ERROR")
                        }
                    })
                })
            });
        </script>
        <!-- SweetAlert -->
        <link rel="stylesheet" href="AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>

        <!--PayPal Source-->
        <script src="https://www.paypal.com/sdk/js?client-id=AWeTuCaNHd2YsixQdR9sRiBy9KvtMo-9jrvH_u-JQeT_X-DgiCARacl-J0WE4lSBBRdFX9uNMAu62B55&vault=true&disable-funding=credit"></script>

        <!--PayPal Script-->
        <script>
            //Advanced Plan
            paypal.Buttons({
                //On click
                createSubscription: function (data, actions) {
                    return createSubscription('P-5AL450891J419652VL2IEBYQ', actions);
                },

                //On approval
                onApprove: function (data, actions) {
                    onApprove('Advanced', data);
                }
            }).render('#paypal-button-container-advanced');

            //Personal Plan
            paypal.Buttons({
                //On click
                createSubscription: function (data, actions) {
                    return createSubscription('P-90906277YJ992482DL2IEDWA', actions);
                },

                //On approval
                onApprove: function (data, actions) {
                    onApprove('Personal', data);
                }
            }).render('#paypal-button-container-personal');

            //On Approval
            function onApprove(plan_name, data) {
                //Notify the user
                Swal.fire({
                    title: 'Thank You!',
                    html: '<p>You have successfully created a <b>' + plan_name + '</b> plan subscription</p>' +
                        '<p>Your subscription-id is <b>' + data.subscriptionID + '</b></p>'
                });
                //TODO Send an email to client with a thank you, subscription confirmation, upgrade/unsubscribe link, and sub-id
                console.log('You have successfully created a ' + plan_name + ' subscription ' + data.subscriptionID);
                send_subscription(data.subscriptionID);
            }

            //On CreateSubscription
            function createSubscription(plan_id, actions) {
                return actions.subscription.create({
                    'plan_id': plan_id
                });
            }

            //send subscription to db
            function send_subscription(subscription_id) {
                console.log('Executing send_subscription');
                $.ajax({
                    type: 'POST',
                    url: 'api/plans/send_subscription.php',
                    data: {
                        subscription_id: subscription_id,
                    },
                    success: function (data) {
                        console.log("command sent and returned");
                        console.log(data);
                    },
                    error: function () {
                        console.log("ERROR")
                    }
                })
            }
        </script>
    </head>


    <body>
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
                        <p>Note: Upgrades will take effect immediately, stopping any future recurring payments under the
                            previous plan. Meanwhile, downgrades will take effect at the end of the billing cycle.
                            Payments cannot be refunded.</p>
                        <hr noshade></hr
                        noshade>
                        <p>If you would like to cancel your current plan, please <a href="#">click here</a> to confirm
                            with email.</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <!-- Place page content here -->
                                        <button id="welcome-banner" type="button"
                                                class="btn btn-block plan-welcome-bg elevation-1 font-weight-bold">
                                            Welcome
                                        </button>
                                        </br>
                                        <center><h5><b>$0/month</b></h5></center>
                                        <hr noshade></hr
                                        noshade>
                                        <ul>
                                            <li>Access to our free content</li>
                                            <li>Free muscle training videos</li>
                                            <li>Free nutritional training videos</li>
                                            <li>Free guides</li>
                                        </ul>
                                    </div> <!-- /.card-body -->
                                </div> <!-- /.card-primary -->
                            </div> <!-- /.col -->
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <!-- Place page content here -->
                                        <button type="button"
                                                class="btn btn-block plan-advanced-bg elevation-1 font-weight-bold">
                                            Advanced
                                        </button>
                                        </br>
                                        <center><h5><b>$19.99/month</b></h5></center>
                                        <hr noshade></hr
                                        noshade>
                                        <ul>
                                            <li><b><i>Intermediate</i></b> plan +</li>
                                            <li>Advanced muscle training videos</li>
                                            <li>Advanced nutritional training videos</li>
                                            <li>Advanced level guides</li>
                                        </ul>
                                        <div id="paypal-button-container-advanced"></div>
                                    </div> <!-- /.card-body -->
                                </div> <!-- /.card-primary -->
                            </div> <!-- /.col -->
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <!-- Place page content here -->
                                        <button type="button"
                                                class="btn btn-block plan-personal-bg elevation-1 font-weight-bold">
                                            Personal
                                        </button>
                                        </br>
                                        <center><h5><b>$39.99/month</b></h5></center>
                                        <hr noshade></hr
                                        noshade>
                                        <ul>
                                            <li><b><i>Advanced</i></b> plan +</li>
                                            <li>Access to premium content</li>
                                            <li>Monthly private coaching with trainers!</li>
                                        </ul>
                                        <div id="paypal-button-container-personal"></div>
                                    </div> <!-- /.card-body -->
                                </div> <!-- /.card-primary -->
                            </div> <!-- /.col -->
                        </div> <!-- /.row -->
                        <!--TODO Debug Button, rmv later-->
                        <button class="btn btn-block btn-primary" id="testing-btn"> TESTING BUTTON</button>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card-primary -->

            </div> <!-- /.container-fluid -->
        </div> <!-- /.content -->
    </div> <!-- /.content-wrapper -->
    </body>

    </html>

<?php include('structure/bottom.php'); ?>