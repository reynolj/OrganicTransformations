import Guide from '../guides/Guide.js';

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
        '<button class="btn btn-primary col-1" id="submit_goal_btn"  onclick="submit_goal()"> ' +
        '<i class="fas fa-plus"> </i>' +
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