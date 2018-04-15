<?php
use yii\data\ActiveDataProvider;

use yii\grid\GridView;
use yii\helpers\Html;

$search_term = Yii::$app->request->get('st') ?: '';
$search = Yii::$app->request->get('src') == 'pj' ? 'Personaje' : 'Usuario';
$this->title = "Buscar $search: \"$search_term\"";
$this->params['breadcrumbs'][] = $this->title;

if (isset($query)) {
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
         'pageSize' => 10,
      ],
   ]);

    if ($search == 'Personaje') {
        $dataProvider->sort->attributes['creator'] = [
         'asc' => ['creator' => SORT_ASC],
         'desc' => ['creator' => SORT_DESC],
      ];
    }
}

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (isset($query, $columnas)): ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columnas,
    ]); ?>
<?php else: ?>
<p>
    ¡Vaya! No se ha encontrado nada de nada :(
</p>
<?php endif; ?>
