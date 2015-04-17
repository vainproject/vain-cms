(function() {
    $(document.body).on('click', 'input[data-destination-account]', function(e) {

        $('input#destination_realm').val($(this).data('realmid'));
    });

    $(document.body).on('click', 'button[data-server-type]', function(e) {

        var type = $(this).data('server-type');
        $('.chartrans-disable-overlay').show();
        $('[data-server-type="' + type + '"]').find('.chartrans-disable-overlay').hide();

        e.preventDefault();
    });
})();