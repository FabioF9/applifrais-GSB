<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Historiqueff;
use app\models\Historiquehf;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * HistoriquehfController implements the CRUD actions for Historiquehf model.
 */
class HistoriquehfController extends Controller
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
     * Lists all Historiquehf models.
     *
     * @return string
     */
    public function actionIndex($date = null)
    {
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
        }
        
        $query1 = Historiquehf::find()
            ->where(['idVisiteur' => $userId])
            ->orderBy(['date' => SORT_ASC]);
    
        $query2 = Historiqueff::find()
            ->where(['idVisiteur' => $userId])
            ->orderBy(['date' => SORT_ASC]);

        $query3 = Historiquehf::find()
        ->select(['date'])
        ->where(['idVisiteur' => $userId]);

        $query4 = Historiqueff::find()
                    ->select(['date'])
                    ->where(['idVisiteur' => $userId]);

        $unionQuery = (new \yii\db\Query())
            ->select(['date'])
            ->from(['union' => $query3->union($query4)])
            ->orderBy(['date' => SORT_ASC]);
    
        if ($date) {
            $startDateTime = strtotime($date);
            // $endDateTime = strtotime('+1 month', $startDateTime);
            
            $startYear = date('Y', $startDateTime);
            $startMonth = date('m', $startDateTime);
            
            // $endYear = date('Y', $endDateTime);
            // $endMonth = date('m', $endDateTime);
            
            // $query1->andWhere(['between', 'YEAR(date)', $startYear, $endYear])
            //     ->andWhere(['between', 'MONTH(date)', $startMonth, $endMonth]);
                
            // $query2->andWhere(['between', 'YEAR(date)', $startYear, $endYear])
            //     ->andWhere(['between', 'MONTH(date)', $startMonth, $endMonth]);
            $query1->where(['YEAR(date)'=>$startYear])
                   ->andWhere(['MONTH(date)'=>$startMonth]);
            $query2->where(['YEAR(date)'=>$startYear])
            ->andWhere(['MONTH(date)'=>$startMonth]);
        }
    
        $dataProvider1 = new ActiveDataProvider([
            'query' => $query1,
        ]);
    
        $dataProvider2 = new ActiveDataProvider([
            'query' => $query2,
        ]);

        $dataProvider3 = new ActiveDataProvider([
            'query' => $unionQuery,
        ]);
    
    
        return $this->render('index', [
            'dataProvider1' => $dataProvider1,
            'dataProvider2' => $dataProvider2,
            'dataProvider3' => $dataProvider3,
        ]);
    }
    

    /**
     * Displays a single Historiquehf model.
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
     * Creates a new Historiquehf model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Historiquehf();

        if ($this->request->isPost) {
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

    /**
     * Updates an existing Historiquehf model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($ID)
    // {
    //     $model = $this->findModel($ID);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'ID' => $model->ID]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing Historiquehf model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($ID)
    // {
    //     $this->findModel($ID)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Historiquehf model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Historiquehf the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Historiquehf::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
