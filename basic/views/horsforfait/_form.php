<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="horsforfait-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'Libellé')->textInput() ?>

    <?= $form->field($model, 'Montant')->textInput(['type' => 'number']) ?>
    <br/>

    

    <?= $form->field($model, 'file')->fileInput() ?>

    <br/>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
