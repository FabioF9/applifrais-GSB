<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */

$this->title = 'Ajouter un frais hors forfait';
$this->params['breadcrumbs'][] = ['label' => 'Horsforfaits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="horsforfait-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
