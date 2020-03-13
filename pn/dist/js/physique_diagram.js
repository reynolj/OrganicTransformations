$(window).on("load", function () {

});

$(document).ready(function () {
    console.log('ready!');

    //Mouse moved over a muscle, show tooltip
    $('.muscle').hover(function () {
        $('#info-box').css('display', 'block');

        //Display the correct form of the name
        let displayName =  getDisplayName(this);

        $('#info-box').html(displayName);
    });

    //Mouse click opens popup with guides associated with the
    $('.muscle').click(function(){
        console.log('Clicked')

        $('#modalBody').html(''); //Clearing the modal before showing it
        var tags = [$(this).attr('id')];
        get_guides_tag_filtered(tags, make_cards);

        $('#myModalLabel').html('Exercises for the <span style="font-weight: bold;">' + getDisplayName(this) + '</span>')
        $('#myModal').modal({
            backdrop: true,
            keyboard: true,
            show: true
        })
    })

    //Mouse moved off muscle, hide tooltip
    $('.muscle').mouseleave(function (e) {
        $('#info-box').css('display', 'none');
    });

    //Position tooltip on mouse
    $(document).mousemove(function (e) {
        $('#info-box').css('top', e.pageY - $('#info-box').height() - 30);
        $('#info-box').css('left', e.pageX - ($('#info-box').width()) / 2);
    }).mouseover();
});

//Returns the correct display name (w/o '_' for space), param: group element
function getDisplayName(group_ele) {
    let ret = $(group_ele).attr('data-name') === undefined ? $(group_ele).attr('id') : $(group_ele).attr('data-name');
    return ret;
}

//Make cards in
function make_cards(data) {
    let str_hold = Array();
    let day_str;
    let ribbon_str;
    for(let key in data) {
        if(data.hasOwnProperty(key)) {
            // day_str = calc_time_since(data[key]["date_last_modified"]);
            // ribbon_str = get_ribbon(data[key]["subscription_level"]);
            str_hold.push(
                '<div class="col-lg-3 col-md-6 col-sm-12">' +
                // ribbon_str +
                // '<div class="small-box" style="background-image: url(' + data[key]["thumbnail"] + ');">' +
                '<div class="small-box">' +
                '<div class="inner" style="position: relative;">' +
                '<svg class="overlay-button' + (data[key]["fav"] === 1 ? " favorite" : "") + '" ' +
                'id="guide' + data[key]["guide_id"] + '" onclick="favorite(this)" viewBox="0 0 940.688 940.688">' +
                '<path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8\n' +
                'c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601' +
                'c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z"/>' +
                '</svg>' +
                '<img src="' + data[key]["thumbnail"] + '" alt="" class="img-fluid">' +
                '</div>' +
                '<a class="small-box-footer">' +
                '<div class="row pl-1 pr-1">' +
                '<div class="text-left col-6">' + data[key]["guide_name"] + '</div>' +
                // '<div class="text-right col-6">' + 'Added ' + day_str  + '</div>' +
                '</div>' +
                '</a>' +
                '</div>' +
                '</div>'
            );
        }
    }
    $('#modalBody').html(str_hold);
}

//tags array
function get_guides_tag_filtered(tags_array, callback){
    $.ajax({
        type: 'POST',
        url: 'api/guides/get_guides_tag_filtered.php',
        data: {
            number: 4,
            tags: tags_array
        },
        success: function (data) {
            console.log("command sent");
            console.log(data);
            callback(JSON.parse(data));
        },
        error: function () {
            console.log("ERROR")
        }
    })

}

