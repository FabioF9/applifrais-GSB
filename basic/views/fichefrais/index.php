<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use app\models\Fichefrais;
use yii\grid\ActionColumn;
use app\models\FichefraisSearch;

/** @var yii\web\View $this */
/** @var app\models\FichefraisSearch $searchModel */

$this->title = 'Fiche de frais';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichefrais-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        [
            'attribute' => 'ID',
            'value' => function ($model) {
                return $model->ID;
            },
            'filter' => false,
            'contentOptions' => ['style' => 'width: 5%;'],
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
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'Date',
                'language' => 'fr',
                'dateFormat' => 'yyyy-MM',
                'options' => ['class' => 'form-control', 'placeholder' => 'Choisir une date'],
            ]),
            'contentOptions' => ['style' => 'width: 20%;'],
            // 'filter' => Html::activeDropDownList(
            //     $searchModel,
            //     'Date',
            //     array_combine(ArrayHelper::getColumn($monthsAndYears, 'Date'), ArrayHelper::getColumn($monthsAndYears, 'Date')),
            //     [
            //         'class' => 'form-control',
            //         'prompt' => 'Choisir une date',
            //     ]
            // ),
        ],
        [
            'attribute' => 'idVisiteur',
            'value' => function ($model) {
                return $model->idVisiteur0->nom . ' ' . $model->idVisiteur0->prenom;
            },
            'filter' => Html::activeTextInput($searchModel, 'nomVisiteur', ['class' => 'form-control', 'placeholder' => 'Nom du visiteur']),
            'headerOptions' => ['class' => 'sorting'], // Ajoutez cette ligne pour activer le tri
            'contentOptions' => ['style' => 'width: 30%;'],
        ],
        [
            'attribute' => 'idEtat',
            'contentOptions' => ['style' => 'width: 20%;'],
            'value' => function ($model) {
                return $model->idEtat0->libelle;
            },
            'filter' => Html::activeDropDownList($searchModel, 'idEtat', [
                'CR' => 'Fiche créée',
                'CL' => 'Saisie clôturée',
                'RB' => 'Remboursée',
                'VA' => 'Validée et mise en paiement',
                // Add more options as needed
            ], ['class' => 'form-control', 'prompt' => 'Choisir l\'état']),
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
