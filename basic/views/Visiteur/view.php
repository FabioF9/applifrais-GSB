<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Cartegrise;
use app\models\Fraiskilometrique;

/** @var yii\web\View $this */
/** @var app\models\Visiteur $model */

$this->title = $model->prenom . ' ' . $model->nom;
$this->params['breadcrumbs'][] = ['label' => 'Visiteurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visiteur-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'CV',
            'value' => function ($model) {
                $fraiskilometrique = Fraiskilometrique::findOne(['ID' => $model->idfkm]);
                if ($fraiskilometrique !== null) {
                    return $fraiskilometrique->CV;
                } else {
                    return 'Non disponible';
                }
            },
        ],
        [
            'attribute' => 'Carte grise',
            'value' => function ($model) {
                $carteGrise = Cartegrise::findOne(['idVisiteur' => $model->id]);
                if ($carteGrise !== null) {
                    $filePath = Yii::getAlias('@web/') . $carteGrise->Chemin;
                    return Html::a('Voir la carte grise', $filePath, ['target' => '_blank']);
                } else {
                    return 'Non disponible';
                }
            },
            'format' => 'raw',
        ],
    ],
]) ?>

</div>
