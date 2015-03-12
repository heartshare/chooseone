<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

<?php
Yii::app()->clientScript->registerCss('tag_widget_css', '
#tags:focus{
   outline: 0;
}

.seacrh-tag-textbox {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 2px 4px;
}

.seacrh-tag-textbox li {
    display: inline-block;
    list-style: none;
    margin-left: 5px;
}

.seacrh-tag-textbox input {
    background: none;
    border: none;
}

.tag_item {
    padding: 5px;
    background-color: #E0E0D1;
    border: 1px solid #B3B3A7;
}

.remove-tag {
    cursor: pointer;
    margin-left: 5px;
}

#tags_submit_field {
    display: none;
}
');
?>

<script type="text/javascript">
    $(function () {
        var availableTags = <?php echo json_encode($results); ?>;

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $("#tags")
            .bind("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 0,
                source: function (request, response) {
                    response($.ui.autocomplete.filter(
                        availableTags, extractLast(request.term)));
                },
                select: function (event, ui) {
                    var index = availableTags.indexOf(ui.item.value);
                    availableTags.splice(index, 1);
                    this.value = "";
                    var $tags_submit = $('#tags_submit_field');
                    var start = $tags_submit.val();
                    $tags_submit.val(start + ',' + ui.item.value);
                    var $seacrh_tag_textbox = $('.seacrh-tag-textbox');
                    var content = '<li class="tag_item">' + ui.item.value + '<span class="remove-tag glyphicon glyphicon-remove-circle"></span></li>';
                    if ($seacrh_tag_textbox.find('.tag_item').length == 0) {
                        $seacrh_tag_textbox.prepend(content);
                    } else {
                        $('.tag_item').last().after(content);
                    }

                    return false;
                }
            });

        $(document).on('click', '.remove-tag', function () {
            var tagValue = $(this).parent('.tag_item').html().replace(/<\/?[^>]+(>|$)/g, "");
            availableTags.push(tagValue);
            $(this).parent('.tag_item').remove();
        });

        $(document).on('click', '.seacrh-tag-textbox', function () {
            $("#tags").focus();
        });
    });
</script>

<div class="ui-widget">
    <?php echo CHTml::label(Yii::t('ui_tagger', 'Tags'), 'tags'); ?>
    <ul class="seacrh-tag-textbox">
        <li>
            <?php
            echo CHtml::textField('tag_field', '', array(
                'id'   => 'tags',
                'size' => 50,
            ));
            ?>
        </li>
        <li>
            <?php
            echo CHtml::textField('tags_submit_field', '', array(
                'id'   => 'tags_submit_field',
                'size' => 50,
            ));
            ?>
        </li>
    </ul>
</div>
