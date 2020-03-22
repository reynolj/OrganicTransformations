<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Home"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML


?>
<html>
<head>
<!--  <script type="module" src="api/dashboard/dashboard.js">-->
<!--  </script>-->

  <script type="text/javascript">
      let Guide = class {
          constructor(json) {
              this.id = json['guide_id'];
              this.thumbnail = json['thumbnail'];
              this.date_last_modified = json['date_last_modified'];
              this.name = json['guide_name'];
              this.subscription_level = json['subscription_level'];
              this.favorite = json['fav'];
              this.tags = json['tags'];
          }

          get card() {
              return (
                  '<div class="col-lg-3 col-md-6 col-sm-12">' + this.get_ribbon() +
                  '<div class="small-box">' +
                  '<div class="inner" style="position: relative;">' +
                  '<svg class="overlay-button' + (this.favorite === 1 ? " favorite" : "") + '" ' +
                  'id="guide' + this.id + '" onclick="favorite(this)" viewBox="0 0 940.688 940.688">' +
                  '<path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8\n' +
                  'c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601' +
                  'c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z"/>' +
                  '</svg>' +
                  '<img src="' + this.thumbnail + '" alt="" class="img-fluid">' +
                  '</div>' +
                  '<a class="small-box-footer">' +
                  '<div class="row pl-1 pr-1">' +
                  '<div class="text-left col-6">' + this.name + '</div>' +
                  '<div class="text-right col-6">' + 'Added ' + this.date_str()  + '</div>' +
                  '</div>' +
                  '</a>' +
                  '</div>' +
                  '</div>'
              );
          }

          date_str() {
              const year_month_day = this.date_last_modified.split('-');
              const date = new Date(year_month_day[0], year_month_day[1] - 1, year_month_day[2]);
              const cur_date = new Date();
              const milli_in_day = 24 * 60 * 60 * 1000;
              const days_since = Math.floor(Math.abs(cur_date - date) / milli_in_day);
              if(days_since >= 365) {
                  const years_since = cur_date.getFullYear() - date.getFullYear();
                  return years_since.toString() + ((years_since > 1) ? (' years ago') : (' year ago'));
              }
              if(days_since > 30) {
                  let months_since = cur_date.getMonth() - date.getMonth();
                  if(months_since < 0) months_since = months_since + 12;
                  return months_since.toString() + ((months_since > 1) ? (' months ago') : (' month ago'));
              }
              switch(days_since) {
                  case 0:
                      return 'today';
                  case 1:
                      return 'yesterday';
                  default:
                      return days_since.toString() + ' days ago';
              }
          }

          get_ribbon() {
              if(this.subscription_level === "WELCOME") return "";
              let color_levels = {
                  "BEGINNER" : '<div class="ribbon bg-white">',
                  "INTERMEDIATE" : '<div class="ribbon bg-yellow">',
                  "ADVANCED" : '<div class="ribbon bg-red">',
                  "PERSONAL" : '<div class="ribbon bg-black">'
              };
              return (
                  '<div class="ribbon-wrapper ribbon-lg" style="right:5px">' +
                  color_levels[this.subscription_level] +
                  this.subscription_level +
                  '</div>' +
                  '</div>'
              );
          }
      };

      // let Pages = class {
      //     constructor(list) {
      //         this.list = list;
      //         this.cur_page = 1;
      //         this.first_page = 1;
      //         this.last_page = 1;
      //         this.width = 5;
      //     }
      //
      //     add_to_list(card) {
      //         this.list.push(card);
      //
      //     }
      //
      //     remove_from_list(card) {
      //         this.list.splice(this.list.indexOf(card), 1);
      //     }
      //
      //     get_page_set() {
      //         let pages = [
      //             this.cur_page - 2,
      //             this.cur_page - 1,
      //             this.cur_page,
      //             this.cur_page + 1,
      //             this.cur_page + 2
      //         ];
      //         if(pages.includes(this.first_page)) pages = pages.slice(pages.indexOf(this.first_page));
      //         if(pages.includes(this.last_page) pages.length = pages.indexOf(this.last_page) + 1;
      //         return pages;
      //     }
      //
      //     set_current_page(page) {
      //         if(page > this.last_page || page < this.first_page) return;
      //         this.cur_page = page;
      //     }
      //
      //     get_current_page_html() {
      //         let numbers = Array();
      //         const set = this.get_page_set();
      //         numbers.push(
      //             '<div class="row">' +
      //               '<a class="fa-angle-double-left"></a>' +
      //         );
      //         for(let number in set) {
      //             if(number === this.cur_page) numbers.push('<b>' + number + '</b>');
      //             else numbers.push('<b>' + number + '</b>');
      //         }
      //         numbers.push(
      //               '<a class="fa-angle-double-right"></a>' +
      //             '</div>'
      //         );
      //         return set.join("");
      //     }
      // };

      // let page_nav = Pages(highlighted);

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
                              'class="close text-right" ' +
                              'id="' + json[key]['goal'] + '" onclick="delete_goal(this)">' +
                              '×' +
                              '</button>' +
                              '</li>');
                  }
                  goal_str.push(
                      '<li class="text-right" id="last_goal_line">' +
                      '<button class="btn btn-primary" id="add_goal_btn" onclick="add_goal()" ' +
                      'style="background-color:green;border-color:green;height:100%">' +
                      'Add Goal' +
                      '</button>' +
                      '</li>'
                  );
                  $('#goals').html(goal_str);
              },
              error: function() {
                  console.log("Get_Goals ERROR");
              }
          });
      }

      function add_goal() {
          $('#last_goal_line').before(
              '<li id="add_goal_line">' +
              '<div class="row">' +
              '<input id="goal_input" class="form-control col-11" type="text" placeholder="New Goal">' +
              '<button class="btn btn-primary col-1" id="submit_goal_btn" onclick="submit_goal()" ' +
              'style="background-color: blue; border-color:blue; height:100%">' +
              '+' +
              '</button>' +
              '</div>' +
              '</li>'
          );
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
                      'class="close text-right" ' +
                      'id="' + data + '" onclick="delete_goal(this)">' +
                      '×' +
                      '</button>' +
                      '</li>'
                  );
                  ++goal_len;
                  $('#add_goal_btn').prop('disabled', false);
              },
              error: function() {
                  console.log("Submit_Goal ERROR");
              }
          });
      }

      function delete_goal(button) {
          let goal = button.id;
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
                          guide = new Guide(json[key]);
                          if(guide.favorite === 1) {
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

      function favorite(wrapper) {
          let classes = wrapper.classList;
          const guide_id = wrapper.id.slice('guide'.length);
          const favorited = classes.contains('favorite') ? 1 : 0;
          $.ajax({
              type:'POST',
              url: '/pn/api/dashboard/favorite_guide.php',
              data: {
                  guide_id: guide_id,
                  favorited: favorited
              },
              success: function(data) {
                  get_guides(['highlighted', 'nutrition', 'exercise']);
              },
              error: function() {
                  console.log("ERROR");
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