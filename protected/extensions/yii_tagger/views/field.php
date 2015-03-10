<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

<?php
Yii::app()->clientScript->registerCss('test', '
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
            // don't navigate away from the field on tab when selecting an item
            .bind("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 0,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    response($.ui.autocomplete.filter(
                        availableTags, extractLast(request.term)));
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.value);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    return false;
                }
            });
    });
</script>

<div class="ui-widget">
    <?php echo CHTml::label(Yii::t('ui_tagger', 'Tags'), 'tags'); ?>
    <ul class="seacrh-tag-textbox">
        <li>
            <?php
            echo CHtml::textField('tag_field', '', array(
                'id' => 'tags',
                'class' => 'form-control',
                'size' => 50,
            ));
            ?>
        </li>
    </ul>
</div>
