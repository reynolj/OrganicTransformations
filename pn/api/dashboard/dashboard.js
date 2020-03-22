import Guide from '../guides/Guide.js';

let guides = Array();
let goal_len = 0;

$( window ).on( "load", function() {
    get_body();
    get_goals();
    get_guides($('#highlighted_guides'), ['highlighted'], 0);
    get_guides($('#exercise_favorites'), ['exercise'], 1);
    get_guides($('#nutrition_favorites'), ['nutrition'], 1);
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
    $('#add_goal_btn').prop('disabled', true);
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
            $('#add_goal_btn').prop('disabled', false);
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
            if(favorited) {
                classes.remove('favorite');
                favorites.splice(favorites.indexOf(guide_id), 1);
            }
            else {
                classes.add('favorite');
                favorites.push(guide_id);
            }
            get_guides(4, $('#nutrition_favorites'), 'nutrition', 1);
            get_guides(4, $('#exercise_favorites'), 'exercise', 1);
            get_guides(4, $('#highlighted_guides'), 'nutrition', -1);
        },
        error: function() {
            console.log("ERROR");
        }
    });
}