(function($) {

    var Notify = function(title, message) {
        this.$title = title;
        this.$message = message;

        //this.configure({
        //    "closeButton": false,
        //    "debug": false,
        //    "newestOnTop": false,
        //    "progressBar": false,
        //    "positionClass": "toast-top-left",
        //    "onclick": null
        //});
    };

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

    $(function() {
        $.fn.extend({
            notify: function (title, message) {
                return new Notify(title, message);
            }
        });
    });
})(jQuery);