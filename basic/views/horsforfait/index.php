<?php

use app\models\Horsforfait;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$moisEnCours = date('n');
$moisEnFrancais = [
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre',
];

$mois = $moisEnFrancais[$moisEnCours];

$this->title = 'Vos frais hors forfait du mois de ' . $mois;
// $this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<div class="horsforfait-index">

    <h1><?= Html::encode($this->title) ?>
        <?= Html::a('<i class="fas fa-print"></i>', '', ['class' => 'btn btn-primary', 'id' => 'print-button']) ?>
    </h1>

    <p>
        <?= Html::a('Ajouter un frais hors forfait', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div id="print-content">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            // 'idVisiteur:ntext',
            'Libellé:ntext',
            [
                'attribute' => 'Montant',
                'contentOptions' => ['class' => 'text-right'],
                'value' => function ($model) {
                    return $model->Montant;
                },
            ],
            'date',
            [
                'label' => 'Statut du justificatif (à renseigner avant le 10 du mois)',
                'contentOptions' => ['style' => 'width: 25%;'],
                'value' => function (Horsforfait $model) {
                    return $model->hasJustificatif() ? 'Justificatif renseigné' : 'Justificatif en attente';
                }
            ],
            //'Justificatif:ntext',
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width: 6%;'],
                'urlCreator' => function ($action, Horsforfait $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
                 
            ],
        ],
    ]); ?>

        <?php
        // Calcul du total à rembourser
        $totalRembourser = $dataProvider->query->sum('Montant');
        ?>

            <div class="total-rembourser2">
                <?php if ($totalRembourser == 0) : ?>
                    <h5>Total hors forfait : 0€</h5>
                <?php else : ?>
                    <h5>Total hors forfait : <?= $totalRembourser ?> €</h5>
                <?php endif; ?>
            </div>
    </div>


</div>

<script>
    var originalContents = null; // Ajoutez cette variable en dehors de l'événement de clic

    document.getElementById('print-button').addEventListener('click', function() {
        var printContents = document.getElementById('print-content').innerHTML;

        if (originalContents === null) {
            originalContents = document.body.innerHTML; // Enregistre le contenu original uniquement s'il n'est pas déjà enregistré
        }

        document.body.innerHTML = printContents;

        window.print();
    });

    // Ajoutez cet écouteur d'événement pour réinitialiser le contenu original lors de l'annulation de l'impression
    window.addEventListener('afterprint', function() {
        if (originalContents !== null) {
            document.body.innerHTML = originalContents;
            originalContents = null; // Réinitialise la variable pour la prochaine impression
        }
    });
</script>
