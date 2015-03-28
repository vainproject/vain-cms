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

    // make sure u use delegation!
    $(document.body).on('submit', 'form[data-remote]', function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.attr('action');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function()
            {
                var redirect = form.data('remote-success-redirect');
                redirect && (window.location = redirect);

                // refresh the form using pjax
                $.vain.pjax.refresh(function () {
                    var message = form.data('remote-success-message');
                    message && $.vain.notify.success(message);
                });
            },
            error: function()
            {
                // refresh the form using pjax
                $.vain.pjax.refresh(function () {
                    var message = form.data('remote-error-message');
                    message && $.vain.notify.error(message);
                });
            }
        });

        e.preventDefault();
    });

    // make sure u use delegation!
    $(document.body).on('click', 'input[data-confirm], button[data-confirm]', function(e) {
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

