<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Home"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML


?>
<html>
<head>
<!--  <script type="module" src="api/dashboard/dashboard.js"></script>-->
<!--    <script type="module" src="api/guides/Guide.js"></script>-->

<!--    Reference: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules-->
<!--    Reference: https://stackoverflow.com/questions/44590393/es6-modules-undefined-onclick-function-after-import-->

<!--    TODO for Joel:  Goals ID should use goal id from database instead of goal text -->
<!--    TODO why is the Add a goal button added via script and not apart of the html-->
  <script type="module">
      import Guide from './api/guides/Guide.js';

      let guides = Array();
      let goal_len = 0;

      $( window ).on( "load", function() {
          // $('#highlighted_guides').html(page_nav.get_current_page_html());
          get_body();
          get_goals();
          get_guides(['highlighted', 'nutrition', 'exercise']);
      });

      function get_body() {
          $.ajax({
              type: 'POST',
              url: '/pn/api/nutri/get_nutrition.php',
              success: function(data) {
                  let json = JSON.parse(data);
                  for(let key in json) {
                      if(json.hasOwnProperty(key)) {
                          $('#blood_type').val(json[key]['blood_type']);
                          $('#body_type').val(json[key]['body_type']);
                          $('#weight').val(json[key]['current_weight']);
                          $('#activity_level').val(json[key]['activity_lvl']);
                          break;
                      }
                  }
              },
              error: function() {
                  console.log("Get_Body ERROR");
              }
          });
      }

      function save_body() {
          $('#save_body_btn').prop('disabled', true);
          const blood_type = $('#blood_type').val();
          const body_type = $('#body_type').val();
          const weight = $('#weight').val();
          const activity_level = $('#activity_level').val();
          $.ajax({
              type: 'POST',
              url: '/pn/api/nutri/save_nutrition.php',
              data: {
                  blood_type: blood_type,
                  body_type: body_type,
                  weight: weight,
                  activity_level: activity_level
              },
              success: function() {
                  $('#save_body_btn').prop('disabled', false);
              },
              error: function() {
                  $('#add_goal_btn').prop('disabled', false);
                  console.log("Get_Body ERROR");
              }
          });
      }

      function get_goals() {
          $.ajax({
              type:'POST',
              url: '/pn/api/dashboard/get_goals.php',
              success: function(data) {
                  let goal_str = Array();
                  const json = JSON.parse(data);
                  for(let key in json) {
                      if (json.hasOwnProperty(key))
                          goal_str.push(
                              '<li>' +
                              json[key]['goal'] +
                              '<button type="button" ' +
                              'class="delete-goal close text-right" ' +
                              'id="' + json[key]['goal'] + '"">' +
                              '×' +
                              '</button>' +
                              '</li>');
                  }
                  goal_str.push(
                      '<li class="text-right" id="last_goal_line">' +
                      '<button class="btn btn-primary" id="add_goal_btn" ' +
                      'style="background-color:green;border-color:green;height:100%">' +
                      'Add Goal' +
                      '</button>' +
                      '</li>'
                  );
                  $(document).on('click','#add_goal_btn', function (){
                      add_goal();
                  });
                  $(document).on('click','.delete-goal', function (){
                      console.log($(this));
                      delete_goal($(this));
                  });
                  $('#goals').html(goal_str);
              },
              error: function() {
                  console.log("Get_Goals ERROR");
              }
          });
      }

      function add_goal() {
          console.log('adding goal');
          $('#last_goal_line').before(
              '<li id="add_goal_line">' +
              '<div class="row">' +
              '<input id="goal_input" class="form-control col-11" type="text" placeholder="New Goal">' +
              '<button class="btn btn-primary col-1" id="submit_goal_btn"> ' +
              '<i class="fas fa-plus"> </i>' +
              '</button>' +
              '</div>' +
              '</li>'
          );
          $(document).on('click','#submit_goal_btn', function (){
              submit_goal();
          });
          $('#add_goal_btn').prop('disabled', true);
      }

      function submit_goal() {
          const goal = $('#goal_input').val();
          if(goal === "") {
              return;
          }
          $.ajax({
              type: 'POST',
              url: '/pn/api/dashboard/submit_goal.php',
              data: {
                  goal: goal
              },
              success: function(data) {
                  const parent = document.getElementById('goals');
                  parent.removeChild(document.getElementById('add_goal_line'));
                  $('#last_goal_line').before(
                      '<li>' + data +
                      '<button type="button" ' +
                      'class="delete-goal close text-right" ' +
                      'id="' + data + '">' +
                      '×' +
                      '</button>' +
                      '</li>'
                  );
                  $(document).on('click','.delete-goal', function (){
                      delete_goal($(this));
                  });
                  ++goal_len;
                  $('#add_goal_btn').prop('disabled', false);
              },
              error: function() {
                  console.log("Submit_Goal ERROR");
              }
          });
      }

      function delete_goal(button) {
          console.log(button);
          let goal = $(button).attr('id');
          let list = document.querySelectorAll('#goals li');
          $.ajax({
              type: 'POST',
              url: '/pn/api/dashboard/remove_goal.php',
              data: {
                  goal: goal
              },
              success: function() {
                  for(let key in list) {
                      if(list.hasOwnProperty(key)) {
                          if(list[key].childNodes[0].textContent === goal) {
                              list[key].remove();
                              break;
                          }
                      }
                  }
                  --goal_len;
              },
              error: function() {
                  console.log("ERROR");
              }
          });
      }

      function get_guides(tags) {
          $.ajax({
              type:'POST',
              url: '/pn/api/guides/get_guides_tag_filtered.php',
              data: {
                  tags: tags
              },
              success: function(data) {
                  let guide;
                  let highlighted = Array();
                  let exercises = Array();
                  let nutrition = Array();
                  let nutrition_string = Array();
                  let exercises_string = Array();
                  let highlighted_string = Array();
                  const json = JSON.parse(data);
                  for(let key in json) {
                      if(json.hasOwnProperty(key)) {
                          guide = new Guide(json[key],function(){
                              get_guides(['highlighted', 'nutrition', 'exercise']);
                          });
                          if(guide.is_favorite === 1) {
                              if(guide.tags.includes('nutrition') && !nutrition.includes(guide))
                                  nutrition.push(guide);
                              if(guide.tags.includes('exercise') && !exercises.includes(guide))
                                  exercises.push(guide);
                          }
                          if(guide.tags.includes('highlighted') && !highlighted.includes(guide))
                              highlighted.push(guide);
                      }
                  }
                  for(let i = 0; i < nutrition.length; ++i) nutrition_string.push(nutrition[i].card);
                  for(let i = 0; i < exercises.length; ++i) exercises_string.push(exercises[i].card);
                  for(let i = 0; i < highlighted.length; ++i) highlighted_string.push(highlighted[i].card);

                  $('#highlighted_guides').html(highlighted_string);
                  $('#nutrition_favorites').html(nutrition_string);
                  $('#exercise_favorites').html(exercises_string);
              },
              error: function() {
                  console.log("get_guides ERROR");
              }
          });
      }
  </script>
