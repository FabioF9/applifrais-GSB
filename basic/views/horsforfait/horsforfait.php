<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */
/** @var ActiveForm $form */
?>
<?php
$connection = Yii::$app->db;
$command = $connection->createCommand("SELECT * FROM `horsforfait`");
$clients = $command->queryAll();
// print_r($clients);
?>

<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>idVisiteur</th>
      <th>Date</th>
      <th>Libellé</th>
      <th>Montant</th>
      <th>Justificatif</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($clients as $client): ?>
      <tr>
        <td><?= $client['idVisiteur'] ?></td>
        <td><?= $client['date'] ?></td>
        <td><?= $client['Libellé'] ?></td>
        <td><?= $client['Montant'] ?></td>
        <td><?= $client['Justificatif'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="horsforfait">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'Libellé') ?>
        <?= $form->field($model, 'Montant') ?>
    
        <div class="form-group">
            <br/>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- horsforfait -->
