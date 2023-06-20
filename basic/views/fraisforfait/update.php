<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fraisforfait $model */

// $this->title = 'Update Fraisforfait: ' . $model->ID;
$this->title = 'Modification du frais';
$this->params['breadcrumbs'][] = ['label' => 'Fraisforfaits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
// $this->params['breadcrumbs'][] = 'Update';
$message = Yii::$app->session->getFlash('message');
if ($message !== null) {
    echo Html::tag('div', $message, ['class' => 'alert alert-success']);
}
?>
<div class="fraisforfait-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
