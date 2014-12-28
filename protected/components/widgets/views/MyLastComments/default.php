<style type="text/css">
    #com {
        border-bottom: 1px solid silver;
    }

    #com #author {
        float: right;
    }
</style>
<h3>Останні коментарі</h3>
<span>
<?php
foreach ($comments as $coment):
    ?>
    <div id="comment">
        <span id="dt"><? echo date('G:i:s ,j.n.Y', $coment->date); ?></span>
        <span id="author"><? echo $coment->author; ?></span>

        <p><? echo $coment->content; ?></p>

    </div>

<?php endforeach; ?>
</span>
