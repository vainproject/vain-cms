(function($) {

    var defaultTemplate = function(id, message, dismissText, confirmText) {
        var buttons = '';

        if (dismissText !== undefined && dismissText !== null)
            buttons += "<button type='button' class='btn btn-default' data-dismiss='modal'>"+ dismissText +"</button>";

        if (confirmText !== undefined && confirmText !== null)
            buttons += "<button type='button' class='btn btn-danger' data-confirm='modal'>"+ confirmText +"</button>";

        return "<div id='"+ id +"' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-body'>"+ message +"</div>" +
                            "<div class='modal-footer'>"+ buttons +"</div>" +
                        "</div>" +
                    "</div>" +
                "</div>";
    }

    var defaultModal = function(message, dismissText, confirmText)
    {
        var id = "#defaultModal"
        var last = $(id);

        // remove old template since the modal has potentially changed
        if (last.length)
        {
            last.remove();
        }

        // inject default modal and set is as element
        var template = defaultTemplate(id, message, dismissText, confirmText);
        //jQuery("body").append(template);

        return $(id);
    }

    var Alert = function(element) {
        if (! $(element).length)
        {
            this.$element = defaultModal(element, 'Ok');
        }
        else
        {
            this.$element = $(element);
        }

        this.$element.modal('show');
    };

    var Confirm = function(element, callback) {
        if (! $(element).length)
        {
            this.$element = defaultModal(element, 'Abort', 'Confirm');
        }
        else
        {
            this.$element = $(element);
        }

        this.$callback = callback || function(){};

        this.$confirm = this.$element.find('a[data-confirm="modal"], button[data-confirm="modal"]');
        this.$dismiss = this.$element.find('a[data-dismiss="modal"], button[data-dismiss="modal"]');

        this.init();
    };

    Confirm.prototype.init = function() {
        this.$element.modal('show');
        var self = this;

        this.$dismiss.on('click', function() {
            self.$callback(false);
        });

        this.$confirm.on('click', function() {
            self.$element.modal('hide');
            self.$callback(true);
        });
    }

    $(function() {
        $.vain.extend({
            alert: function (element) {
                return new Alert(element);
            },
            confirm: function (element, callback) {
                return new Confirm(element, callback);
            }
        });
    });

})(jQuery);