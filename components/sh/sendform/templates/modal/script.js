
var mask = document.querySelector('.js-mask');
var modalForm = document.querySelector('.js-modal');

$('.js-open-modal').on('click', function () {
    $(modalForm).addClass('active');
    $(mask).addClass('active');
    $('header').css('position', 'relative');
});
$('.js-close').on('click', function () {
    $(modalForm).removeClass('active');
    $(mask).removeClass('active');
    $('.js-thanks').removeClass('active');
    $('header').css('position', 'fixed');
});
