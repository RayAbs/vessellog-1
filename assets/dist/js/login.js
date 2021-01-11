$(document).ready(function () {
    $("#show_hide_password span").on('click', function (event) {
        event.preventDefault();
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
            console.log("yes");
        } else {
            input.attr("type", "password");
        }
    });
});
