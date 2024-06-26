<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Baremeforfait;
use app\models\Fraiskilometrique;

/** @var yii\web\View $this */
/** @var app\models\Fraisforfait $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fraisforfait-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php     
    $idfkm = Yii::$app->user->identity->visiteur->idfkm;
    $fraiskilometrique = Fraiskilometrique::findOne($idfkm);
    $coeff = ($fraiskilometrique !== null) ? $fraiskilometrique->Coeff : null;
    ?>
<?= $form->field($model, 'idFraisForfait')->dropDownList(
    ArrayHelper::map(Baremeforfait::find()->all(), 'id', function($model) use ($coeff) {
        if ($model->id == 'KM' && isset($coeff)) {
            return $model->libelle . ' (' . $coeff . ')';
        } else {
            return $model->libelle . ' (' . $model->montant . ')';
        }
    })
) ?>

    <?= $form->field($model, 'quantite')->textInput(['type' => 'number', 'onchange' => 'calculateTotal()']) ?>

    <?= $form->field($model, 'Montant')->textInput(['readonly' => true]) ?>

    <br/>
    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function calculateTotal() {
        var montant = parseFloat($('#<?= Html::getInputId($model, 'idFraisForfait') ?> option:selected').text().split('(')[1].split(')')[0]);
        var quantite = parseFloat($('#<?= Html::getInputId($model, 'quantite') ?>').val());

        var total = montant * quantite;

        $('#<?= Html::getInputId($model, 'Montant') ?>').val(total.toFixed(2)); // Set the total value in the "Montant" field
    }
</script>
