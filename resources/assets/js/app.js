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

    $.extend($.expr[":"], {
        "containsIn": function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
    });

})();

