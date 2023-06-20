<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */

// $this->title = 'Update Horsforfait: ' . $model->ID;
$this->title = 'Modification du frais';
$this->params['breadcrumbs'][] = ['label' => 'Horsforfaits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="horsforfait-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
