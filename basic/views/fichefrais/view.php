<?php

use app\models\Historiquehf;
use app\models\Historiqueff;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fichefrais $model */
/** @var yii\data\ActiveDataProvider $dataProvider1 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Détails de la fiche de frais';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="fichefrais-view">
    <!-- <h3>Informations sur la fiche de frais</h3> -->
    <p>
    <strong>Date :</strong> <?= Html::encode((new \DateTime($model->Date))->format('m-Y')) ?>
    </p>
    <p>
        <strong>Visiteur :</strong> <?= Html::encode($model->idVisiteur0->nom . ' ' . $model->idVisiteur0->prenom) ?>
    </p>
    <p>
        <strong>État :</strong> <?= Html::encode($model->idEtat0->libelle) ?>
    </p>
</div>

<div class="historiquehf-grid">
    <h3>Historique des frais hors forfait</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [
            'Libellé',
            'Montant',
            'date',
        ],
    ]); ?>
</div>

<div class="historiqueff-grid">
    <h3>Historique des frais forfaitaires</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'columns' => [
            'idFraisForfait',
            'quantite',
            'Montant',
            'date',
        ],
    ]); ?>
</div>

