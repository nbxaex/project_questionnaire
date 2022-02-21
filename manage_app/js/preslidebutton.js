$(document).ready(function () {
    $('.QapTcha').QapTcha({
        disabledSubmit: false,
        autoRevert: true,
        autoSubmit: true
    });
});

$(document).ready(function () {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

//paste this code under the head tag or in a separate js file.
// Wait for window load
$(window).load(function () {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
});