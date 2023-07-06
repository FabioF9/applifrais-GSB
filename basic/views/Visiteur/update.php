<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Visiteur $model */

// $this->title = 'Update Visiteur: ' . $model->id;
$this->title = 'Modification du nombre de CV';
$this->params['breadcrumbs'][] = ['label' => 'Visiteurs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="visiteur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
