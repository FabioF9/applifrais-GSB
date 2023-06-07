<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */

$this->title = 'GSB Applifrais';
$isUserLoggedIn = Yii::$app->user->isGuest;
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bienvenue !</h1>

        <p class="lead">Sur l'application Web de gestion de frais du laboratoire GSB.</p>

        <?= Html::img('@web/images/logo-gsb.png', ['alt' => 'My logo','class' => 'loginlogo']) ?>

        <?php if ($isUserLoggedIn): ?>
            <!-- Afficher le bouton de connexion uniquement si l'utilisateur n'est pas connecté -->
            <p><a class="btn btn-lg btn-success" href="/index.php?r=site%2Flogin">Se connecter</a></p>
        <?php endif; ?>
    </div>
    </div>

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
