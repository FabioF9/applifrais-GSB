<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Response;
use yii\base\Security;
use yii\web\Controller;
use app\models\LoginForm;
use yii\web\UploadedFile;
use app\models\Cartegrise;
use app\models\ContactForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
{
    $userId = Yii::$app->user->id;
    $model = Cartegrise::findOne(['idVisiteur' => $userId]);

    if (!$model) {
        $model = new Cartegrise();
        $model->idVisiteur = $userId;
    }

    if ($this->request->isPost) {
        $model->Chemin = UploadedFile::getInstance($model, 'Chemin');

        if ($model->Chemin) {
            // Chemin du fichier existant avant la modification
            $oldFilePath = $model->Chemin;
        
            // Générer un nouveau nom de fichier unique
            $fileName = uniqid() . '.' . $model->Chemin->extension;
            $newFilePath = 'uploads/' . $fileName;
        
            // Vérifier si le fichier existe déjà
            while (file_exists($newFilePath)) {
                $fileName = uniqid() . '.' . $model->Chemin->extension;
                $newFilePath = 'uploads/' . $fileName;
            }
        
            // Déplacer le nouveau fichier téléchargé vers le dossier d'uploads
            if ($model->Chemin->saveAs($newFilePath)) {
                // Mettre à jour le chemin du fichier dans le modèle
                $model->Chemin = $newFilePath;
        
                // Supprimer l'ancien fichier s'il existe
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            } else {
                // Erreur lors de l'enregistrement du fichier
                // Gérer l'erreur appropriée
            }
        }
        
        $model->save();
    }        
    return $this->render('index', [
        'model' => $model,
    ]);
}


    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->view->registerCssFile('@web/css/style.css');
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
