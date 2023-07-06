<?php

use app\models\Fichefrais;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Fiche de frais';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichefrais-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        [
            'attribute' => 'ID',
            'value' => function ($model) {
                return $model->ID;
            },
        ],
        [
            'attribute' => 'Date',
            'value' => function ($model) {
                // Convertir la date en objet DateTime
                $date = new DateTime($model->Date);
                // Récupérer le mois et l'année au format 'm-Y'
                $moisAnnee = $date->format('m-Y'); // Exemple : 07-2023
                return $moisAnnee;
            },
        ],
        [
            'attribute' => 'idVisiteur',
            'value' => function ($model) {
                return $model->idVisiteur0->nom . ' ' . $model->idVisiteur0->prenom;
            },
        ],
        [
            'attribute' => 'idEtat',
            'contentOptions' => ['style' => 'width: 20%;'],
            'value' => function ($model) {
                return $model->idEtat0->libelle;
            },
        ],
        [
            'class' => ActionColumn::className(),
            'contentOptions' => ['style' => 'width: 5%;'],
            'template' => '{view} {update}',
            'urlCreator' => function ($action, Fichefrais $model, $key, $index, $column) {
                return Url::toRoute([$action, 'ID' => $model->ID]);
            },
        ],
    ],
]); ?>




</div>
