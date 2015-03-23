(function() {
    // registring the vain namespace
    $.extend({
        vain: $.prototype
    });

    // setup jquery
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('form[data-remote]').on('submit', function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.attr('action');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function()
            {
                $.vain.notify.configure({
                    onHidden: function() { location.reload(); } // todo check if this is usable for all scenarios
                });

                var message = form.data('remote-success-message');
                message && $.vain.notify.success(message);
            },
            error: function()
            {
                var message = form.data('remote-error-message');
                message && $.vain.notify.error(message);
            }
        });

        e.preventDefault();
    });

    $('input[data-confirm], button[data-confirm]').on('click', function(e) {
        var input = $(this);
        var form = input.closest('form');

        input.attr('disabled', 'disabled');

        $.vain.confirm(input.data('confirm'), function (result) {
            if (result)
                form.submit();

            input.removeAttr('disabled');
        });

        e.preventDefault();
    });

})();

