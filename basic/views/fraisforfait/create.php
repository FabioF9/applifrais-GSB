<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fraisforfait $model */

$this->title = 'Ajouter un frais forfaitisé';
$this->params['breadcrumbs'][] = ['label' => 'Fraisforfaits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="fraisforfait-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    




</div>