</head>
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
<!--      <div class="card">-->
<!--        <div class="card-header">-->
<!--          <h3 class="card-title">Announcements</h3>-->
<!--        </div>-->
<!--        <div class="card-body p-0">-->
<!--          <ul class="products-list product-list-in-card">-->
<!--            <li class="item">-->
<!--              <div class="row product-info ml-3 mr-3">-->
<!--                <div class="pl-0 pr-0 col-10">-->
<!--                  <div class="product-description">Hello, this is an annoucement!.</div>-->
<!--                </div>-->
<!--                <div class="text-right pl-0 pr-0 col-2">-->
<!--                  <div class="product-description">Added 100 days ago</div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </div>-->
<!--      </div>-->

      <!-- Goals -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">My Goals</h3>
          </div>
          <ul class="todo-list" id="goals">
            <!-- This is populated by get_goals in the header -->
          </ul>
      </div>

      <!-- Body -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">My Body</h3>
        </div>
        <div class="card-body">
          <ul style="list-style-type:none">
            <li>
              <div class="row">
                <div class="col-2">
                  <label for="blood_type">Blood Type:</label>
                  <select id="blood_type" class="form-control">
                    <option>I don't know my blood type</option>
                    <option>A-</option>
                    <option>A+</option>
                    <option>B-</option>
                    <option>B+</option>
                    <option>AB-</option>
                    <option>AB+</option>
                    <option>O-</option>
                    <option>O+</option>
                  </select>
                </div>
                <div class="col-3">
                  <label for="body_type">Body Type:</label>
                  <select id="body_type" class="form-control">
                    <option>Ectomorph</option>
                    <option>Mesomorph</option>
                    <option>Endomorph</option>
                  </select>
                </div>
                <div class="col-2">
                  <label for="weight">Weight</label>
                  <input id="weight" class="form-control" type="number">
                </div>
                <div class="col-3">
                  <label for="activity_level">Activity Level</label>
                  <select id="activity_level" class="form-control">
                    <option value="0">No exercise</option>
                    <option value="1">1-2 days/wk of exercise</option>
                    <option value="2">3+ days/wk of exercise</option>
                  </select>
                </div>
                <div class="col-2">
                  <button
                    class="btn btn-primary text-right align-text-bottom"
                    id="save_body_btn"
                    onclick="save_body()"
                    style="background-color:green;border-color:green;">
                      Save
                  </button>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Highlighted For You -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Highlighted For You</h3>
        </div>
        <div class="card-body">
          <div id="highlighted_guides" class="row">
            <!-- This is populated by get_guides in the header -->
          </div>
        </div>
      </div>

      <!-- Nutrition Favorites -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Nutrition Favorites</h3>
        </div>
        <div class="card-body">
          <div id="nutrition_favorites" class="row">
            <!-- This is populated by get_guides in the header -->
          </div>
        </div>
      </div>

        <!-- Exercise Favorites -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Exercise Favorites</h3>
        </div>
        <div class="card-body">
          <div id="exercise_favorites" class="row">
            <!-- This is populated by get_guides in the header -->
          </div>
      </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</html>
<?php include('structure/bottom.php'); ?>