<?php

use app\models\Visiteur;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Visiteurs';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="visiteur-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'nom',
        'prenom',
        [
            'attribute' => 'idfkm',
            'contentOptions' => ['style' => 'width: 7%;'],
            'value' => function ($model) {
                if ($model->idfkm0 !== null) {
                    return $model->idfkm0->CV;
                } else {
                    return '';
                }
            },
        ],
        [
            'class' => ActionColumn::className(),
            'contentOptions' => ['style' => 'width: 5%;'],
            'template' => '{view} {update}',
            'urlCreator' => function ($action, Visiteur $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
        ],
    ],
]); ?>




</div>
