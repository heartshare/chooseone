$(document).ready(function () {
    var url = window.location;
    $('ul.nav a[href="'+ url.pathname +'"]').parent().addClass('active');
});
