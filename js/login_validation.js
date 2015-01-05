$(document).ready(function ($) {
    var $login = $('#username');
    var $password = $('#password');
    $('#btn-login').click(function (e) {
        if ($login.val() == '') {
            $login.css({'border-color': 'red'});
            e.preventDefault();
        }
        if ($password.val() == '') {
            $password.css({'border-color': 'red'});
            e.preventDefault();
        }
    });
});
