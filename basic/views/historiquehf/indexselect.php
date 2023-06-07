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

    <?php
    $dates = []; // Tableau pour stocker les dates uniques
    foreach ($dataProvider1->models as $model) {
        $date = date('F Y', strtotime($model->date));
        if (!in_array($date, $dates)) {
            $dates[] = $date;
        }
    }

    // Récupérer la date sélectionnée de l'URL
    $selectedDate = isset($_GET['date']) ? $_GET['date'] : null;
    $otherParam = isset($_GET['otherParam']) ? $_GET['otherParam'] : null;
    ?>

    <div>
        <?php foreach ($dates as $date) : ?>
            <?php
            $url = ['historiquehf/index', 'date' => $date, 'otherParam' => $otherParam];
            $options = ['class' => 'btn btn-primary'];
            ?>
            <?= Html::a($date, $url, $options) ?>
        <?php endforeach; ?>
    </div>

    <br/>

    <?php if ($selectedDate !== null) : ?>
        <h2>Frais pour <?= Html::encode($selectedDate) ?></h2>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider1,
            'columns' => [
                'Libellé:ntext',
                'Montant',
                'date',
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
    <?php endif; ?>

    <br/>

    <h1><?= Html::encode("Historique des frais forfaitisés") ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'columns' => [
            'idFraisForfait',
            'quantite',
            'Montant',
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

</div>
