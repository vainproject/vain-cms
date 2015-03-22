/**
 * User: felixrudat
 * Date: 22.03.15
 * Time: 21:21
 */

$('document').ready(function() {
$('.js-delete').on('click', function(e) {
    e.preventDefault();
    $.fn.showConfirm($('#modal'), $('.js-confirm'), $(this).attr('href'), 'DELETE');
});
});
