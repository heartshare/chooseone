<div id="controll">
    <?php echo CHtml::link("Фільми", array('films/admin'), array('id' => 'btn-login', 'class' => 'btn btn-primary btn-lg')); ?>
    <?php echo CHtml::link("Книги", array('books/admin'), array('id' => 'btn-login', 'class' => 'btn btn-primary btn-lg')); ?>
    <?php echo CHtml::link("Ігри", array('games/admin'), array('id' => 'btn-login', 'class' => 'btn btn-primary btn-lg')); ?>
    <?php echo CHtml::link("Користувачі", array('user/admin'), array('id' => 'btn-login', 'class' => 'btn btn-primary btn-lg')); ?>
    <?php echo CHtml::link("Коментарі", array('comments/admin'), array('id' => 'btn-login', 'class' => 'btn btn-primary btn-lg')); ?>
</div>
