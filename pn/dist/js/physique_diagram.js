$(window).on("load", function () {

});

$(document).ready(function () {
    console.log('ready!');

    //Mouse moved over a muscle, show tooltip
    $('.muscle').hover(function () {
        $('#info-box').css('display', 'block');

        //Display the correct form of the name (w/o '_' for space)
        let displayName =  $(this).attr('data-name') == undefined ? $(this).attr('id') : $(this).attr('data-name');

        $('#info-box').html(displayName);
    });

    //Mouse click opens popup with guides associated with the
    $('.muscle').click(function(){
        
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

