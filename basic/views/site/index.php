<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Cartegrise;
use yii\web\View;

/** @var View $this */

$this->title = 'GSB Applifrais';
$isUserLoggedIn = Yii::$app->user->isGuest;
$userId = Yii::$app->user->id;
$model = Cartegrise::findOne(['idVisiteur' => $userId]); // Charger les données de la carte grise associée à l'utilisateur connecté

if (!$model) {
    $model = new Cartegrise(); // Instancier un nouvel objet si l'utilisateur n'a pas encore renseigné de fichier
}
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bienvenue !</h1>

        <p class="lead">Sur l'application Web de gestion de frais du laboratoire GSB.</p>

        <?= Html::img('@web/images/logo-gsb.png', ['alt' => 'My logo','class' => 'loginlogo']) ?>

        <?php if ($isUserLoggedIn): ?>
            <!-- Afficher le bouton de connexion uniquement si l'utilisateur n'est pas connecté -->
            <p><a class="btn btn-lg btn-success" href="/site/login">Se connecter</a></p>
        <?php endif; ?>
    </div>
    </div>
    <br/>
    <?php if (!Yii::$app->user->isGuest): ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'Chemin')->fileInput(['class' => 'telechargertaille'])
        ->label('<span class="cg">Ajouter sa carte grise :</span>') ?>
    <div class="form-group boutondl">
        <?= Html::submitButton('Télécharger', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
<br/>
    <?php if ($model && $model->Chemin): ?>
        <p class="cgdl">Vous avez déjà renseigné votre carte grise.</p>
    <?php else: ?>
        <p class="cgdl">Veuillez télécharger votre carte grise.</p>
    <?php endif; ?>

    <?php endif; ?>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2></h2>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p> -->
            </div>
            <div class="col-lg-4">
                <!-- <h2>Gestion des frais</h2>

                <p>En cliquant sur le bouton ci-dessous vous pourrez accéder à la gestion de vos frais.</p>

                <p><a class="btn btn-outline-secondary" href="index.php?r=fraisforfait%2Findex">Frais &raquo;</a></p> -->
            </div>
            <div class="col-lg-4">
                <!-- <h2>Heading</h2> -->

                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p> -->
            </div>
        </div>

    </div>
</div>
