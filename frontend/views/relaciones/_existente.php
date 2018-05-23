<?php
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use common\models\Personajes;

?>

<?= $form->field($model, 'referencia')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Personajes::find()->all(), 'id', 'nombre'),
    'options' => ['placeholder' => 'Filter as you type ...'],
]); ?>
