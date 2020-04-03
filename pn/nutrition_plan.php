<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Nutrition"; //Set the browser title
$highlight = "nutrition"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>
<script type="text/javascript">
    <!-- Put Javascript Here -->
    let Guide = class {
        constructor(json) {
            this.id = json['guide_id'];
            this.thumbnail = json['thumbnail'];
            this.date_last_modified = json['date_last_modified'];
            this.name = json['guide_name'];
            this.subscription_level = json['subscription_level'];
            this.favorite = json['fav'];
        }

        card() {
            return (
                '<div class="col-lg-3 col-md-6 col-sm-12">' + this.get_ribbon() +
                '<div class="small-box">' +
                '<div class="inner" style="position: relative;">' +
                // '<i id="guide" class="overlay-button fas fa-star' + (this.favorite === 1 ? " favorite" : "") + '"></i>' +
                '<svg class="overlay-button' + (this.favorite === 1 ? " favorite" : "") + '" ' +
                'id="guide' + this.id + '" onclick="favorite(this)" viewBox="0 0 940.688 940.688">' +
                '<path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8\n' +
                'c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601' +
                'c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z">' +
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

    let guides = Array();
    let goal_len = 0;


    function buildTable(data){
        let table = document.getElementById('plan_table')
        for(let i = 0; i < data.length; i++){
            let row =` <tr>
                                        <td>${data[i].Meal}</td>
                                        <td>${data[i].Protein}</td>
                                        <td>${data[i].Starch}</td>
                                        <td>${data[i].Vegetables}</td>
                                        <td>${data[i].Fruits}</td>
                                        <td>${data[i].Fats}</td>
                                    </tr>`
            table.innerHTML += row
        }
    }


    $( window ).on( "load", function() {
        get_plan();
        food_by_blood();
        get_guides($('#nutrition_favorites'), ['nutrition'], 0);
    });
    function get_plan() {
        $.ajax({
            type: 'POST',
            url: 'api/nutri/meal_calc.php',

            success: function (data) {
                let json = JSON.parse(data);
                buildTable(json);
                }
        });
    }

    function food_by_blood(){
        $.ajax({
            type: 'POST',
            url: 'api/nutri/blood.php',
            success: function(data){
                document.getElementById("blood").innerHTML = data;
            }
        });
    }

    function change_plan(){
        $('#change_btn').prop('disabled', true);
        window.location.replace("change_plan.php");
    }

    function get_guides(container, tags, favorites) {
        $.ajax({
            type:'POST',
            url: '/pn/api/guides/get_guides_tag_filtered.php',
            data: {
                tags: tags
            },
            success: function(data) {
                const json = JSON.parse(data);
                let cards = Array();
                let guide;
                for(let key in json) {
                    if(json.hasOwnProperty(key)) {
                        guide = new Guide(json[key]);
                        if(guides.includes(guide) === false) guides.push(guide);
                        if(favorites === 1) {
                            if(guide['favorite'] === 1) cards.push(guide.card());
                        }
                        else cards.push(guide.card());
                    }
                }
                container.html(cards);
            },
            error: function() {
                console.log("get_guides ERROR");
            }
        });
    }




</script>
<html>


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
                            <!-- Place page content here -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Nutrition Guides</h3>
              </div>
              <div class="card-body">
                  <div id="nutrition_favorites" class="row">
                      <!-- This is populated by get_guides in the header -->
                  </div>
              </div>
          </div>
                 <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                       <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" id="custom-tabs-two-plan-tab" data-toggle="pill" href="#custom-tabs-two-plan" role="tab" aria-controls="custom-tabs-plan-home" aria-selected="true">My meal plan</a>
                                              </li>
                          <li class="nav-item">
                               <a class="nav-link" id="custom-tabs-two-protein-tab" data-toggle="pill" href="#custom-tabs-two-protein" role="tab" aria-controls="custom-tabs-two-protein" aria-selected="false">Protein</a>
                          </li>
                          <li class="nav-item">
                               <a class="nav-link" id="custom-tabs-two-starch-tab" data-toggle="pill" href="#custom-tabs-two-starch" role="tab" aria-controls="custom-tabs-two-starch" aria-selected="false">Starches</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-two-fruit-tab" data-toggle="pill" href="#custom-tabs-two-fruit" role="tab" aria-controls="custom-tabs-two-fruit" aria-selected="false">Fruits</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-two-fats-tab" data-toggle="pill" href="#custom-tabs-two-fats" role="tab" aria-controls="custom-tabs-two-fats" aria-selected="false">Fats</a>
                          </li>
                       </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                           <div class="tab-pane fade active show" id="custom-tabs-two-plan" role="tabpanel" aria-labelledby="custom-tabs-two-plan-tab">
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                             <tr>
                                              <th>Meal#</th>
                                              <th>Protein</th>
                                              <th>Starch</th>
                                              <th>Vegetables</th>
                                              <th>Fruits</th>
                                              <th>Fats</th>
                                             </tr>
                                        </thead>
                                        <tbody id="plan_table">

                                        </tbody>
                                    </table>
                                </div>
                           </div>

                           <div class="tab-pane fade" id="custom-tabs-two-protein" role="tabpanel" aria-labelledby="custom-tabs-two-protein-tab">
                                 <div class="card-body p-0">
                                     <table class="table">
                                          <thead>
                                              <tr>
                                                 <th>Protein</th>
                                                 <th>30g</th>
                                                 <th>25g</th>
                                                 <th>20g</th>
                                                 <th>15g</th>
                                                 <th>1g</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 <td>Ground Beef</td>
                                                 <td>125g</td>
                                                 <td>104g</td>
                                                 <td>83g</td>
                                                 <td>63g</td>
                                                 <td>4.2g</td>
                                              </tr>
                                              <tr>
                                                <td>Steak</td>
                                                <td>114g</td>
                                                <td>95g</td>
                                                <td>76g</td>
                                                <td>57g</td>
                                                <td>3.8g</td>
                                              </tr>
                                              <tr>
                                                 <td>Eggs(whole)</td>
                                                 <td>5ct</td>
                                                 <td>4ct</td>
                                                 <td>3ct</td>
                                                 <td>3ct</td>
                                                 <td>1egg/6g</td>
                                              </tr>
                                              <tr>
                                                 <td>Egg whites</td>
                                                 <td>270g</td>
                                                 <td>225g</td>
                                                 <td>180g</td>
                                                 <td>135g</td>
                                                 <td>9g</td>
                                              </tr>
                                              <tr>
                                                 <td>Chicken Breast</td>
                                                 <td>100g</td>
                                                 <td>83g</td>
                                                 <td>67g</td>
                                                 <td>50g</td>
                                                 <td>3.3</td>
                                              </tr>
                                              <tr>
                                                 <td>Chicken Thighs</td>
                                                 <td>116g</td>
                                                 <td>95g</td>
                                                 <td>78g</td>
                                                 <td>59g</td>
                                                 <td>3.9g</td>
                                              </tr>
                                              <tr>
                                                 <td>Cod</td>
                                                 <td>132g</td>
                                                 <td>110g</td>
                                                 <td>88g</td>
                                                 <td>66g</td>
                                                 <td>4.4g</td>
                                              </tr>
                                              <tr>
                                                 <td>Turkey</td>
                                                 <td>102g</td>
                                                 <td>95g</td>
                                                 <td>68g</td>
                                                 <td>51g</td>
                                                 <td>3.4g</td>
                                              </tr>
                                          </tbody>
                                     </table>
                                 </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-two-starch" role="tabpanel" aria-labelledby="custom-tabs-two-starch-tab">
                                <div class="card-body p-0">
                                   <table class="table">
                                     <thead>
                                        <tr>
                                          <th>Starch</th>
                                          <th>30g</th>
                                          <th>25g</th>
                                          <th>20g</th>
                                          <th>15g</th>
                                          <th>1g</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        <tr>
                                          <td>Rice</td>
                                          <td>107g</td>
                                          <td>90g</td>
                                          <td>72g</td>
                                          <td>54g</td>
                                          <td>3.6g</td>
                                        </tr>
                                        <tr>
                                          <td>Potatoes</td>
                                          <td>145g</td>
                                          <td>120g</td>
                                          <td>96g</td>
                                          <td>72g</td>
                                          <td>4.8g</td>
                                        </tr>
                                        <tr>
                                          <td>Quinoa</td>
                                          <td>141g</td>
                                          <td>118g</td>
                                          <td>3ct</td>
                                          <td>3ct</td>
                                          <td>4.7g</td>
                                        </tr>
                                     </tbody>
                                   </table>
                                </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-two-fruit" role="tabpanel" aria-labelledby="custom-tabs-two-fruit-tab">
                                <div class="card-body p-0">
                                   <table class="table">
                                       <thead>
                                          <tr>
                                            <th>Fruit</th>
                                            <th>15</th>
                                            <th>10</th>
                                            <th>5</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                            <td>Watermelon</td>
                                            <td>199g</td>
                                            <td>132g</td>
                                            <td>66g</td>
                                          </tr>
                                          <tr>
                                            <td>Strawberries</td>
                                            <td>195g</td>
                                            <td>130g</td>
                                            <td>65g</td>
                                          </tr>
                                          <tr>
                                            <td>Apples</td>
                                            <td>100g</td>
                                            <td>73g</td>
                                            <td>37g</td>
                                          </tr>
                                          <tr>
                                            <td>Bananas</td>
                                            <td>66g</td>
                                            <td>45g</td>
                                            <td>33g</td>
                                          </tr>
                                          <tr>
                                            <td>Berries</td>
                                            <td>125g</td>
                                            <td>83g</td>
                                            <td>42g</td>
                                          </tr>
                                          <tr>
                                            <td>Cantaloupe</td>
                                            <td>171g</td>
                                            <td>114g</td>
                                            <td>57g</td>
                                          </tr>
                                          <tr>
                                            <td>Mango</td>
                                            <td>66g</td>
                                            <td>44g</td>
                                            <td>22g</td>
                                          </tr>
                                          <tr>
                                            <td>Pineapple</td>
                                            <td>114g</td>
                                            <td>76g</td>
                                            <td>38g</td>
                                          </tr>
                                       </tbody>
                                   </table>
                                </div>
                           </div>
                           <div class="tab-pane fade" id="custom-tabs-two-fats" role="tabpanel" aria-labelledby="custom-tabs-two-fats-tab">
                               <div class="card-body p-0">
                                  <table class="table">
                                     <thead>
                                       <th>Fats</th>
                                     </thead>
                                     <tbody>
                                     </tbody>
                                  </table>
                               </div>
                           </div>
                        </div>
                        <p id="blood"></p>
                    </div>
                    <!-- /.card -->

                 </div>
          <div class="col-sm-4">
              <button class="btn btn-block btn-primary" id="change_btn" onclick="change_plan()">Change my nutrition plan</button>
          </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</html>
<?php include('structure/bottom.php'); ?>