<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Home"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>
<html>
<head>
  <script type="text/javascript">
    $( window ).on( "load", function() {
      // load session range
      // load email
      // load phone number
      let f_date = new Date();
      let l_date;
      let yyyy = f_date.getFullYear();
      let mm = String(f_date.getMonth() + 1).padStart(2, '0'); //Gets month and pads with 0 if needed
      let fd = String(1).padStart(2, '0'); //Creates string 01 which is first day of month
      let ld = String(new Date(yyyy, mm, 0).getDate()); // Creates string of last day of month
      f_date = mm + '/' + fd + '/' + yyyy; //First date
      l_date = mm + '/' + ld + '/' + yyyy; //Last date
      const date_range = f_date + " - " + l_date;
      document.getElementById("date").innerHTML = date_range;
      get_info();
      });

    function formatPhoneNumber(phoneNumberString) {
        let cleaned = ('' + phoneNumberString).replace(/\D/g, '')
        let match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/)
        if (match) {
            return '(' + match[1] + ') ' + match[2] + '-' + match[3]
        }
        return null
    }

    function disable_button(button){
        if (button.id === "email_btn"){
            $('#email_btn').prop('disabled', true);
            $('#phone_number_btn').prop('disabled', false);
        }
        else {
            $('#phone_number_btn').prop('disabled', true);
            $('#email_btn').prop('disabled', false);
        }
    }


    function get_info() {
        $.ajax({
            type: 'POST',
            url: 'api/coaching/contactInfo.php',
            success: function(data) {
                let json = JSON.parse(data);
                for(let key in json) {
                    if(json.hasOwnProperty(key)) {
                        document.getElementById("email_btn").innerHTML = json[key]['email'] + " (Recommended)";
                        document.getElementById("phone_number_btn").innerHTML = formatPhoneNumber(json[key]['phone_number']);
                        break;
                    }
                }
            },
            error: function() {
                console.log("Get_Info ERROR");
            }
        });
    }

    function coach_request() {
        let goals_text = document.getElementById("goals").innerText;
        $.ajax({
            type: 'POST',
            url: 'api/coaching/coachingRequest.php',
            data:{ goals: goals_text },
            success: function(data) {
                document.getElementById("onRequest").innerHTML = "change this";
            },
            error: function() {
                console.log("Coach_request ERROR");
            }
        });
    }



  </script>

 <style>
   p.coach_white{
     font-size: x-large;
     text-align: center;
     color: white;
     line-height: 70%;
     font-family: Arial, Helvetica, sans-serif;
   }

   p.coach_black{
     font-size: x-large;
     text-align: center;
     color: black;
     line-height: 70%;
     font-family: Arial, Helvetica, sans-serif;
   }
 </style>
</head>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Private Coaching</h1>
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
      <!-- Body -->
      <div class="card">
        <div class="card-body" style = "background-color:#17a2b8">
          <div id = "onRequest">
            <!-- Thank You-->
            <p class = "coach_white"><b><i>Thank You</i></b> for being an <i>Athlete</i> member! </p>
            <p class = "coach_white">Every month you can request counseling with either one of us, <b>Doug</b> or <b>Dan</b>.</p>
            <!-- Plan Cycle -->
            <p class = "coach_black"><b> Session for plan cycle</b></p>
            <p class = "coach_black"><b id = "date"></b></p>
            <!-- Instructions-->
            <p class = "coach_white"><b>Simply</b> let us know your <b>goals</b> and/or <b>concerns</b> in the field below</p>
            <p class = "coach_white">and we will contact you for private coaching if possible.*</p>
            <!-- Text Box -->
            <textarea id="goals" class="form-control" rows="3" maxlength = "918" placeholder="Enter your goals/concerns..."></textarea>
            <!-- Contact text -->
            <p class = coach_black><br><b>"I would like to be contacted via my..."</b></p>
          </div>
          <!-- Email/Phone number Buttons -->
          <div class="btn-group" style = "display: flex; align-items: center; justify-content: center" >
            <button id = "email_btn"
              class="btn btn-primary"
              style="text-align: center; color: black; background-color:GhostWhite;border-color:LightGrey;"
              onclick="disable_button(this)">
            </button>
            <button id = "phone_number_btn"
              class="btn btn-primary"
              style="text-align: center; color: black; background-color:GhostWhite;border-color:LightGrey;"
              onclick="disable_button(this)">
            </button>
          </div>

          <div style="display: flex; align-items: center; justify-content:center;">
            <button id = "submit_btn"
                    class = btn-lg
                    style="text-align: center; color: white; background-color:Black"
                    onclick="coach_request()">
              Done! Request my session with Doug/Dan!
            </button>
          </div>

          <p class = "coach_white" style ="font-size: medium"><b><br><br>*Meetings every month are not guaranteed and depend on our demand as private trainers</b>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</html>

<?php include('structure/bottom.php'); ?>