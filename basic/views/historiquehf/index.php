
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\Historiqueff;
use app\models\Historiquehf;
use app\models\Fichefrais;
use app\models\Fraisforfait;
use app\models\Baremeforfait;
use app\models\Etat;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Historique de vos frais';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<div class="historiquehf-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Veuillez sélectionner une date :</h4>

    <?php
        $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
        $totalGlobalRembourser = 0;
        $dates = []; // Tableau pour stocker les dates uniques
        foreach ($dataProvider3->models as $model) {
            if (is_array($model) && isset($model['date'])) {
                $date = date('F Y', strtotime($model['date']));
                if (!in_array($date, $dates) && $model['date'] >= $oneYearAgo) {
                    $dates[] = $date;
                }
            } elseif (is_object($model) && isset($model->date)) {
                $date = date('F Y', strtotime($model->date));
                if (!in_array($date, $dates) && $model->date >= $oneYearAgo) {
                    $dates[] = $date;
                }
            }
        }

        // Récupérer la date sélectionnée de l'URL
        $selectedDate = isset($_GET['date']) ? $_GET['date'] : null;

        if ($selectedDate !== null) {
            $dateEnMoisAnnee = date('F Y', strtotime($selectedDate));
            $moisEnCours = intval(date('n', strtotime($selectedDate)));
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
            $dateFR = $mois . ' ' . date('Y', strtotime($selectedDate));
        }
    ?>

    <div>
        <?php foreach ($dates as $date) : ?>
            <?php
            $dateEnMoisAnnee = date('F Y', strtotime($date));
            $moisEnCours = intval(date('n', strtotime($date)));
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
            $dateEnFrancais = $mois . ' ' . date('Y', strtotime($date));

            $url = ['historiquehf/index', 'date' => $date];
            $options = ['class' => 'btn btn-primary'];
            if ($date === $selectedDate) {
                $options = ['class' => 'btn btn-outline-primary'];
            }
            ?>
            <?= Html::a($dateEnFrancais, $url, $options)  ?> 
        <?php endforeach; ?>
        <?= Html::a('<i class="fas fa-print"></i>', '', ['class' => 'btn btn-primary', 'id' => 'print-button']) ?>
    </div>

    <br/>
    
    <?php if ($selectedDate !== null) : ?>
    <?php
    if (!Yii::$app->user->isGuest) {
        $userId = Yii::$app->user->id;
    }
    $selectedDateFormatted = date('Y-m', strtotime($selectedDate));
    // Récupérer la fiche de frais correspondante
    $query = FicheFrais::find()->where(['LIKE', 'Date', $selectedDateFormatted . '%', false])->andWhere(['idVisiteur' => $userId]);
    $ficheFrais = $query->one();?>

    <?php if ($ficheFrais !== null) : ?>
        <?php $etatFicheFrais = $ficheFrais->idEtat0->libelle; ?>
        <div class="etat-fiche-frais">
            <h4>État de la fiche : <?= Html::encode($etatFicheFrais) ?></h4>
        </div>
    <?php endif; ?>
        
        <div id="print-content">
        <div class="border border-info rounded-4">
            <div class="padding">
                <h2>Frais hors forfait de <?= Html::encode($dateFR) ?></h2>
                

                <?= GridView::widget([
                    'dataProvider' => $dataProvider1,
                    'columns' => [
                        [
                            'attribute' => 'Libellé',
                            'contentOptions' => ['style' => 'width: 50%;'],
                        ],
                        [
                            'attribute' => 'Montant',
                            'contentOptions' => ['style' => 'width: 10%;'],
                            'contentOptions' => ['class' => 'text-right'],
                            'value' => function ($model) {
                                return $model->Montant;
                            },
                        ],
                        'date',
                        [
                            'class' => ActionColumn::className(),
                            'contentOptions' => ['style' => 'width: 5%;'],
                            'template' => '{view}',
                            'urlCreator' => function ($action, Historiquehf $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'ID' => $model->ID]);
                            }
                        ],
                    ],
                    'summary' => false,
                ]); ?>

                <?php
                $totalRembourser = $dataProvider1->query->sum('Montant');
                $totalGlobalRembourser += $totalRembourser;
                ?>

                <div class="total-rembourser3">
                    <?php if ($totalRembourser == 0) : ?>
                        <h5>Total hors forfait: 0€</h5>
                    <?php else : ?>
                        <h5>Total hors forfait : <?= $totalRembourser ?> €</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <br/>

    <?php if ($selectedDate !== null) : ?>

    <div class="border border-info rounded-4">
        <div class="padding">
            <h2>Frais forfaitisés de <?= Html::encode($dateFR) ?></h2>

            <?= GridView::widget([
                'dataProvider' => $dataProvider2,
                'columns' => [
                    [
                        'attribute' => 'Type',
                        'contentOptions' => ['style' => 'width: 40%;'],
                        'value' => function ($model) {
                            return  $model->baremeforfait->libelle;
                        },
                    ],
                    [
                        'attribute' => 'quantite',
                        'contentOptions' => ['style' => 'width: 10%;'],
                    ],
                    [
                        'attribute' => 'Montant',
                        'contentOptions' => ['style' => 'width: 10%;'],
                        'contentOptions' => ['class' => 'text-right'],
                        'value' => function ($model) {
                            return $model->Montant;
                        },
                    ],
                    'date',
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'contentOptions' => ['style' => 'width: 5%;'],
                    //     'template' => '{view}',
                    //     'urlCreator' => function ($action, Historiqueff $model, $key, $index, $column) {
                    //         return Url::toRoute(['historiqueff/view', 'ID' => $model->ID]);
                    //     }
                    // ],
                ],
                'summary' => false,
            ]); ?>

            <?php
            $totalRembourser = $dataProvider2->query->sum('Montant');
            $totalGlobalRembourser += $totalRembourser;
            ?>

            <div class="total-rembourser4">
                <?php if ($totalRembourser == 0) : ?>
                    <h5>Total des frais forfaitisés : 0€</h5>
                <?php else : ?>
                    <h5>Total des frais forfaitisés : <?= $totalRembourser ?> €</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <br/>

    <div class="total-global-rembourser">
        <h4>Total global : <?= $totalGlobalRembourser ?> €</h4>
    </div>
    <?php endif; ?>

    

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