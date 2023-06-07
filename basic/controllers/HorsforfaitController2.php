<?php

namespace app\controllers;

use Yii;
use app\models\Horsforfait;

class HorsforfaitController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHorsforfait()
{
    $model = new \app\models\Horsforfait();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return;
        }
    }

    return $this->render('horsforfait', [
        'model' => $model,
    ]);
}

public function actionAfficherHorsForfait()
{
    // récupérer les données de la table HorsForfait
    $horsForfait = Horsforfait::find()->all();

    // afficher la vue qui affiche les données dans un tableau
    return $this->render('afficher-hors-forfait', [
        'horsForfait' => $horsForfait,
        'model' => new HorsForfait(),
    ]);
}

public function actionAjouterHorsForfait()
{
    $model = new Horsforfait();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        // les données ont été sauvegardées avec succès
        return $this->redirect(['afficher-hors-forfait']);
    }

    // afficher la vue qui contient le formulaire
    return $this->render('ajouter-hors-forfait', [
        'model' => $model,
    ]);
}


}
