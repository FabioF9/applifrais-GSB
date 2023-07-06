<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fichefrais $model */

$this->title = 'Modification Fiche';
$this->params['breadcrumbs'][] = ['label' => 'Fichefrais', 'url' => ['index']];
?>
<div class="fichefrais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
