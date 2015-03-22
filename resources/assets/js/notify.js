(function($) {

    var Notify = function(title, message) {
        this.$responseCodes = {
            HTTP_OK: 200,
            HTTP_UNAUTHORIZED: 401,
            HTTP_FORBIDDEN: 403,
            HTTP_NOT_FOUND: 404,
            HTTP_ERROR: 500
        };

        this.configure({
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-bottom-right"
        });

        this.init(title, message);
    };

    Notify.prototype.init = function(title, message) {
        this.$title = title;
        this.$message = message;
    }

    Notify.prototype.configure = function(options) {
        toastr.options = options;
    }

    Notify.prototype.info = function() {
        toastr["info"](this.$title, this.$message);
    }

    Notify.prototype.success = function() {
        toastr["success"](this.$title, this.$message);
    }

    Notify.prototype.warning = function() {
        toastr["warning"](this.$title, this.$message);
    }

    Notify.prototype.error = function() {
        toastr["error"](this.$title, this.$message);
    }

    Notify.prototype.handle = function() {
        var code = this.$title.status;
        var message = this.$title.responseText;

        this.$title = this._parse(message);

        //noinspection FallthroughInSwitchStatementJS
        switch (code) {
            case this.$responseCodes.HTTP_OK:
                this.success();
                break;

            case this.$responseCodes.HTTP_UNAUTHORIZED:
            case this.$responseCodes.HTTP_FORBIDDEN:
            case this.$responseCodes.HTTP_NOT_FOUND:
            case this.$responseCodes.HTTP_ERROR:
            default:
                this.error();
                break;
        }
    }

    Notify.prototype._parse = function(data) {
        try
        {
            var obj = $.parseJSON(data);
            if (obj.message)
                return obj.message;
        }
        catch (e)
        {
            return null;
        }
    }
    
    $(function() {
        $.fn.extend({
            notify: function (title, message) {
                return new Notify(title, message);
            }
        });
    });
})(jQuery);