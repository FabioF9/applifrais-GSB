<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Historiquehf $model */

// $this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Historiquehf', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $model->ID;
\yii\web\YiiAsset::register($this);
?>
<div class="historiquehf-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'ID',
            'date',
            'Libellé:ntext',
            'Montant',
            'Justificatif:ntext',
        ],
    ]) ?>

</div>
