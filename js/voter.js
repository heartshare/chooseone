$(document).ready(function () {
    $('#vote_up').click(function () {
        $.ajax({
            'method': 'POST',
            'url': '',
            'data': JSON.stringify({})
        });
    });
    $('#vote_down').click(function () {

    });
});
