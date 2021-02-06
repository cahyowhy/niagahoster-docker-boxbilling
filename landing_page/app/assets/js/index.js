$(document).ready(function () {
    const navbarMenu = $('#navbar-menu');
    const navbarToggle = $('#navbar-toggle');

    navbarToggle.on("click", function() {
        $(this).toggleClass('is-active');
        navbarMenu.toggleClass('is-active');
    });
});