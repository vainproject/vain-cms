(function($) {

    var Pjax = function() {};

    Pjax.prototype.options = {
        element: '[data-pjax]'
    }

    Pjax.prototype.refresh = function(callback) {
        this.load(location.href, callback);
    }

    Pjax.prototype.load = function(url, callback) {
        var self = this;

        $.ajax({
            url: url,
            success: function(page)
            {
                // replace the target document
                self._replace(self.options.element, page);

                // notify we are finished
                callback && callback();
            }
        });
    }

    Pjax.prototype._replace = function(selector, page) {
        var scroll = $(window).scrollTop(); // save the scroll position

        //var body = selector === 'body' ?
        //    page.replace(/^.*?<body[^>]*>(.*?)<\/body>.*?$/i,"$1") :

        var body = $(page).filter(selector).html();
        $(selector).empty().append(body); // replace the selector

        $(window).scrollTop(scroll); // set the scroll position
    }

    $(function() {
        $.vain.extend({
            pjax: new Pjax()
        });
    });

})(jQuery);