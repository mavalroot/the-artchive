<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$owner = $model->getUsuario()->one()->username;

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Personajes de') . ' ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personajes-view">
    
    <?= $this->render('_view', ['model' => $model])?>

    <?= $this->render('_relaciones', [
        'model' => $model,
        'relaciones' => $relaciones,
        'pagination' => $pagination,
    ]) ?>

</div>

<?php

$js = <<< JS
actionButton('/relaciones/delete', 'delete-relation', '.relaciones-relacion', '.relaciones-relacion');
JS;

$this->registerJs($js);
