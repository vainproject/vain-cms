(function() {

    // make sure u use delegation!
    $(document.body).on('submit', 'form[data-remote]', function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.attr('action');

        // todo check if still necessary
        //CKEDITOR && function()
        //{
        //    for (var instance in CKEDITOR.instances)
        //        CKEDITOR.instances[instance].updateElement();
        //}();

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

    // may be used to serve automatically expanding textareas
    $(document.body).on('focus', 'textarea[data-expand]', function(e) {

        var textarea = $(this);
        var maxRows = textarea.data('expand-rows-max');
        // min-rows is optional - current rows are taken instead then
        var minRows = textarea.data('expand-rows-min') ? textarea.data('expand-rows-min') : textarea.attr('rows');
        textarea.data('expand-rows-min', minRows);

        textarea.attr('rows', maxRows);

        textarea.on('blur', function(e) {

            var self = $(this);

            if (self.val().length < 1)
                self.attr('rows', textarea.data('expand-rows-min'));
        });

        e.preventDefault();
    });

    /**
     * proof of concept, child items are not displayed by now
     *
     * todo: clean it up a little?
     */
    $(document).on('keyup', 'input[data-menu-search]', function(e) {

        var element = $(this);
        var container = element.closest(element.data('menu-search'));
        var q = element.val();

        container.find('ul > .treeview').each(function() {

            var item = $(this);
            item.removeClass('active')
                .hide();

            item.find('.active')
                .removeClass('active');

            var filter = item.find('span:containsIn(\''+ q +'\')')

            filter.closest('.treeview')
                .show();

            if (q.length)
            {
                // handle active state of matched elements
                filter.closest('.treeview-menu')
                    .addClass('menu-open');

                filter.closest('.treeview')
                    .addClass('active');

                filter.closest('li')
                    .addClass('active');

                // click element on enter keystroke
                if (e.which == 13)
                    filter.click();
            }
        });
    });

    /**
     * this actions will be triggered on every ().ready and ().vain.pjax.complete
     */
    var onLoad = function() {

        $('[data-editor]').each(function() {

            // set language if possible
            var lang = $(this).data('editor-lang');
            lang && (CKEDITOR.config.language = lang);

            // replace the editor
            var id = $(this).attr('id') ;
            id && CKEDITOR.replace(id);
        });

        $('[data-auto-active]').each(function() {

            var element = $(this);

            var cls = element.data('auto-active') || 'active';
            element.find(':first-child').first().addClass(cls);
        });

        $('[data-select]').selectpicker();
    };

    $(function() {
        $(document).on('ready', onLoad);

        $.vain.pjax.options.complete = onLoad;
    });
})();

