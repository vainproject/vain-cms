(function($) {

    var Modal = function(element, confirm, route, method) {
        this.$element = element;
        this.$confirm = confirm;
        this.$route = route;
        this.$method = method;

        this.init();
    };

    Modal.prototype.init = function() {
        this.$element.modal('show');
        var self = this;

        this.$confirm.on('click', function() {
            self.confirm();
        });
    }

    Modal.prototype.confirm = function() {
        if (this.$route !== undefined && this.$route !== null)
            this.request();
    }

    Modal.prototype.request = function() {
        var self = this;

        $.ajax({
            url: this.$route,
            type: this.$method
        })
        .done(function(data) {
            self._onDone(data);
        })
        .fail(function(jqXHR) {
            self._onFail(jqXHR);
        });
    }

    Modal.prototype._onDone = function(data)
    {
        location.reload();
    }

    Modal.prototype._onFail = function(jqXHR)
    {
        this.$element.modal('hide');

        // display notifier with error message
        var message = this._parse(jqXHR.responseText);
        $.fn.notify(message).error();
    }

    Modal.prototype._parse = function(error)
    {
        try
        {
            var obj = $.parseJSON(error);
            if (obj.error && obj.error.message)
                return obj.error.message;
        }
        catch (e)
        {
            return null;
        }
    }

    $(function() {
        $.fn.extend({
            showConfirm: function (element, confirm, route, method) {
                return new Modal(element, confirm, route, method);
            }
        });
    });
})(jQuery);