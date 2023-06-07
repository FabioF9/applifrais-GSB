<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\Historiqueff;
use app\models\Historiquehf;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Historique des frais hors forfait';
?>
<div class="historiquehf-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [
            
            'Libellé:ntext',
            [
                'attribute' => 'Montant',
                'contentOptions' => ['class' => 'text-right'],
                'value' => function ($model) {
                    return $model->Montant . ',00';
                },
            ],
            'date',
            
            //'Justificatif:ntext',
            //'logo',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, Historiquehf $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
        'summary' => false,
    ]); ?>

    <?php
        // Calcul du total à rembourser
        $totalRembourser = $dataProvider1->query->sum('Montant');
        ?>

        <div class="total-rembourser">
            <h4>Total hors forfait : <?= $totalRembourser ?> €</h4>
</div>
<br/>
<h1><?= Html::encode("Historique des frais forfaitisés") ?></h1>

<?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'columns' => [
            'idFraisForfait',
            'quantite',
            [
                'attribute' => 'Montant',
                'contentOptions' => ['class' => 'text-right'],
                'value' => function ($model) {
                    return $model->Montant . ',00';
                },
            ],
            'date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, Historiqueff $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
        'summary' => false,
    ]); ?>

<?php
        // Calcul du total à rembourser
        $totalRembourser = $dataProvider2->query->sum('Montant');
        ?>

        <div class="total-rembourser">
            <h4>Total : <?= $totalRembourser ?> €</h4>
</div>


</div>
