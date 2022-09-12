/**
 * Created by JSS-PC on 03/02/2017.
 */
$(function () {
    $('.box-home-slider').removeClass('hide');
    $(window).resize(function () {
        resizeSlider();
    });
    $('#home-slider').unslider({
        animation : 'fade',
        autoplay  : true,
        arrows    : false,
        delay     : 10000,
    });
    resizeSlider();

    $('.news-feed-text').each(function ( i, ele ) {
        if ($('br', ele).length > 8) {
            var strShow = '', strHide = '';
            $($(this).html().split('<br>')).each(function ( _i, _ele ) {
                _i <= 7 ? strShow = strShow + _ele + '<br>' : strHide = strHide + _ele + '<br>';
            });
            var divHide = $('<div>', { 'id' : 'news-feed-text-hide-' + i });
            var btnShow = $('<a>').text('ดูเพิ่มเติม').css('color', 'rgba(27, 188, 155, 0.84)').click(function () {
                divHide.show();
                $(this).hide();
            });

            divHide.html(strHide.trim()).hide();
            $(ele).html(strShow.trim()).append(btnShow).append(divHide);
        }
    });


});

function resizeSlider() {
    var homeSlider = $('#home-slider');
    homeSlider.height((homeSlider.width() * 300 / 1140) - 1);
    $('.unslider-nav').css('bottom', homeSlider.width() / 32);
    if ($(window).width() < 972) {
        $("#home-news-feed").appendTo("#mobile-news-feed-box");
    } else {
        $("#home-news-feed").appendTo("#desktop-news-feed-box");
    }
}