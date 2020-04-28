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
            $(document).ready(function () {
                let required_plan = '<?php echo isset($_GET['required_plan']) ? $_GET['required_plan'] : ""; ?>';
                let current_plan = '<?php echo isset($_GET['user_plan']) ? $_GET['user_plan'] : ""; ?>';
                // console.log(required_plan);
                if (required_plan != "" && current_plan != "") {
                    Swal.fire({
                        title: "You cannot access this content",
                        html: `<p>Your current plan is <b>${current_plan}</b>. <br> <br> Upgrade your plan to <b>${required_plan}</b> to access this content.<p>`
                    });
                }

                //Temporary Debug
                $('#test-details-btn').on('click', function () {
                    $.ajax({
                        type: 'POST',
                        url: 'api/plans/get_subscription_details.php',
                        data: {
                            subscription_id: 'I-D3J56HG28SUG',
                        },
                        success: function (data) {
                            console.log("command sent and returned");
                            console.log(data);
                        },
                        error: function () {
                            console.log("ERROR")
                        }
                    })
                });
                $('#test-cancel-btn').on('click', function () {
                    cancel_subscription('I-D3J56HG28SUG','no like');
                });
                $('#test-update-all-btn').on('click', function () {
                    $.ajax({
                        type: 'POST',
                        url: 'api/plans/update_all_premium_states_db.php',
                        success: function (data) {
                            console.log("command sent and returned");
                            console.log(data);
                        },
                        error: function () {
                            console.log("ERROR")
                        }
                    });
                    //Reload the page
                    location.reload();
                });
                $('#show-subscription-btn').on('click', function () {
                    $.ajax({
                        type: 'POST',
                        url: 'api/plans/get_user_subscriptions.php',
                        success: function (data) {
                            console.log("command sent and returned");
                            console.log(data);
                            const subscriptions = JSON.parse(data);
                            display_subscriptions(subscriptions);
                        },
                        error: function () {
                            console.log("ERROR")
                        }
                    });
                });
            });

            function display_subscriptions(subscriptions) {
                let $html_sub_section = $('#my-subscription');
                $html_sub_section.html("");
                //Display warning if there is more than one subscription
                let num_of_subs = Object.keys(subscriptions).length;
                console.log(num_of_subs);
                if(num_of_subs >= 1){
                    Swal.fire({
                        title: 'Warning!\nMultiple Subscriptions',
                        type: 'warning',
                        html: '<p>You are signed up for <b>'+num_of_subs+'</b> subscriptions.</p>' +
                            '<p>You should only have <b>one</b> premium subscription at a time.</p>' +
                            '<p>Please <b>cancel</b> the subscription(s) you do not wish to keep on this page or through your PayPal dashboard.</p>' +
                            '<p>Unfortunately we are not able to offer refunds. If you have any questions please see the Help page.</p>'
                    });
                }
                subscriptions.forEach(function (sub) {
                    let $subscriptionRow;
                    $.ajax({
                        type: 'POST',
                        url: 'api/plans/get_complete_subscription_details.php',
                        data: {
                            subscription_id: sub['subscription_id']
                        },
                        success: function (data_sub_details) {
                            console.log(data_sub_details);
                            $subscriptionRow = subscription_row($html_sub_section, JSON.parse(data_sub_details));
                        },
                        error: function () {
                            console.log("ERROR")
                        }
                    });
                });
            }

            function subscription_row(container,sub) {
                //Debug
                console.log(sub);
                let $card = $('<div>').addClass("card card-primary card-outline elevation-2");
                //Header
                let $card_header = $('<div>').addClass("card-header");
                $card_header.append($('<h2>').addClass("card-title").html("Your <b>" + sub['plan_name'] + "</b> Plan:"));

                //Body
                let $card_body = $('<div>').addClass("card-body row margin");
                //Col 1
                let $col1 = $('<div>').addClass("col-md-3");
                let $sub_id_header = $('<p>').html('Subscription ID:');
                let $sub_id = $('<p>').html('<b>'+sub['id'] +'</b>');
                $col1.append($sub_id_header);
                $col1.append($sub_id);
                //Col 2
                let $col2 = $('<div>').addClass("col-md-3");
                let $name_header = $('<p>').html('Name:');
                let name = sub['subscriber']['name'];
                console.log(name);
                let $name = $('<p>').html('<b>'+ name['given_name'] +' '+ name['surname'] +'</b>');
                $col2.append($name_header);
                $col2.append($name);
                //Col 3
                let $col3 = $('<div>').addClass("col-md-3");
                let $created_header = $('<p>').html('Created on:');
                let $created = $('<p>').html('<b>'+sub['create_time'] +'</b>');
                $col3.append($created_header);
                $col3.append($created);
                //Col4
                let $col4 = $('<div>').addClass("col-md-3");
                let $next_billing_header = $('<p>').html('Next Billing Time:');
                let $next_billing = $('<p>').html('<b>'+sub['billing_info']['next_billing_time'] +'</b>');
                $col4.append($next_billing_header);
                $col4.append($next_billing);
                //Footer
                let $card_footer = $('<div>').addClass("card-footer").append();
                let $cancellation_btn = $('<button>').addClass("btn btn-warning float-right").html("Cancel Subscription");
                $card_footer.append($cancellation_btn);

                //Construct
                $card.append($card_header);
                $card.append($card_body);
                $card_body.append($col1);
                $card_body.append($col2);
                $card_body.append($col3);
                $card_body.append($col4);
                $card.append($card_footer);

                container.append($card);

                $cancellation_btn.on('click', function () {
                    console.log("clicked");
                    cancellationAlert(sub['id'])
                });

                return $card;
            }

            async function cancellationAlert(id) {
                try{
                    const { value: text } = await Swal.fire({
                        title: 'Cancellation Confirmation',
                        text: "You won't be able to undo this action. PayPal requires a reason. Needs to be less than 255 characters.",
                        type: 'warning',
                        input: 'textarea',
                        inputPlaceholder: 'Provide a reason for PayPal...',
                        inputAttributes: {
                            'aria-label': 'Provide a reason for PayPal'
                        },
                        showCancelButton: true
                    });

                    if (text) {
                        cancel_subscription(id,text);
                    }
                }catch(e){
                    // Fail!
                    console.error(e);
                }
            }

            function cancel_subscription(sub_id, reason) {
                $.ajax({
                    type: 'POST',
                    url: 'api/plans/cancel_subscription.php',
                    data: {
                        sub_id_to_cancel: sub_id,
                        reason: reason
                    },
                    success: function (data) {
                        console.log("command sent and returned: Cancellation should have been executed");
                        console.log(data);
                    },
                    error: function () {
                        console.log("ERROR")
                    }
                });
                location.reload();
            }


        </script>
        <!-- SweetAlert -->
        <link rel="stylesheet" href="AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
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
                <div class="card card-outline">
                    <div class="card-header">
                        <h5 class="m-0">My Plan</h5>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Place page content here -->
                        <p style="text-align: center;">Your current plan is
                            <button class="btn elevation-2 font-weight-bold <?php echo $plan_class ?>"><?php echo $plan_text ?></button>
                        </p>
                        <hr noshade></hr
                        noshade>
                        <p style="text-align: center;">
                            <button class="btn btn-primary elevation-1 font-weight-bold" id="show-subscription-btn">Show
                                my Subscription details
                            </button>
                        </p>

                        <div class="col-md-12" id="my-subscription">
                            <!--Display subscription(s) here-->
                        </div>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card-primary -->


                <div class="card card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Plans</h5>
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
                                                class="btn btn-block plan-free-bg elevation-1 font-weight-bold">
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
                                            <li><b><i>Free</i></b> plan +</li>
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

                    </div> <!-- /.card-body -->
                </div> <!-- /.card-primary -->

                <!--TODO DEBUG ONLY-->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Testing</h5>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Place page content here -->
                        <!--TODO Debug Button, rmv later-->
                        <button class="btn btn-block btn-primary" id="test-details-btn"> SUBSCRIPTION DETAILS</button>
                        <button class="btn btn-block btn-primary" id="test-cancel-btn"> CANCEL</button>
                        <button class="btn btn-block btn-primary" id="test-update-all-btn">UPDATE ALL</button>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card-primary -->

            </div> <!-- /.container-fluid -->
        </div> <!-- /.content -->
    </div> <!-- /.content-wrapper -->
    </body>

    <!--PayPal Source-->
    <script src="https://www.paypal.com/sdk/js?client-id=AWeTuCaNHd2YsixQdR9sRiBy9KvtMo-9jrvH_u-JQeT_X-DgiCARacl-J0WE4lSBBRdFX9uNMAu62B55&vault=true&disable-funding=credit"></script>

    <!--PayPal Script-->
    <script>
        //TODO Final touch, disable PayPal button depending on the plan you arleady have
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
            send_subscription(data.subscriptionID);
            //Notify the user
            Swal.fire({
                title: 'Thank You!',
                html: '<p>You have successfully created a <b>' + plan_name + '</b> plan subscription</p>' +
                    '<p>Your subscription-id is <b>' + data.subscriptionID + '</b></p>'
            }).then((result) => {location.reload()});
            //TODO Send an email to client with a thank you, subscription confirmation, upgrade/unsubscribe link, and sub-id
            console.log('You have successfully created a ' + plan_name + ' subscription ' + data.subscriptionID);
            console.log(data);
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
                url: 'api/plans/db_send_subscription.php',
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

    </html>

<?php include('structure/bottom.php'); ?>