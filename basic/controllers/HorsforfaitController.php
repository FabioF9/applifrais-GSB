<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Horsforfait;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\helpers\FileHelper;

/**
 * HorsforfaitController implements the CRUD actions for Horsforfait model.
 */
class HorsforfaitController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Horsforfait models.
     *
     * @return string
     */

    
    public function actionIndex()
    {

        if(!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Horsforfait::find()
            ->where(['idVisiteur' => $userId])
            // ->andWhere(['IN', 'MONTH(date)', [date('m'), date('m', strtotime('-1 month'))]])
            ->andWhere(['MONTH(date)' => date('m')])
            ->orderBy(['date' => SORT_ASC,]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ID' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Horsforfait model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Horsforfait model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

public function actionCreate()
{
    $currentDate = date('Y-m-d');
    $isLastDayOfMonth = (date('m', strtotime($currentDate)) != date('m', strtotime($currentDate . ' +1 day')));
    $model = new Horsforfait();

    if ($isLastDayOfMonth==false) {
        if ($this->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
            $fileName = uniqid() . '.' . $model->file->extension;
            $filePath = 'uploads/' . $fileName;

            // Vérifier si le fichier existe déjà
            while (file_exists($filePath)) {
                $fileName = uniqid() . '.' . $model->file->extension;
                $filePath = 'uploads/' . $fileName;
            }

            $model->file->saveAs($filePath);
            $model->Justificatif = $filePath;
        }
            $model->idVisiteur = Yii::$app->user->id;
            $model->save();

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    else{
        $model->addError('date', 'La saisie de frais n\'est pas autorisée le dernier jour du mois.');
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}


    /**
     * Updates an existing Horsforfait model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
{
    $model = Horsforfait::findOne($ID);

    if ($model === null) {
        throw new NotFoundHttpException('La page demandée n\'existe pas.');
    }

    if ($this->request->isPost) {
        $model->load($this->request->post());

        // Vérifier si le fichier justificatif est fourni
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file) {
            $fileName = uniqid() . '.' . $model->file->extension;
            $filePath = 'uploads/' . $fileName;

            // Vérifier si le fichier existe déjà
            while (file_exists($filePath)) {
                $fileName = uniqid() . '.' . $model->file->extension;
                $filePath = 'uploads/' . $fileName;
            }

            // Supprimer l'ancien fichier justificatif s'il existe
            if ($model->Justificatif && file_exists($model->Justificatif)) {
                unlink($model->Justificatif);
            }

            $model->file->saveAs($filePath);
            $model->Justificatif = $filePath;
        }

        if ($model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID]);
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}


    /**
     * Deletes an existing Horsforfait model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        $this->findModel($ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Horsforfait model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Horsforfait the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Horsforfait::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
