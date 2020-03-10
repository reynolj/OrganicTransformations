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

    $(document).mousemove(function (e) {
        $('#info-box').css('top', e.pageY - $('#info-box').height() - 30);
        $('#info-box').css('left', e.pageX - ($('#info-box').width()) / 2);
    }).mouseover();
});

//Returns the correct display name (w/o '_' for space)
function getDisplayName(e) {
    let ret = $(e).attr('data-name') === undefined ? $(e).attr('id') : $(e).attr('data-name');
    return ret;
}

