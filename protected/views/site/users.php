<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'games-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'login',

        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>