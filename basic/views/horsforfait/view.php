<?php

use yii\helpers\Html;
use app\models\Horsforfait;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */

// $this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Horsforfaits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $model->ID;
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
            [
                'attribute' => 'Justificatfif',
                'value' => function ($model) {
                    $carteGrise = Horsforfait::findOne(['Justificatif' => $model->Justificatif]);
                    if ($carteGrise !== null) {
                        $filePath = Yii::getAlias('@web/') . $carteGrise->Justificatif;
                        return Html::a('Voir le justificatif', $filePath, ['target' => '_blank']);
                    } else {
                        return 'Non disponible';
                    }
                },
                'format' => 'raw',
            ],
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
