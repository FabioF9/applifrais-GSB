<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Fraisforfait;
use app\models\Baremeforfait;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * FraisforfaitController implements the CRUD actions for Fraisforfait model.
 */
class FraisforfaitController extends Controller
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
     * Lists all Fraisforfait models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Fraisforfait::find()
            ->where(['idVisiteur' => $userId])
            // ->andWhere(['IN', 'MONTH(date)', [date('m'), date('m', strtotime('-1 month'))]])
            ->andWhere(['MONTH(date)' => date('m')])
            ->andWhere(['YEAR(date)' => date('Y')])
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
     * Displays a single Fraisforfait model.
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
     * Creates a new Fraisforfait model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
        }
        $model = new Fraisforfait();
        $model->idVisiteur = Yii::$app->user->id;
        $model->date = date('Y-m-d');

        if ($this->request->isPost) {
            $montant = $model->idFraisForfait ? Baremeforfait::findOne($model->idFraisForfait)->montant : 0;
            $total = $montant * $model->quantite;
            // Assigner le montant total au champ 'Montant'
            $model->Montant = $total;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } else {
            $model->loadDefaultValues();
        }
        Yii::$app->db->createCommand("CALL create_fichefrais(:idVisiteur)")
        ->bindValue(':idVisiteur', $userId)
        ->execute();

        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Fraisforfait model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fraisforfait model.
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
     * Finds the Fraisforfait model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Fraisforfait the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Fraisforfait::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
