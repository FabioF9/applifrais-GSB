<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Historiqueff $model */

// $this->title = $model->ID;
// $this->params['breadcrumbs'][] = ['label' => 'Historiqueffs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $model->ID;
\yii\web\YiiAsset::register($this);
?>
<div class="historiqueff-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'idFraisForfait',
            'quantite',
        ],
    ]) ?>

</div>
