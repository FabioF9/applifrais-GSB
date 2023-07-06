<?php

use app\models\Fraiskilometrique;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Visiteur $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="visiteur-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'idfkm')->dropDownList(
    ArrayHelper::map(Fraiskilometrique::find()->all(), 'ID', 'CV'),
    ['style' => 'margin-left:2%; width: 40px;']
) ?>
    <br/>
    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success bouttonsauvegardefraiskm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
