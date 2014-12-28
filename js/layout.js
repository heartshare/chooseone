$(document).ready(function () {

    $('#delbutton').click(function () {
        confirm("Ви дійсно хочете видалити даний контент?");
    });

    function hideAllDropdowns() {
        $(".dropped .drop-menu-main-sub").hide();
        $(".dropped").removeClass('dropped');
        $(".dropped .drop-menu-main-sub .title").unbind("click");
    }

    function showDropdown(el) {
        var el_li = $(el).parent().addClass('dropped');
        el_li
            .find('.title')
            .click(function () {
                hideAllDropdowns();
            })
            .html($(el).html());
        el_li.find('.drop-menu-main-sub').show();
    }

    $(".drop-down").click(function () {
        showDropdown(this);
    });

    $(document).mouseup(function () {
        hideAllDropdowns();
    });
});
