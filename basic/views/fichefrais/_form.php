<?php

use app\models\Etat;
use app\models\Fichefrais;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Fichefrais $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="fichefrais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEtat')->dropDownList(
    ArrayHelper::map(Etat::find()->all(), 'id', 'libelle'),
    ['style' => 'width: 400px;']
) ?>

<br/>
    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
