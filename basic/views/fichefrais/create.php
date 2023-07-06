<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fichefrais $model */

$this->title = 'Create Fichefrais';
$this->params['breadcrumbs'][] = ['label' => 'Fichefrais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichefrais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
