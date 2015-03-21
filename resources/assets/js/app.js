$(document).ready(function() {
    // necessary material bootstrap init
    //$.material.init();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

