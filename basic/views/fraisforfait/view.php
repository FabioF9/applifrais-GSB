<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Fraisforfait $model */

// $this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Fraisforfaits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $model->ID;
\yii\web\YiiAsset::register($this);
?>
<div class="fraisforfait-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'ID',
            'date',
            [
                'attribute' => 'idFraisForfait',
                'value' => $model->baremeforfait->libelle,
            ],
            'quantite',
            'Montant',
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
