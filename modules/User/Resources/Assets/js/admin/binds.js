$('document').ready(function() {

    // register confirm modals
    $('#user .js-delete').on('click', function(e) {
        e.preventDefault();
        $.fn.showConfirm($('#modal'), $('.js-confirm'), $(this).attr('href'), 'DELETE');
    });
});