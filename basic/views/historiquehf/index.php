<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\Historiqueff;
use app\models\Historiquehf;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Historique de vos frais';
?>

<div class="historiquehf-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Veuillez sélectionner une date :</h4>

    <?php
        $dates = []; // Tableau pour stocker les dates uniques
        foreach ($dataProvider3->models as $model) {
            if (is_array($model) && isset($model['date'])) {
                $date = date('F Y', strtotime($model['date']));
                if (!in_array($date, $dates)) {
                    $dates[] = $date;
                }
            } elseif (is_object($model) && isset($model->date)) {
                $date = date('F Y', strtotime($model->date));
                if (!in_array($date, $dates)) {
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
            <?= Html::a($dateEnFrancais, $url, $options) ?>
        <?php endforeach; ?>
    </div>

    <br/>
    <div class="border border-info rounded-4">
        <div class="padding">
            <?php if ($selectedDate !== null) : ?>
                
                
                
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
                                return $model->Montant . ',00';
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
            // Calcul du total à rembourser
            $totalRembourser = $dataProvider1->query->sum('Montant');
            ?>

            <div class="total-rembourser">
                <?php if ($totalRembourser==0):?>
                    <h4>Total hors forfait: 0€</h4>
                <?php else :?>
                <h4>Total hors forfait : <?= $totalRembourser ?> €</h4>
            </div>
        </div>



    <?php endif; ?>
    </div>
        
        
         <br/>
        <div class="border border-info rounded-4">
                <div class="padding">
                <h2>Frais forfaitisés de <?= Html::encode($dateFR) ?></h2>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider2,
                    'columns' => [
                        [
                            'attribute' => 'idFraisForfait',
                            'contentOptions' => ['style' => 'width: 40%;'],
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
                                return $model->Montant . ',00';
                            },
                        ],
                        'date',
                        [
                            'class' => ActionColumn::className(),
                            'contentOptions' => ['style' => 'width: 5%;'],
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
                    <?php if ($totalRembourser==0):?>
                        <h4>Total des frais forfaitisés : 0€</h4>
                    <?php else :?>
                    <h4>Total des frais forfaitisés : <?= $totalRembourser ?> €</h4>
                </div>
            <?php endif; ?>
            <?php endif; ?>

            </div>
        </div>

</div>
