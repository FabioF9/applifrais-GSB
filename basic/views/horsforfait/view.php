<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */

// $this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Horsforfaits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->ID;
\yii\web\YiiAsset::register($this);
?>
<div class="horsforfait-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'Libellé:ntext',
            'Montant',
            'Justificatif:ntext',
        ],
    ]) ?>

<p>
        <?= Html::a('Modifier', ['update', 'ID' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Supprimer', ['delete', 'ID' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
