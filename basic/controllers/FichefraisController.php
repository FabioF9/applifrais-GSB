<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Fichefrais;
use yii\filters\VerbFilter;
use app\models\Historiqueff;
use app\models\Historiquehf;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * FichefraisController implements the CRUD actions for Fichefrais model.
 */
class FichefraisController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index','update','view'],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                $user = Yii::$app->user->identity;
                                return $user && $user->user_type === 'C';
                            },
                        ],
                    ],
                ],
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
     * Lists all Fichefrais models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Fichefrais::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            */
            'sort' => [
                'defaultOrder' => [
                    'Date' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fichefrais model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
{        
    $model = $this->findModel($ID);
    
    $idVisiteur = $model->idVisiteur;
    $date = $model->Date;
    
    $query1 = Historiquehf::find()
        ->where(['idVisiteur' => $idVisiteur])
        ->orderBy(['date' => SORT_ASC]);

    $query2 = Historiqueff::find()
        ->where(['idVisiteur' => $idVisiteur])
        ->orderBy(['date' => SORT_ASC]);

    $query3 = Historiquehf::find()
        ->select(['date'])
        ->where(['idVisiteur' => $idVisiteur]);

    $query4 = Historiqueff::find()
        ->select(['date'])
        ->where(['idVisiteur' => $idVisiteur]);

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
            ->andWhere(['MONTH(date)'=>$startMonth])
            ->andWhere(['idVisiteur' => $idVisiteur]);
        $query2->where(['YEAR(date)'=>$startYear])
            ->andWhere(['MONTH(date)'=>$startMonth])
            ->andWhere(['idVisiteur' => $idVisiteur]);
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

    return $this->render('view', [
        'model' => $model,
        'dataProvider1' => $dataProvider1,
        'dataProvider2' => $dataProvider2,
        'dataProvider3' => $dataProvider3,
    ]);
}

    /**
     * Creates a new Fichefrais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fichefrais();

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
     * Updates an existing Fichefrais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'La modification a été effectuée avec succès.');
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fichefrais model.
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
     * Finds the Fichefrais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Fichefrais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Fichefrais::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
