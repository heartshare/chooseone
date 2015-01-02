$(document).ready(function ($) {
    var $login = $('#login');
    var $password = $('#password');
    var $email = $('#email');
    $('#register').click(function (e) {
        if ($login.val() == '') {
            $login.css({'border-color': 'red'});
            e.preventDefault();
        }
        if ($password.val() == '') {
            $password.css({'border-color': 'red'});
            e.preventDefault();
        }
        if ($email.val() == '') {
            $email.css({'border-color': 'red'});
            e.preventDefault();
        }
    });
});
